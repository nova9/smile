<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\User;
use Livewire\Component;

class Leaderboard extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::has('badges')
            ->withSum('badges', 'points')
            ->orderByDesc('badges_sum_points')
            ->get()
            ->groupBy('badges_sum_points')
            ->sortKeysDesc()
            ->values()
            ->map(function ($group, $index) {
                return [$index, $group];
            })
            ->flatMap(function ($pair) {
                [$index, $group] = $pair;
                $rank = $index + 1; // rank increments by 1 for each group
                return $group->map(function ($user) use ($rank) {
                    $user->rank = $rank;
                    return $user;
                });
            });
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.leaderboard');
    }

}
