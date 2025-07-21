<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class LegalQA extends Component
{
    public $pendingQuestions;
    public $answeredQuestions;

    public function mount()
    {
        $this->pendingQuestions = [
            [
                'id' => 1,
                'question' => 'What are the legal requirements for terminating an employment contract?',
                'client' => 'TechCorp Ltd',
                'category' => 'Employment Law',
                'submitted_at' => '2 hours ago',
                'priority' => 'medium'
            ],
            [
                'id' => 2,
                'question' => 'How to structure a partnership agreement for a startup?',
                'client' => 'StartupXYZ',
                'category' => 'Corporate Law',
                'submitted_at' => '5 hours ago',
                'priority' => 'high'
            ]
        ];

        $this->answeredQuestions = [
            [
                'question' => 'What are the key clauses in a service agreement?',
                'client' => 'ABC Corp',
                'answered_at' => '1 day ago',
                'status' => 'satisfied'
            ],
            [
                'question' => 'Legal implications of remote work policies?',
                'client' => 'Global Ventures',
                'answered_at' => '3 days ago',
                'status' => 'follow_up_needed'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.legal-qa');
    }
}
