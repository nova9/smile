<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Activities extends Component
{
    public $activities;
    public $certificates;
    public $badges;
    public $badgeImgs;
    public $totalBadgePoints;

    public function mount()
    {
        $this->activities = Event::whereHas('users', function ($q) {
            $q->where('user_id', auth()->id());
        })->with('users')->get();
        
        $this->certificates = Event::whereHas('users', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->whereNotNull('ends_at')
            ->with('users')
            ->get();

        $this->badges = User::where('id', auth()->id())->with('badges')->first()?->badges ?? collect();
        $this->totalBadgePoints = $this->badges->sum('points');
        
        
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.activities');
    }
}
