<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ApprovalWorkflow extends Component
{
    public $pendingApprovals;
    public $approvalHistory;

    public function mount()
    {
        $this->pendingApprovals = [
            [
                'id' => 1,
                'title' => 'Community Clean-up Initiative',
                'organization' => 'Green Earth Foundation',
                'service_type' => 'Environmental Conservation',
                'duration' => '3 months (weekends)',
                'contact_person' => 'Sarah Johnson',
                'email' => 'sarah@greenearth.org',
                'phone' => '+1 (555) 123-4567',
                'submitted_at' => '2 hours ago',
                'priority' => 'high',
                'status' => 'pending',
                'description' => 'We are seeking dedicated volunteers to help with our community clean-up initiative. This program aims to clean public spaces, parks, and waterways while educating the community about environmental conservation. Volunteers will work in teams to collect waste, plant native species, and conduct educational workshops for local schools.'
            ],
            [
                'id' => 2,
                'title' => 'Youth Mentorship Program',
                'organization' => 'Future Leaders Academy',
                'service_type' => 'Education & Mentoring',
                'duration' => '6 months (2 hours/week)',
                'contact_person' => 'Michael Chen',
                'email' => 'michael@futureleaders.org',
                'phone' => '+1 (555) 987-6543',
                'submitted_at' => '1 day ago',
                'priority' => 'medium',
                'status' => 'under_review',
                'description' => 'Our youth mentorship program pairs volunteers with at-risk teenagers to provide guidance, academic support, and life skills training. Mentors will meet with their mentees weekly, help with homework, career planning, and personal development. This program has shown significant success in improving graduation rates and post-secondary enrollment.'
            ],
            [
                'id' => 3,
                'title' => 'Senior Care Support Services',
                'organization' => 'Golden Years Community Center',
                'service_type' => 'Elder Care & Assistance',
                'duration' => '4 months (flexible schedule)',
                'contact_person' => 'Emma Rodriguez',
                'email' => 'emma@goldenyears.org',
                'phone' => '+1 (555) 456-7890',
                'submitted_at' => '3 hours ago',
                'priority' => 'high',
                'status' => 'pending',
                'description' => 'We need compassionate volunteers to assist elderly community members with daily activities, companionship, and basic care. Services include grocery shopping, medication reminders, light housekeeping, and providing social interaction. Volunteers will be matched with seniors based on compatibility and availability.'
            ]
        ];

        $this->approvalHistory = [
            [
                'title' => 'Food Bank Distribution Program',
                'organization' => 'City Food Bank',
                'decided_at' => '3 days ago',
                'status' => 'approved',
                'reason' => null
            ],
            [
                'title' => 'Animal Shelter Volunteer Program',
                'organization' => 'Happy Paws Shelter',
                'decided_at' => '1 week ago',
                'status' => 'changes_requested',
                'reason' => 'Need clearer liability coverage and volunteer training protocols'
            ],
            [
                'title' => 'Homeless Outreach Initiative',
                'organization' => 'Street Hope Organization',
                'decided_at' => '2 weeks ago',
                'status' => 'rejected',
                'reason' => 'Insufficient safety measures and unclear volunteer supervision'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.approval-workflow');
    }
}
