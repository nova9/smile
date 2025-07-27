<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Event;
use Livewire\WithPagination;

class VolunteerManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    public function render()
    {
        $volunteers = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['badges', 'participatingEvents'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //  total badges earned by all volunteers
        $total_badges_earned = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })->withCount('badges')->get()->sum('badges_count');

        $stats = [
            'total_volunteers' => User::whereHas('role', function ($query) {
                $query->where('name', 'volunteer');
            })->count(),
            'total_badges' => $total_badges_earned,
            'total_hours' => Event::whereHas('users', function ($query) {
                $query->whereHas('role', function ($q) {
                    $q->where('name', 'volunteer');
                });
            })->sum('duration_hours') ?? 0
        ];

        return view('livewire.admin.dashboard.volunteerManagement', [
            'volunteers' => $volunteers,
            'stats' => $stats
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
}
