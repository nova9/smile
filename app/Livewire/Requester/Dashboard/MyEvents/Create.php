<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Jobs\GenerateEmbedding;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Resource;
use App\Models\Tag;
use App\Services\EmbeddingService;
use App\Services\GoogleMaps;
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
    
    public function mount()
    {
        $this->categories = Category::all();
        $this->availableTags = Tag::all()->pluck('name')->sort()->values();
        $this->resources = Resource::all();
    }

    protected function rules()
    {
        return [
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
            'participant_requirements' => 'array',
            'recruiting_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
            'minimum_age' => 'integer|min:0|max:120',
        ];
    }

    public function save(GoogleMaps $googleMaps, EmbeddingService $embeddingService)
    {
    
        $this->validate();

        $chat = Chat::query()->create([
            'is_group' => true,
        ]);
        foreach($this->filterTypes as $type){
            if($type == 'gender'){
                $this->participant_requirements[] = [
                    'filter_types' => $type,
                    'male_participants' => $this->male_participants,
                    'female_participants' => $this->female_participants,
                    'non_binary_participants' => $this->non_binary_participants,
                ];
            }else{
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
                $genderSum += (int)($req['male_participants'] ?? 0);
                $genderSum += (int)($req['female_participants'] ?? 0);
                $genderSum += (int)($req['non_binary_participants'] ?? 0);
            }
            if ($req['filter_types'] === 'level') {
                $levelSum += (int)($req['beginner_participants'] ?? 0);
                $levelSum += (int)($req['intermediate_participants'] ?? 0);
                $levelSum += (int)($req['advanced_participants'] ?? 0);
            }
        }
       
        if ($genderSum > (int)$this->maximum_participants) {
            $this->addError('participant_gender_requirements', 'Total gender participants cannot exceed maximum participants.');
            return;
        }
        if ($levelSum > (int)$this->maximum_participants) {
            $this->addError('participant_level_requirements', 'Total level participants cannot exceed maximum participants.');
            return;
        }
        // dd($this->participant_requirements);

        $event = auth()->user()->organizingEvents()->create([
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
            'city' => $googleMaps->getNearestCity($this->latitude, $this->longitude)
        ]);


        GenerateEmbedding::dispatch($event, ['name', 'description', 'skills', 'notes']);



        // create new tags if they don't exist
        $tagIds = [];
        foreach ($this->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }


        if (!empty($this->tags)) {
            $event->tags()->sync($tagIds);
        }

        return redirect('/requester/dashboard/my-events')
            ->with('success', 'Event created successfully!');
    }

    #[On('coordinates')]
    public function handleNewPost($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.create');
    }
}
