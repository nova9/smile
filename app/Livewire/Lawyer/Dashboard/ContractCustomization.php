<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractCustomization extends Component
{
    public function render()
    {
        $stats = [
            'total_templates' => 25,
            'active_templates' => 18,
            'most_used' => 'VSA',
            'last_modified' => '2 days'
        ];

        $templates = [
            [
                'id' => 1,
                'name' => 'Standard Volunteer Service Agreement',
                'type' => 'Volunteer Service Agreement',
                'status' => 'active',
                'description' => 'Comprehensive template for volunteer service agreements with standard terms and conditions.',
                'usage_count' => 45,
                'last_modified' => '2 days ago',
                'content' => null // Will be generated dynamically
            ],
            [
                'id' => 2,
                'name' => 'Employment Contract - Full Time',
                'type' => 'Employment Contract',
                'status' => 'active',
                'description' => 'Full-time employment contract template with benefits and compensation details.',
                'usage_count' => 32,
                'last_modified' => '5 days ago',
                'content' => null
            ],
            [
                'id' => 3,
                'name' => 'Partnership Agreement - Business',
                'type' => 'Partnership Agreement',
                'status' => 'active',
                'description' => 'Business partnership agreement template for joint ventures and collaborations.',
                'usage_count' => 18,
                'last_modified' => '1 week ago',
                'content' => null
            ],
            [
                'id' => 4,
                'name' => 'Non-Disclosure Agreement - Standard',
                'type' => 'NDA',
                'status' => 'active',
                'description' => 'Standard NDA template for confidentiality agreements.',
                'usage_count' => 28,
                'last_modified' => '3 days ago',
                'content' => null
            ],
            [
                'id' => 5,
                'name' => 'General Contract Template',
                'type' => 'General Contract',
                'status' => 'active',
                'description' => 'Flexible general contract template for various purposes.',
                'usage_count' => 15,
                'last_modified' => '1 week ago',
                'content' => null
            ],
            [
                'id' => 6,
                'name' => 'Short-term Volunteer Agreement',
                'type' => 'Volunteer Service Agreement',
                'status' => 'draft',
                'description' => 'Simplified template for short-term volunteer engagements.',
                'usage_count' => 8,
                'last_modified' => '2 weeks ago',
                'content' => null
            ],
            [
                'id' => 7,
                'name' => 'Consultant Agreement Template',
                'type' => 'Employment Contract',
                'status' => 'archived',
                'description' => 'Template for independent contractor and consultant agreements.',
                'usage_count' => 22,
                'last_modified' => '1 month ago',
                'content' => null
            ]
        ];

        // New: incoming change requests (front-end only mock data)
        $changeRequests = [
            [
                'id' => 1001,
                'template_id' => 1,
                'template_name' => 'Standard Volunteer Service Agreement',
                'organization' => 'Acme Goodwill Foundation',
                'contact_person' => 'Grace Lee',
                'contact_email' => 'grace.lee@acme.org',
                'requested_at' => date('Y-m-d H:i'),
                'status' => 'pending', // pending | approved | rejected
                'priority' => 'high',
                'reason' => 'Update liability clause to reflect event insurance coverage.',
                'current_terms' => "1. The volunteer agrees to perform assigned duties diligently and responsibly.\n2. The organization will provide necessary guidance and a safe work environment.\n3. Confidential information must not be disclosed without consent.\n4. Either party may terminate this agreement with prior notice.",
                'proposed_terms' => "1. The volunteer agrees to perform assigned duties diligently and responsibly.\n2. The organization will provide necessary guidance and a safe work environment, including event insurance coverage where applicable.\n3. Confidential information must not be disclosed without consent.\n4. Either party may terminate this agreement with 7 days prior notice.",
            ],
            [
                'id' => 1002,
                'template_id' => 6,
                'template_name' => 'Short-term Volunteer Agreement',
                'organization' => 'City Food Bank',
                'contact_person' => 'David Chen',
                'contact_email' => 'david.chen@cityfoodbank.org',
                'requested_at' => date('Y-m-d H:i', strtotime('-1 day')),
                'status' => 'pending',
                'priority' => 'medium',
                'reason' => 'Clarify time commitment and add rest breaks during distribution days.',
                'current_terms' => "1. Volunteer services are provided without compensation.\n2. The volunteer will be assigned tasks by the organization.\n3. The volunteer may terminate services at any time with notice.",
                'proposed_terms' => "1. Volunteer services are provided without compensation.\n2. The volunteer will be assigned tasks by the organization, with a maximum of 6 hours per day including rest breaks.\n3. The volunteer may terminate services at any time with 24 hours notice.",
            ],
        ];

        return view('livewire.lawyer.dashboard.contract-customization', compact('stats', 'templates', 'changeRequests'));
    }
}
