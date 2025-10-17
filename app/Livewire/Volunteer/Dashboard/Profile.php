<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Jobs\GenerateEmbedding;
use App\Services\FileManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $attribute;
    public $skills = [];
    public $interests = [];
    public $completion;
    public $profile;
    public $name;
    public $email;
    public $contact_number;
    public $gender;

    #[Validate]
    public $profile_picture;

    public $profile_picture_url;

    public $location;
    public $latitude;
    public $longitude;
    public $age; // Age attribute
    public $volunteer_level;


    public $education = [];
    public $institution;
    public $qualification;
    public $year_of_completion;

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();

        $this->education = json_decode($user->getCustomAttribute('education'), true) ?? [];

        $this->profile_picture_url = FileManager::getTemporaryUrl(auth()->user()->getCustomAttribute('profile_picture'));

        $this->completion = $user->profileCompletionPercentage();

        $this->contact_number = $user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();

        $this->skills = json_decode($user->attributes()->where('name', 'skills')->get()->pluck('pivot.value')->first(), true);
        $this->interests = json_decode($user->attributes()->where('name', 'interests')->get()->pluck('pivot.value')->first(), true);

        if ($this->latitude === null) {
            $this->latitude = $user->attributes()->where('name', 'latitude')->get()->pluck('pivot.value')->first();
        }
        if ($this->longitude === null) {

            $this->longitude = $user->attributes()->where('name', 'longitude')->get()->pluck('pivot.value')->first();
        }
        $this->gender = $user->attributes()->where('name', 'gender')->get()->pluck('pivot.value')->first();
        $this->age = $user->attributes()->where('name', 'age')->get()->pluck('pivot.value')->first(); // Initialize age

//        $points = $user->badges()->sum('points');
//        $events = $user->events()->count();
//        $tasks = $user->tasks()->count();
//        $user->setVolunteerLevel($points, $events, $tasks);//just sets the level
        $this->volunteer_level = $user->getCustomAttribute('level');
    }

    public function rules()
    {
        return [
            'skills' => 'nullable|array',
            'interests' => 'nullable|array',
            'age' => 'nullable|integer|min:1|max:120',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'contact_number' => 'nullable|string|max:10|min:10', // Adjust max length as needed
            'gender' => 'nullable|string|in:male,female,other,prefer_not_to_say',
            'profile_picture' => 'required|image|max:10240', // 10MB max size
        ];
    }

    public function addEducation()
    {
        $this->education = array_merge($this->education, [[
            'institution' => $this->institution,
            'qualification' => $this->qualification,
            'year_of_completion' => $this->year_of_completion,
            'id' => uniqid(),
        ]]);
        auth()->user()->setCustomAttribute('education', json_encode($this->education));
    }

    public function removeEducation($id)
    {
        $this->education = array_filter($this->education, function ($edu) use ($id) {
            return $edu['id'] !== $id;
        });
        auth()->user()->setCustomAttribute('education', json_encode(array_values($this->education)));
    }

    public function saveProfilePicture()
    {
        $this->validate(Arr::only($this->rules(), ['profile_picture']));
        $file = FileManager::store($this->profile_picture);
        auth()->user()->setCustomAttribute('profile_picture', $file->id);
        session()->flash('success', 'Profile picture updated successfully!');
        $this->redirect('/volunteer/dashboard/profile');
    }


    public function save()
    {
        // dd("lo");
        // $this->validate(Arr::except($this->rules(), ['profile_picture',]));


        auth()->user()->setCustomAttribute('skills', json_encode($this->skills));
        auth()->user()->setCustomAttribute('latitude', $this->latitude);
        auth()->user()->setCustomAttribute('longitude', $this->longitude);
        auth()->user()->setCustomAttribute('contact_number', $this->contact_number);
        auth()->user()->setCustomAttribute('gender', $this->gender);
        auth()->user()->setCustomAttribute('interests', json_encode($this->interests));


        GenerateEmbedding::dispatch(auth()->user(), textToEmbed: json_encode(auth()->user()->getAllAttributes()));

        session()->flash('success', 'Profile updated successfully!');
        return $this->redirect('/volunteer/dashboard/profile');
    }

    /**
     * Insert or update user attributes (only non-empty values).
     * @param array $attributes
     */
//    protected function insertUserAttributes(array $attributes)
//    {
//        $attributesToSync = [];
//        $i = 1;
//        foreach ($attributes as $val) {
//            if (!empty($val)) {
//                $attributesToSync[$i] = ['value' => $val];
//            }
//            $i++;
//        }
//        if (!empty($attributesToSync)) {
//            auth()->user()->attributes()->syncWithoutDetaching($attributesToSync);
//        }
//
//        session()->flash('success', 'Profile updated successfully!');
//        return redirect()->route('profile');
//    }

    #[On('coordinates')]
    public function handleNewPost($lat = null, $lng = null)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }


    public function render()
    {
        return view('livewire.volunteer.dashboard.profile');
    }
}
