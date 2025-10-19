<?php

namespace Tests\Feature\Lawyer;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ContractDraftingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lawyer = User::factory()->create();
        $this->lawyer->assignRole('lawyer');
    }

    /** @test */
    public function lawyer_can_access_contract_drafting_page()
    {
        $response = $this->actingAs($this->lawyer)->get('/lawyer/contract-drafting');

        $response->assertStatus(200);
        $response->assertSeeLivewire('lawyer.dashboard.contract-drafting');
    }

    /** @test */
    public function lawyer_can_create_contract_from_template()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('templateId', 1)
            ->set('title', 'Volunteer Agreement')
            ->call('createFromTemplate')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contracts', [
            'lawyer_id' => $this->lawyer->id,
            'title' => 'Volunteer Agreement',
        ]);
    }

    /** @test */
    public function lawyer_can_insert_clause_from_library()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('contractId', 1)
            ->set('clauseId', 5)
            ->call('insertClause')
            ->assertHasNoErrors();
    }

    /** @test */
    public function lawyer_can_save_contract_version()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('contractId', $contract->id)
            ->set('content', 'Updated contract content')
            ->call('saveVersion')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contract_versions', [
            'contract_id' => $contract->id,
        ]);
    }

    /** @test */
    public function lawyer_can_compare_contract_versions()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('contractId', $contract->id)
            ->set('versionA', 1)
            ->set('versionB', 2)
            ->call('compareVersions')
            ->assertHasNoErrors();
    }

    /** @test */
    public function contract_title_is_required()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('title', '')
            ->call('createContract')
            ->assertHasErrors('title');
    }

    /** @test */
    public function lawyer_can_search_clause_library()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.contract-drafting')
            ->set('searchQuery', 'confidentiality')
            ->call('searchClauses')
            ->assertSet('clauses', function ($clauses) {
                return is_countable($clauses);
            });
    }

    /** @test */
    public function non_lawyer_cannot_access_contract_drafting()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/lawyer/contract-drafting');

        $response->assertStatus(403);
    }
}
