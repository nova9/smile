<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Resource;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Carbon\Carbon;

class Edit extends Component
{
    #[Validate]
    public $name;

    public $category_id;
    public $categories;
    public $event;

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


//    public $storedtags;
    public $tags = [];
    public $availableTags;
    public $newTag = '';


    public $notes;

    public $minimum_age;

    public $resources;

    public $event_resources = [];

    public function mount($id)
    {
        $this->resources = Resource::all();
        $this->event = auth()->user()->organizingEvents()->find($id);
        $this->categories = Category::all();
        $this->availableTags = Tag::all();

        $this->name = $this->event['name'];
        $this->description = $this->event['description'];
        $this->starts_at = $this->event->starts_at
            ? Carbon::parse($this->event->starts_at)->format('Y-m-d\TH:i')
            : '';

        $this->ends_at = $this->event->ends_at
            ? Carbon::parse($this->event->ends_at)->format('Y-m-d\TH:i')
            : '';
        $this->latitude = $this->event['latitude'];
        $this->longitude = $this->event['longitude'];
        $this->skills = $this->event['skills'];
//        $this->storedtags = $this->event->tags()->wherePivot('event_id',$id)->get();
        $this->notes = $this->event['notes'];
        $this->minimum_age = $this->event['minimum_age'];
        $this->maximum_participants = $this->event['maximum_participants'];
        $this->category_id = $this->event['category_id'];
        $this->tags = $this->event->tags->pluck('name')->toArray();
        $this->availableTags = Tag::all()->pluck('name')->sort()->values();

//        $this->event_resources = $this->event->resources;

        $this->event_resources = $this->event->resources->map(function ($resource) {
            return [
                'resource_id' => $resource->id,
                'quantity' => $resource->pivot->quantity,
            ];
        })->values()->toArray();
//        dd($this->event_resources);
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
            'notes' => 'nullable|string|max:500',
            'minimum_age' => 'integer|min:0|max:120',
            'event_resources' => 'array',
            'event_resources.*.resource_id' => 'nullable|exists:resources,id',
            'event_resources.*.quantity' => 'nullable|integer|min:1',
            'event_resources.*.is_custom' => 'nullable|boolean',
            'event_resources.*.custom_name' => 'nullable|string|max:255',
            'event_resources.*.custom_unit' => 'nullable|string|max:50',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->event->update([
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
            'skills' => $this->skills
        ]);


        // create new tags if they don't exist
        $tagIds = [];
        foreach ($this->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }


        $this->event->tags()->sync($tagIds);

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
            } // add existing ids to resourceIdsd
            else {
                $resources[$resource['resource_id']] = [
                    'quantity' => $resource['quantity'],
                ];
            }
        }

        $this->event->resources()->sync($resources);
    }

    #[On('coordinates')]
    public function handleNewPost($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    public function addTag()
    {
        if (empty(trim($this->newTag))) {
            return;
        }

        $tagName = trim($this->newTag);

        // Check if tag already exists in the selected tags
        if (!in_array($tagName, $this->tags)) {
            $this->tags[] = $tagName;
        }

        $this->newTag = '';
    }

    public function addExistingTag($tagName)
    {
        if (!in_array($tagName, $this->tags)) {
            $this->tags[] = $tagName;
        }
    }

    public function removeTag($tag)
    {
        $index = array_search($tag, $this->tags);
        if ($index !== false) {
            unset($this->tags[$index]);
            $this->tags = array_values($this->tags); // Re-index array
        }
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.edit');
    }
}
