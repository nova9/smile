<?php

namespace Tests\Feature\Lawyer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class LegalQATest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lawyer = User::factory()->create();
        $this->lawyer->assignRole('lawyer');
    }

    /** @test */
    public function lawyer_can_access_legal_qa_page()
    {
        $response = $this->actingAs($this->lawyer)->get('/lawyer/legal-qa');

        $response->assertStatus(200);
        $response->assertSeeLivewire('lawyer.dashboard.legal-qa');
    }

    /** @test */
    public function lawyer_can_view_all_questions()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.legal-qa')
            ->call('loadQuestions')
            ->assertHasNoErrors();
    }

    /** @test */
    public function lawyer_can_answer_question()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.legal-qa')
            ->set('questionId', 1)
            ->set('answer', 'According to the law, you should...')
            ->call('submitAnswer')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('legal_answers', [
            'question_id' => 1,
            'lawyer_id' => $this->lawyer->id,
        ]);
    }

    /** @test */
    public function answer_content_is_required()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.legal-qa')
            ->set('questionId', 1)
            ->set('answer', '')
            ->call('submitAnswer')
            ->assertHasErrors('answer');
    }

    /** @test */
    public function lawyer_can_mark_answer_as_accepted()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.legal-qa')
            ->set('answerId', 1)
            ->call('acceptAnswer')
            ->assertHasNoErrors();
    }

    /** @test */
    public function lawyer_can_filter_questions_by_tag()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.legal-qa')
            ->set('tagFilter', 'contract-law')
            ->call('filterQuestions')
            ->assertHasNoErrors();
    }

    /** @test */
    public function non_lawyer_cannot_access_legal_qa()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/lawyer/legal-qa');

        $response->assertStatus(403);
    }
}
