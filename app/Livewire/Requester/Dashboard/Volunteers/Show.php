<?php

namespace App\Livewire\Requester\Dashboard\Volunteers;

use App\Services\Messaging;
use Livewire\Component;
use App\Models\User;

class Show extends Component
{
    public $volunteer;
    public $recentEvents = [];
    public $recentReviews = [];
    public $rating = null;

    public function mount($id)
    {
        $this->volunteer = User::with(['role', 'events', 'reviews', 'badges', 'attributes'])->findOrFail($id);

        // load recent events and reviews
        $this->recentEvents = $this->volunteer->events()->latest()->limit(6)->get();
        $this->recentReviews = $this->volunteer->reviews()->latest()->limit(6)->get();

        $this->rating = $this->volunteer->reviews()->avg('rating') ?: null;
    }

    public function initiateMessage($userId)
    {
        $user = User::findOrFail($userId);
        $isSuccess = Messaging::initializeDirectChatTo(auth()->user(), $user);
        $this->dispatch('openChat', chatId: Messaging::getDirectChatTo(auth()->user(), $user)->id);
    }

    public function render()
    {
        return view('livewire.requester.dashboard.volunteers.show', [
            'volunteer' => $this->volunteer,
            'recentEvents' => $this->recentEvents,
            'recentReviews' => $this->recentReviews,
            'rating' => $this->rating,
        ]);
    }
}
