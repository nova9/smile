<?php

namespace Tests\Feature\Lawyer;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class DigitalSignatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lawyer = User::factory()->create();
        $this->lawyer->assignRole('lawyer');
    }

    /** @test */
    public function lawyer_can_access_digital_signature_page()
    {
        $response = $this->actingAs($this->lawyer)->get('/lawyer/digital-signature');

        $response->assertStatus(200);
        $response->assertSeeLivewire('lawyer.dashboard.digital-signature');
    }

    /** @test */
    public function lawyer_can_initiate_signing_process()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->call('initiateSigning')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contract_signatures', [
            'contract_id' => $contract->id,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function lawyer_can_add_signers_to_contract()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);
        $signer = User::factory()->create();

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->set('signerEmail', $signer->email)
            ->set('signerName', $signer->name)
            ->call('addSigner')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contract_signers', [
            'contract_id' => $contract->id,
            'email' => $signer->email,
        ]);
    }

    /** @test */
    public function lawyer_can_sign_document()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->set('signature', 'lawyer_signature_data')
            ->call('signDocument')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contract_signatures', [
            'contract_id' => $contract->id,
            'user_id' => $this->lawyer->id,
            'signed_at' => now(),
        ]);
    }

    /** @test */
    public function lawyer_can_view_signing_status()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->call('getSigningStatus')
            ->assertSet('signingStatus', function ($status) {
                return in_array($status, ['pending', 'partial', 'complete']);
            });
    }

    /** @test */
    public function lawyer_can_download_signed_contract()
    {
        $contract = Contract::factory()->create([
            'lawyer_id' => $this->lawyer->id,
            'status' => 'signed',
        ]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->call('downloadSignedContract')
            ->assertFileDownloaded();
    }

    /** @test */
    public function signature_is_required_for_signing()
    {
        $contract = Contract::factory()->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->set('signature', '')
            ->call('signDocument')
            ->assertHasErrors('signature');
    }

    /** @test */
    public function lawyer_can_revoke_signature_request()
    {
        $contract = Contract::factory()->create([
            'lawyer_id' => $this->lawyer->id,
            'status' => 'pending_signature',
        ]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.digital-signature')
            ->set('contractId', $contract->id)
            ->call('revokeSignatureRequest')
            ->assertHasNoErrors();

        $this->assertEquals('draft', $contract->fresh()->status);
    }
}
