<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use App\Services\FileManager;
use App\Services\GoogleMaps;
use Livewire\Component;

class Leaderboard extends Component
{
    public $users;
    public $authUser;
    public $location = 'Unknown';
    public $profile_picture;
    public $userAttributes;
    public function mount()
    {
        $this->users = User::has('badges') // get only the users who have earned badges
            ->with('attributes')
            ->withSum('badges', 'points') // calculate the total points from badges
            ->orderByDesc('badges_sum_points')
            ->get()
            ->groupBy('badges_sum_points') // group the users with same points into 1 group
            ->sortKeysDesc() // sort the groups by points in descending order
            ->values() // reindex the groups
            ->map(function ($group, $index) {
                return [$index, $group]; // return the group along with its index
            })
            ->flatMap(function ($pair) { // flatten the groups while assigning ranks
                [$index, $group] = $pair; // get index and group
                $rank = $index + 1; // rank increments by 1 for each group
                return $group->map(function ($user) use ($rank) {
                    $user->rank = $rank; // assign rank to each user in the group
                    return $user;
                });
            });
        
        $this->authUser = User::find(auth()->user()->id)->getAllAttributes();
        if (isset($this->authUser['latitude'], $this->authUser['longitude'])) {
            if ($this->authUser['latitude'] && $this->authUser['longitude']) {
                $this->location = (new GoogleMaps())->getNearestCity($this->authUser['latitude'], $this->authUser['longitude']); // make a instance of GoogleMaps service and get the nearest city
            }
        }
        // if (isset($this->authUser['profile_picture'])) {
        //     $this->profile_picture = (int)$this->authUser['profile_picture'] ?? null;
        //     if ($this->profile_picture) {
        //         $this->profile_picture = FileManager::getTemporaryUrl($this->profile_picture);
        //     }
         
        // }
        
        // dd(auth()->user()->getProfilePicture());



    }

   



    public function render()
    {
        return view('livewire.volunteer.dashboard.leaderboard');
    }
}
