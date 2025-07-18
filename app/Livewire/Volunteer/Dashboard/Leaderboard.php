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
    {        $this->users = User::has('badges')
        ->withSum('badges', 'points')
        ->orderBy('badges_sum_points', 'desc')
        ->get();

        $this->currentUserId = auth()->check() ? auth()->user()->id : null;
        $this->currentUser = $this->users->firstWhere('id', $this->currentUserId);
        $this->currentUserPosition = 'No Rank';

        // Calculate ranks for all users
        $rank = 1;
        $previousPoints = null;
        $sameRankCount = 0;
        $hasAssignedRankTwo = false;

        foreach ($this->users as $index => $user) {
            $currentPoints = $user->badges_sum_points ?? 0;

            if ($previousPoints !== null && $currentPoints < $previousPoints) {
                // If we've just finished assigning rank 1, the next rank is 2
                if ($rank == 1 && !$hasAssignedRankTwo) {
                    $rank = 2;
                    $hasAssignedRankTwo = true;
                } else {
                    // For subsequent ranks, increment normally
                    $rank += $sameRankCount;
                }
                $sameRankCount = 1;
            } else {
                $sameRankCount++;
            }

            // Attach rank to the user object
            $this->users[$index]->rank = $rank;

            // Set current user's rank
            if ($this->currentUser && $user->id === $this->currentUserId) {
                $this->currentUserPosition = $rank;
            }

            $previousPoints = $currentPoints;
        }
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.leaderboard');
    }

}
