<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class LegalQa extends Component
{
    public function render()
    {
        $stats = [
            'total_questions' => 45,
            'pending_questions' => 8,
            'answered_questions' => 35,
            'avg_response_time' => '4 hrs'
        ];

        $questions = [
            [
                'id' => 1,
                'title' => 'Employment Contract Termination Rights',
                'client_name' => 'Sarah Johnson',
                'category' => 'employment_law',
                'status' => 'pending',
                'submitted_date' => '2024-01-20',
                'question' => 'I have been working for a company for 3 years under a fixed-term contract. My employer wants to terminate my contract early without cause. What are my rights and what compensation am I entitled to?',
                'answer' => null
            ],
            [
                'id' => 2,
                'title' => 'Partnership Agreement Dissolution',
                'client_name' => 'Michael Brown',
                'category' => 'corporate_law',
                'status' => 'answered',
                'submitted_date' => '2024-01-18',
                'question' => 'My business partner and I want to dissolve our partnership. We have a partnership agreement but it doesn\'t clearly specify the dissolution process. What steps should we take?',
                'answer' => 'For partnership dissolution, you should follow these key steps: 1) Review your partnership agreement for any dissolution clauses, 2) Settle all partnership debts and obligations, 3) Distribute remaining assets according to the partnership agreement or state law, 4) File dissolution paperwork with the state, 5) Notify creditors and clients. I recommend consulting with a local attorney to ensure all legal requirements are met.'
            ],
            [
                'id' => 3,
                'title' => 'Non-Disclosure Agreement Violation',
                'client_name' => 'Emily Davis',
                'category' => 'contract_law',
                'status' => 'pending',
                'submitted_date' => '2024-01-19',
                'question' => 'A former employee has violated their NDA by sharing confidential client information with our competitor. What legal actions can we take and what damages can we claim?',
                'answer' => null
            ],
            [
                'id' => 4,
                'title' => 'Child Custody Modification Request',
                'client_name' => 'David Wilson',
                'category' => 'family_law',
                'status' => 'answered',
                'submitted_date' => '2024-01-15',
                'question' => 'I need to modify my child custody arrangement due to a job relocation. What grounds do I need to show the court and what is the process?',
                'answer' => 'To modify child custody, you must demonstrate a significant change in circumstances that affects the child\'s best interests. Job relocation can be valid grounds if: 1) The move is necessary for employment, 2) It provides better opportunities for you and the child, 3) You propose a reasonable visitation plan for the other parent. File a petition with the court, serve the other parent, and be prepared to show how the move benefits the child.'
            ],
            [
                'id' => 5,
                'title' => 'Breach of Service Contract',
                'client_name' => 'Lisa Anderson',
                'category' => 'contract_law',
                'status' => 'pending',
                'submitted_date' => '2024-01-22',
                'question' => 'A vendor failed to deliver services as specified in our contract. They delivered late and the quality was below standards. What remedies do we have under contract law?',
                'answer' => null
            ],
            [
                'id' => 6,
                'title' => 'Corporate Liability for Employee Actions',
                'client_name' => 'James Miller',
                'category' => 'corporate_law',
                'status' => 'answered',
                'submitted_date' => '2024-01-12',
                'question' => 'One of our employees caused a car accident while making deliveries. Is our company liable for damages? We have commercial insurance but want to understand our legal exposure.',
                'answer' => 'Generally, employers can be held liable for employee actions under the doctrine of "respondeat superior" when the employee was acting within the scope of their employment. Since your employee was making deliveries (job-related activity), your company could be liable. Your commercial insurance should cover this, but ensure you report the incident promptly and cooperate with the investigation.'
            ]
        ];

        return view('livewire.lawyer.dashboard.legal-qa', compact('stats', 'questions'));
    }
}
