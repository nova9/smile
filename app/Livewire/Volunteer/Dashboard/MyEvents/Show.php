<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\File;
use App\Models\Review;
use App\Models\Task;
use App\Services\FileManager;
use App\Services\GoogleMaps;
use Livewire\Attributes\Validate;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use Livewire\WithFileUploads;
class Show extends Component
{
    public $event;
    public $status;
    public $volunteers;
    public $city;
    public $tasks;
    public $reviewbutton = false;
    public $is_favorited;
    public $uploadedPhotos = [];
    public $avgratings;
    
    #[Validate('nullable|string|max:500')]
    public string $review;

    #[Validate('required|integer|min:1|max:5')]
    public int $rating;
    
    public $reviewCount;
    public $eventReviews;
   

    // public function join()
    // {
    //     if (auth()->user()->isProfileCompletionPercentage() != 1) {
    //         return redirect('/volunteer/dashboard/profile')->with('error', 'Please complete your profile before joining an event.');
    //     }
    //     $this->event->users()->attach(auth()->user()->id);
    //     return redirect('/volunteer/dashboard/my-events');
    // }

    public function mount($id, GoogleMaps $googleMaps)
    {
        // dd($this->event);

        $this->event = Event::query()
            ->with(['address', 'users', 'category', 'tags'])
            ->find($id);
        $this->status = $this->event->users->where('id', auth()->id())->first()?->pivot->status;
        // dd($this->status);
        $this->volunteers = $this->event->users;
        $this->city = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->tasks = $this->event->tasks()->get();
        $this->is_favorited = $this->toggleFavorite();
        
        $completedTasksCount = Task::where('assigned_id', auth()->id())
                ->where('status', 'done')
                ->count();
        if ($completedTasksCount >= 1) {
            $this->reviewbutton = true;
        }
        
        $uploadedPhotos = $this->event->photos;
        $this->uploadedPhotos = $uploadedPhotos->pluck('file_id')->map(function($fileId){
            return FileManager::getTemporaryUrl($fileId);
        });

        $this->loadReviews();
        // dd()
        // dd($this->event->reviews);
        //map function replaces the id with temporary url
        // dd($this->uploadedPhotos);

    }
    
    public function loadReviews(){
        $this->reviewCount = $this->event->reviews->count();
        $this->eventReviews = $this->event->reviews;
        $this->avgratings = $this->reviewCount > 0 ? ($this->event->reviews->pluck('rating')->sum()) / $this->reviewCount : 0;
        
    }
    
    public function submitReview(){
        $this->validate();

        $alreadyReviewed = Review::where('user_id', auth()->id())
            ->where('event_id', $this->event->id)
            ->exists();
        if (!$alreadyReviewed) {
            Review::create([
                'user_id' => (auth()->id()),
                'event_id' => ($this->event->id),
                'review' => ($this->review),
                'rating' => ($this->rating)
            ]);

        }else{
           $review= Review::where('user_id',auth()->id())
           ->where('event_id',$this->event->id)
           ->first();
           
           if($review){
                $review->update([
                
                    'review' => ($this->review),
                    'rating' => ($this->rating)
                ]);
           }
        }
       
       $this->loadReviews();
       
    }

    use WithFileUploads;
 
    public $photos = [];
 
    public function save()
    {
       
        foreach ($this->photos as $photo) {
            $photo->store(path: 'photos');
            $file = FileManager::store($photo);
            $isuploaded=EventPhoto::create([
                'user_id'=> auth()->id(),
                'event_id'=> $this->event->id,
                'file_id'=> $file->id,
                ]);

        }
    
        
    }



    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.show');
    }

    public function updateTaskStatus($taskId, $newStatus)
    {
        $task = $this->tasks->where('id', $taskId)->first();
        if (!$task) {
            session()->flash('error', 'Task not found.');
            return;
        }
        if (!in_array($newStatus, ['todo', 'doing', 'done'])) {
            session()->flash('error', 'Invalid status.');
            return;
        }
        if ($newStatus == 'done') {
            $task->status = 'done';
            $task->save();
            $task->TaskCompletion();

            // Check if this is the user's first completed task
            $user = auth()->user();
            $completedTasksCount = Task::where('assigned_id', $user->id)
                ->where('status', 'done')
                ->count();
            
            $user->assignBadgesForTasks($completedTasksCount, $user);
            
            $points=$user->badges->sum('points');
            $events=$user->participatingEvents()->where('status', 'accepted')->count();
            // dd($points,$events,$completedTasksCount);
            $user->setVolunteerLevel($points,$events,$completedTasksCount);

            session()->flash('success', 'Task status updated to Done.');
            // Optionally, reload tasks to reflect changes
            $this->tasks = $this->event->tasks()->get();
            return;
        }

        $task->status = $newStatus;
        $task->save();
        session()->flash('success', 'Task status updated to ' . ucfirst($newStatus) . '.');
        // Optionally, reload tasks to reflect changes
        $this->tasks = $this->event->tasks()->get();
    }
    
    public function toggleFavorite(){
        $favoriteService = new \App\Services\Favorite()->toggleFavorite($this->event->id,auth()->id());
        $this->is_favorited = !$this->is_favorited;
        return $favoriteService;
    }
}
