<?php

namespace App\Livewire\Requester\Dashboard;

use App\Models\Event;
use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Reviews extends Component
{
    public $reviews;
    public $events;

    public function mount()
    {
        // Get all event IDs organized by this requester
        $eventIds = Auth::user()->events()->pluck('id');

        // Get all reviews from the event_user pivot table for these events
        $this->reviews = Review::query()
            ->whereIn('event_id', $eventIds)
            ->whereNotNull('review')
            ->whereNotNull('rating')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($review) {
                return (object) [
                    'id' => $review->id,
                    'event_id' => $review->event_id,
                    'user_id' => $review->user_id,
                    'rating' => $review->rating,
                    'review' => $review->review,
                    'created_at' => \Carbon\Carbon::parse($review->created_at),
                    'updated_at' => \Carbon\Carbon::parse($review->updated_at),
                    'user' => User::find($review->user_id),
                    'event' => Event::find($review->event_id),
                ];
            });
       
    }

    public function render()
    {
        return view('livewire.requester.dashboard.reviews', [
            'reviews' => $this->reviews
        ]);
    }
}
