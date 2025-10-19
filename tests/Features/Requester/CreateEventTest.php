<?php

namespace Tests\Feature\Requester;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\TestCase;

class CreateEventTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requester = User::factory()->create();
        $this->requester->assignRole('requester');
        Storage::fake('public');
    }

    /** @test */
    public function requester_can_access_create_event_page()
    {
        $response = $this->actingAs($this->requester)->get('/requester/events/create');

        $response->assertStatus(200);
        $response->assertSeeLivewire('requester.dashboard.create-event');
    }

    /** @test */
    public function requester_can_create_event()
    {
        $category = Category::factory()->create();

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('title', 'Beach Cleanup')
            ->set('description', 'Join us to clean the beach')
            ->set('category_id', $category->id)
            ->set('start_date', now()->addDays(7)->format('Y-m-d'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d'))
            ->set('location', 'Miami Beach')
            ->set('volunteers_needed', 20)
            ->call('createEvent')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('events', [
            'user_id' => $this->requester->id,
            'title' => 'Beach Cleanup',
            'volunteers_needed' => 20,
        ]);
    }

    /** @test */
    public function title_is_required()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('title', '')
            ->call('createEvent')
            ->assertHasErrors('title');
    }

    /** @test */
    public function description_is_required()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('description', '')
            ->call('createEvent')
            ->assertHasErrors('description');
    }

    /** @test */
    public function start_date_is_required()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('start_date', '')
            ->call('createEvent')
            ->assertHasErrors('start_date');
    }

    /** @test */
    public function start_date_must_be_in_future()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('start_date', now()->subDays(1)->format('Y-m-d'))
            ->call('createEvent')
            ->assertHasErrors('start_date');
    }

    /** @test */
    public function end_date_must_be_after_start_date()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('start_date', now()->addDays(7)->format('Y-m-d'))
            ->set('end_date', now()->addDays(5)->format('Y-m-d'))
            ->call('createEvent')
            ->assertHasErrors('end_date');
    }

    /** @test */
    public function requester_can_upload_event_image()
    {
        $category = Category::factory()->create();
        $image = UploadedFile::fake()->image('event.jpg');

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('title', 'Beach Cleanup')
            ->set('description', 'Join us')
            ->set('category_id', $category->id)
            ->set('start_date', now()->addDays(7)->format('Y-m-d'))
            ->set('location', 'Miami Beach')
            ->set('image', $image)
            ->call('createEvent')
            ->assertHasNoErrors();

        Storage::disk('public')->assertExists('events/' . $image->hashName());
    }

    /** @test */
    public function requester_can_save_event_as_draft()
    {
        $category = Category::factory()->create();

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('title', 'Draft Event')
            ->set('description', 'Draft description')
            ->set('category_id', $category->id)
            ->call('saveDraft')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('events', [
            'user_id' => $this->requester->id,
            'title' => 'Draft Event',
            'status' => 'draft',
        ]);
    }

    /** @test */
    public function requester_can_add_required_skills()
    {
        $category = Category::factory()->create();

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('title', 'Medical Camp')
            ->set('description', 'Free medical checkup')
            ->set('category_id', $category->id)
            ->set('start_date', now()->addDays(7)->format('Y-m-d'))
            ->set('location', 'Community Center')
            ->set('required_skills', ['nursing', 'first-aid'])
            ->call('createEvent')
            ->assertHasNoErrors();
    }

    /** @test */
    public function volunteers_needed_must_be_positive_number()
    {
        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.create-event')
            ->set('volunteers_needed', -5)
            ->call('createEvent')
            ->assertHasErrors('volunteers_needed');
    }

    /** @test */
    public function non_requester_cannot_create_event()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/requester/events/create');

        $response->assertStatus(403);
    }
}
