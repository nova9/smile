<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\User;
use Livewire\Component;

class Leaderboard extends Component
{
    public $users;
    public $currentUser;
    public $currentUserId;
    public $currentUserPosition;


    public function mount()
    {
        $this->users = User::has('badges')->withSum('badges', 'points')->orderBy('badges_sum_points', 'desc')->get();
        $this->currentUserId = auth()->check() ? auth()->user()->id : null;
        $this->currentUser = $this->users->firstWhere('id', $this->currentUserId);
        $this->currentUserPosition = $this->users->search(function ($user) {
                return $user->id === $this->currentUserId;
            }) + 1;





    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.leaderboard');
    }

}
