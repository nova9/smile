<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ReviewsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_reviews_page()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/reviews');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.reviews');
    }

    /** @test */
    public function volunteer_can_see_reviews_they_received()
    {
        Review::factory()->count(3)->create([
            'reviewee_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->call('loadReceivedReviews')
            ->assertSet('receivedReviews', function ($reviews) {
                return count($reviews) === 3;
            });
    }

    /** @test */
    public function volunteer_can_see_reviews_they_gave()
    {
        Review::factory()->count(2)->create([
            'user_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->call('loadGivenReviews')
            ->assertSet('givenReviews', function ($reviews) {
                return count($reviews) === 2;
            });
    }

    /** @test */
    public function volunteer_can_respond_to_review()
    {
        $review = Review::factory()->create([
            'reviewee_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->set('reviewId', $review->id)
            ->set('response', 'Thank you for the feedback!')
            ->call('respondToReview')
            ->assertHasNoErrors();

        $this->assertNotNull($review->fresh()->response);
    }

    /** @test */
    public function volunteer_can_dispute_review()
    {
        $review = Review::factory()->create([
            'reviewee_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->set('reviewId', $review->id)
            ->set('disputeReason', 'This review is unfair')
            ->call('disputeReview')
            ->assertHasNoErrors();

        $this->assertEquals('disputed', $review->fresh()->status);
    }

    /** @test */
    public function volunteer_can_view_average_rating()
    {
        Review::factory()->count(5)->create([
            'reviewee_id' => $this->volunteer->id,
            'rating' => 4,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->call('loadAverageRating')
            ->assertSet('averageRating', function ($rating) {
                return $rating == 4;
            });
    }

    /** @test */
    public function volunteer_cannot_respond_to_other_users_reviews()
    {
        $otherUser = User::factory()->create();
        $review = Review::factory()->create([
            'reviewee_id' => $otherUser->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.reviews')
            ->set('reviewId', $review->id)
            ->set('response', 'My response')
            ->call('respondToReview')
            ->assertForbidden();
    }
}
