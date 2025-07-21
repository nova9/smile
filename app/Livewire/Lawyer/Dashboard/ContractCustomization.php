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

        return view('livewire.lawyer.dashboard.contract-customization', compact('stats', 'templates'));
    }
}
