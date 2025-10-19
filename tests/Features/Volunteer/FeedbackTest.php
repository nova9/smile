<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use App\Models\Event;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_feedback_page()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/feedback');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.feedback');
    }

    /** @test */
    public function volunteer_can_submit_feedback_for_completed_event()
    {
        $event = Event::factory()->create(['status' => 'completed']);
        $event->participants()->attach($this->volunteer->id);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('rating', 5)
            ->set('comment', 'Great experience!')
            ->call('submitFeedback')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('reviews', [
            'event_id' => $event->id,
            'user_id' => $this->volunteer->id,
            'rating' => 5,
        ]);
    }

    /** @test */
    public function rating_is_required()
    {
        $event = Event::factory()->create(['status' => 'completed']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('comment', 'Good event')
            ->call('submitFeedback')
            ->assertHasErrors('rating');
    }

    /** @test */
    public function rating_must_be_between_1_and_5()
    {
        $event = Event::factory()->create(['status' => 'completed']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('rating', 6)
            ->call('submitFeedback')
            ->assertHasErrors('rating');
    }

    /** @test */
    public function volunteer_cannot_submit_feedback_for_event_they_did_not_attend()
    {
        $event = Event::factory()->create(['status' => 'completed']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('rating', 5)
            ->call('submitFeedback')
            ->assertHasErrors();
    }

    /** @test */
    public function volunteer_cannot_submit_duplicate_feedback()
    {
        $event = Event::factory()->create(['status' => 'completed']);
        $event->participants()->attach($this->volunteer->id);
        
        Review::factory()->create([
            'event_id' => $event->id,
            'user_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('rating', 4)
            ->call('submitFeedback')
            ->assertHasErrors();
    }

    /** @test */
    public function volunteer_can_rate_event_organizer()
    {
        $event = Event::factory()->create(['status' => 'completed']);
        $event->participants()->attach($this->volunteer->id);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.feedback')
            ->set('eventId', $event->id)
            ->set('rating', 5)
            ->set('organizerRating', 4)
            ->set('comment', 'Good organization')
            ->call('submitFeedback')
            ->assertHasNoErrors();
    }
}
