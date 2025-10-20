<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use App\Services\EventRecommenderService;
use App\Services\Favorite;
use App\Services\GoogleMaps;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Url]
    public $page = 1;


    public function mount(EventRecommenderService $eventRecommenderService)
    {
//        $events = Event::query()
//            ->with(['category', 'tags', 'address', 'user'])->get();
//        dd(auth()->user());
//        dd($eventRecommenderService->recommendEventsToUser(auth()->user(), $events, 10));
        // dd($googleMaps->getNearestCity('7.8731', '80.7718'));
        // $event=Event::find(33);
        // dd($event->getAvgRating());
    }

    public function render(EventRecommenderService $eventRecommenderService)
    {
        // Get the authenticated user
        $user = auth()->user();


        $dob = Carbon::parse(auth()->user()->getCustomAttribute('date_of_birth'));

        // Fetch all events with relationships
        $events = Event::query()
            ->with(['category', 'tags', 'address', 'user'])
            ->where('is_active', true) // Only show active events to volunteers
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->where('minimum_age', '<=', $dob->age) // Filter by user's age
            ->get(); // Get all events as a collection


        // Get recommended events from the service
        $recommendedEvents = $eventRecommenderService->recommendEventsToUser($user, $events, 50); // Adjust topN as needed
        // dd($recommendedEvents);

        // Paginate the recommended events
        $perPage = 12;
        $currentPage = $this->getPage(); // Livewire manages the page property
        $paginatedEvents = $this->paginateCollection($recommendedEvents, $perPage, $currentPage);
        
        return view('livewire.volunteer.dashboard.events.index', [
            'events' => $paginatedEvents
        ]);
    }

    private function paginateCollection(Collection $collection, $perPage, $currentPage)
    {
        $total = $collection->count();
        $items = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            ['path' => url()->current(), 'query' => request()->query()]
        );
    }

    public function toggleFavorite($event_id)
    {
        $favoriteService = Favorite::toggleFavorite($event_id, auth()->id());
        return $favoriteService;
    }
}
