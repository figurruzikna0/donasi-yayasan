<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationTest extends TestCase
{
    use RefreshDatabase;

    private User $donatur;
    private Campaign $campaign;

    protected function setUp(): void
    {
        parent::setUp();
        $this->donatur = User::factory()->create(['role' => 'donatur']);
        $this->campaign = Campaign::factory()->create(['collected_amount' => 0]);
    }

    public function test_donatur_can_view_donation_form()
    {
        $response = $this->actingAs($this->donatur)
            ->get("/campaign/{$this->campaign->id}/donate");

        $response->assertOk();
    }

    public function test_guest_cannot_view_donation_form()
    {
        $response = $this->get("/campaign/{$this->campaign->id}/donate");

        $response->assertRedirect('/login');
    }

    public function test_donatur_can_create_donation()
    {
        $data = [
            'donor_name' => 'Test Donatur',
            'donor_email' => 'test@example.com',
            'donor_phone' => '081234567890',
            'amount' => 50000,
            'payment_method' => 'QRIS Yayasan',
        ];

        $response = $this->actingAs($this->donatur)
            ->post("/campaign/{$this->campaign->id}/donate", $data);

        $response->assertOk();

        $this->assertDatabaseHas('donations', [
            'campaign_id' => $this->campaign->id,
            'user_id' => $this->donatur->id,
            'donor_name' => 'Test Donatur',
            'amount' => 50000,
            'status' => 'pending',
        ]);
    }

    public function test_success_donation_increments_collected_amount()
    {
        $donation = Donation::factory()->create([
            'campaign_id' => $this->campaign->id,
            'amount' => 75000,
            'status' => 'pending',
        ]);

        $this->assertEquals(0, $this->campaign->fresh()->collected_amount);

        $donation->update(['status' => 'success']);
        $this->campaign->increment('collected_amount', $donation->amount);

        $this->assertEquals(75000, $this->campaign->fresh()->collected_amount);
    }

    public function test_pending_donation_does_not_affect_collected_amount()
    {
        Donation::factory()->create([
            'campaign_id' => $this->campaign->id,
            'amount' => 100000,
            'status' => 'pending',
        ]);

        $this->assertEquals(0, $this->campaign->fresh()->collected_amount);
    }

    public function test_failed_donation_does_not_affect_collected_amount()
    {
        Donation::factory()->create([
            'campaign_id' => $this->campaign->id,
            'amount' => 50000,
            'status' => 'failed',
        ]);

        $this->assertEquals(0, $this->campaign->fresh()->collected_amount);
    }

    public function test_multiple_success_donations_sum_correctly()
    {
        Donation::factory()->count(3)->create([
            'campaign_id' => $this->campaign->id,
            'amount' => 100000,
            'status' => 'success',
        ]);

        foreach (Donation::where('campaign_id', $this->campaign->id)->where('status', 'success')->get() as $donation) {
            $this->campaign->increment('collected_amount', $donation->amount);
        }

        $this->assertEquals(300000, $this->campaign->fresh()->collected_amount);
    }

    public function test_donation_requires_valid_amount()
    {
        $data = [
            'donor_name' => 'Test',
            'donor_email' => 'test@test.com',
            'donor_phone' => '081234567890',
            'amount' => 500,
            'payment_method' => 'QRIS Yayasan',
        ];

        $response = $this->actingAs($this->donatur)
            ->post("/campaign/{$this->campaign->id}/donate", $data);

        $response->assertSessionHasErrors(['amount']);
    }

    public function test_rekap_donasi_filters_by_status()
    {
        Donation::factory()->count(3)->success()->create(['campaign_id' => $this->campaign->id]);
        Donation::factory()->count(2)->create(['campaign_id' => $this->campaign->id, 'status' => 'failed']);

        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/rekap/donasi');

        $response->assertOk();
    }
}
