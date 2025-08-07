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



    public $tags = [];
    public $availableTags;
    public $resources;

    public $notes;

    public $minimum_age;

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
            'skills' => 'required|string|max:500',
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
