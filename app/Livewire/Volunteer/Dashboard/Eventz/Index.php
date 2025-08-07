<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use App\Services\EventRecommenderService;
use App\Services\GoogleMaps;
use Illuminate\Pagination\LengthAwarePaginator;
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
    }

    public function render(EventRecommenderService $eventRecommenderService)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch all events with relationships
        $events = Event::query()
            ->with(['category', 'tags', 'address', 'user'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get(); // Get all events as a collection


        // Get recommended events from the service
        $recommendedEvents = $eventRecommenderService->recommendEventsToUser($user, $events, 50); // Adjust topN as needed


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
}
