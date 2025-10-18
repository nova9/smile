<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Task;
use App\Models\User;
use App\Services\Favorite;
use App\Services\GoogleMaps;
use App\Services\Notifications\TaskCompletionNotification;
use Livewire\Component;


class Show extends Component
{
    public $event;
    public $location;
    public $tasks;
    public $taskStatus = [];
    public $filteredVolunteers = [];

    public $volunteers;
    public $genderFilter;
    public $searchFilter;

    public $is_favorited;

    public function mount($id)
    {
        $this->event = auth()->user()->organizingEvents()->with('users', 'category')->find($id);
        $this->loadVolunteers();
        $this->is_favorited = $this->event->isFavourite();
    }

    public function toggleFavorite()
    {
        Favorite::toggleFavorite($this->event->id, auth()->id());
        $this->is_favorited = !$this->is_favorited;
    }

    public function loadVolunteers()
    {
        $query = $this->event->users()
            ->wherePivotNotIn('status', ['rejected'])
            ->orderByPivot('status', 'desc')
            ->orderByPivot('created_at');

        if ($this->genderFilter) {
            $query->whereHas('attributes', function ($query) {
                $query->where('attributes.id', 5)->where('attribute_user.value', $this->genderFilter);
            });
        }

        if ($this->searchFilter) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->searchFilter . '%')
                  ->orWhere('users.email', 'like', '%' . $this->searchFilter . '%');
            });
        }

        $this->volunteers = $query->get();
    }

    public function approve($userId)
    {
        $this->event->users()->updateExistingPivot($userId, ['status' => 'accepted']);
        $this->loadVolunteers();
    }

    public function decline($userId)
    {
        $this->event->users()->updateExistingPivot($userId, ['status' => 'rejected']);
        $this->loadVolunteers();
    }

    public function render()
    {
        $this->loadVolunteers();

        return view('livewire.requester.dashboard.my-events.show');
    }
}
