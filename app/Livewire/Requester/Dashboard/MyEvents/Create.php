<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Jobs\GenerateEmbedding;
use App\Models\Agreement;
use App\Models\Category;
use App\Models\Chat;
use App\Models\ContractRequest;
use App\Models\Resource;
use App\Models\Tag;
use App\Services\EmbeddingService;
use App\Services\GoogleMaps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Create extends Component
{
    #[Validate]
    public $name;

    public $category_id;
    public $categories;

    public $maximum_participants;

    #[Validate]
    public $description;

    #[Validate]
    public $starts_at;

    #[Validate]
    public $ends_at;
    public $latitude;
    public $longitude;

    public $skills;

    public $recruiting_method = '';

    public $tags = [];
    public $availableTags;
    public $resources;
    public $event_resources = [];

    public $notes;

    public $minimum_age;
    public $filterTypes = [];
    public $participant_requirements = [];

    public $male_participants;
    public $female_participants;
    public $non_binary_participants;

    public $beginner_participants;
    public $intermediate_participants;
    public $advanced_participants;

    // Contract request properties
    public $availableAgreements;
    public $selectedAgreementId;
    public $requestContract = false;
    public $contractNotes;
    public $requestAdditionalRequirements = false; // New: for additional requirements request
    public $showTemplateModal = false; // New: for viewing template
    public $viewingAgreement = null; // New: current template being viewed

    public function mount()
    {
        $this->categories = Category::all();
        $this->availableTags = Tag::all()->pluck('name')->sort()->values();
        $this->resources = Resource::all();
        $this->availableAgreements = Agreement::all();
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'maximum_participants' => 'required|integer|min:1',
            'description' => 'required|string|max:1000',
            'tags' => 'array',
            'starts_at' => 'required|date|after_or_equal:today',
            'ends_at' => 'required|date|after:starts_at',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'skills' => 'required|array|min:1',
            'event_resources' => 'array',
            'event_resources.*.resource_id' => 'nullable|exists:resources,id',
            'event_resources.*.quantity' => 'nullable|integer|min:1',
            'event_resources.*.is_custom' => 'nullable|boolean',
            'event_resources.*.custom_name' => 'nullable|string|max:255',
            'event_resources.*.custom_unit' => 'nullable|string|max:50',
            'participant_requirements' => 'array',
            'recruiting_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
            'minimum_age' => 'integer|min:0|max:120',
            'requestContract' => 'nullable|boolean',
            'selectedAgreementId' => 'nullable|exists:agreements,id',
            'requestAdditionalRequirements' => 'nullable|boolean',
        ];

        // Require contractNotes if requesting additional requirements
        if ($this->requestAdditionalRequirements) {
            $rules['contractNotes'] = 'required|string|min:10|max:1000';
        } else {
            $rules['contractNotes'] = 'nullable|string|max:1000';
        }

        return $rules;
    }

    public function save(GoogleMaps $googleMaps, EmbeddingService $embeddingService)
    {
        $this->validate();

        $chat = Chat::query()->create([
            'is_group' => true,
        ]);
        foreach ($this->filterTypes as $type) {
            if ($type == 'gender') {
                $this->participant_requirements[] = [
                    'filter_types' => $type,
                    'male_participants' => $this->male_participants,
                    'female_participants' => $this->female_participants,
                    'non_binary_participants' => $this->non_binary_participants,
                ];
            } else {
                $this->participant_requirements[] = [
                    'filter_types' => $type,
                    'beginner_participants' => $this->beginner_participants,
                    'intermediate_participants' => $this->intermediate_participants,
                    'advanced_participants' => $this->advanced_participants
                ];
            }
        }

        $genderSum = 0;
        $levelSum = 0;

        foreach ($this->participant_requirements as $req) {
            if ($req['filter_types'] === 'gender') {
                $genderSum += (int) ($req['male_participants'] ?? 0);
                $genderSum += (int) ($req['female_participants'] ?? 0);
                $genderSum += (int) ($req['non_binary_participants'] ?? 0);
            }
            if ($req['filter_types'] === 'level') {
                $levelSum += (int) ($req['beginner_participants'] ?? 0);
                $levelSum += (int) ($req['intermediate_participants'] ?? 0);
                $levelSum += (int) ($req['advanced_participants'] ?? 0);
            }
        }

        if ($genderSum > (int) $this->maximum_participants) {
            $this->addError('participant_gender_requirements', 'Total gender participants cannot exceed maximum participants.');
            return;
        }
        if ($levelSum > (int) $this->maximum_participants) {
            $this->addError('participant_level_requirements', 'Total level participants cannot exceed maximum participants.');
            return;
        }
        // dd($this->participant_requirements);

        // Determine if event should be active based on contract request
        $isActive = !($this->requestContract && $this->selectedAgreementId);

        $event = Auth::user()->organizingEvents()->create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'maximum_participants' => $this->maximum_participants,
            'description' => $this->description,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'notes' => $this->notes,
            'minimum_age' => $this->minimum_age,
            'skills' => $this->skills,
            'participant_requirements' => $this->participant_requirements,
            'recruiting_method' => $this->recruiting_method,
            'chat_id' => $chat->id,
            'city' => $googleMaps->getNearestCity($this->latitude, $this->longitude),
            'is_active' => $isActive, // Set based on contract request
        ]);


        GenerateEmbedding::dispatch($event, ['name', 'description', 'skills', 'notes']);



        // create new tags if they don't exist
        $tagIds = [];
        foreach ($this->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        // link tags to the event
        if (!empty($this->tags)) {
            $event->tags()->sync($tagIds);
        }

        // add custom resources to the database
        $resources = [];
        foreach ($this->event_resources as $resource) {
            // create custom resource and add its new id to resourceIds
            if (!empty($resource['is_custom'])) {
                $newResource = Resource::create([
                    'name' => $resource['custom_name'],
                    'unit' => $resource['custom_unit'],
                ]);
                $resources[$newResource->id] = [
                    'quantity' => $resource['quantity'],
                ];
            }
            // add existing ids to resourceIdsd
            else {
                $resources[$resource['resource_id']] = [
                    'quantity' => $resource['quantity'],
                ];
            }
        }

        if (!empty($resources)) {
            $event->resources()->sync($resources);
        }

        // Handle contract request if selected
        if ($this->requestContract && $this->selectedAgreementId) {
            $this->requestContractForEvent($event->id, $this->selectedAgreementId);
        }

        return redirect('/requester/dashboard/my-events')
            ->with('success', 'Event created successfully!' . ($this->requestContract ? ' Contract request has been sent to lawyers. Event will be published after contract approval.' : ''));
    }

    #[On('coordinates')]
    public function handleNewPost($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    /**
     * Format user address from latitude/longitude or custom attribute
     */
    private function formatAddress($user)
    {
        // First, try to get city from attributes
        $city = $user->getCustomAttribute('city');

        // If no city, try to construct from lat/lng
        if (!$city) {
            $lat = $user->getCustomAttribute('latitude');
            $lng = $user->getCustomAttribute('longitude');

            if ($lat && $lng) {
                // Return coordinates as address fallback
                return "Lat: {$lat}, Lng: {$lng}";
            }
        } else {
            return $city;
        }

        return null;
    }

    /**
     * Request a contract for the event
     */
    public function requestContractForEvent($eventId, $agreementId)
    {
        try {
            $user = Auth::user();

            // Get requester details from user's profile attributes
            $requesterDetails = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->getCustomAttribute('contact_number') ?? 'N/A',
                'organization' => $user->getCustomAttribute('description') ?? $user->name,
                'address' => $this->formatAddress($user) ?? 'N/A',
            ];

            // Determine the type of request based on whether additional requirements are requested
            $notes = null;
            if ($this->requestAdditionalRequirements && !empty($this->contractNotes)) {
                $notes = $this->contractNotes;
            }

            // Create the contract request
            ContractRequest::create([
                'event_id' => $eventId,
                'requester_id' => $user->id,
                'agreement_id' => $agreementId,
                'status' => 'pending',
                'requester_details' => $requesterDetails,
                'notes' => $notes, // Will be null for sign requests, filled for custom requests
            ]);

            Log::info('Contract request created', [
                'event_id' => $eventId,
                'requester_id' => $user->id,
                'agreement_id' => $agreementId,
                'type' => $this->requestAdditionalRequirements ? 'custom_requirements' : 'sign_only',
            ]);

            $message = $this->requestAdditionalRequirements
                ? 'Contract customization request sent! A lawyer will review your requirements.'
                : 'Contract signing request sent! A lawyer will review and sign the contract.';

            session()->flash('success', $message);

            // Reset contract form
            $this->selectedAgreementId = null;
            $this->contractNotes = null;
            $this->requestContract = false;
            $this->requestAdditionalRequirements = false;
        } catch (\Exception $e) {
            Log::error('Error creating contract request: ' . $e->getMessage());
            session()->flash('error', 'Failed to send contract request. Please try again.');
        }
    }

    /**
     * View template in modal
     */
    public function viewTemplate($agreementId)
    {
        $this->viewingAgreement = Agreement::find($agreementId);
        $this->showTemplateModal = true;
    }

    /**
     * Close template modal
     */
    public function closeTemplateModal()
    {
        $this->showTemplateModal = false;
        $this->viewingAgreement = null;
    }

    /**
     * Toggle contract request section
     */
    public function toggleContractRequest($agreementId = null)
    {
        $this->requestContract = !$this->requestContract;
        $this->selectedAgreementId = $agreementId;

        if (!$this->requestContract) {
            $this->selectedAgreementId = null;
            $this->contractNotes = null;
        }
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.create');
    }
}
