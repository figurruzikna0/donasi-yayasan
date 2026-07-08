<?php

namespace Tests\Feature;

use App\Models\FosterChild;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SponsorshipTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $donatur;
    private FosterChild $child;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->donatur = User::factory()->create(['role' => 'donatur']);
        $this->child = FosterChild::factory()->create(['status' => 'Tersedia']);
    }

    public function test_admin_can_approve_sponsorship()
    {
        $sponsorship = Sponsorship::factory()->create([
            'foster_child_id' => $this->child->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->patch("/admin/sponsorships/{$sponsorship->order_id}/approve");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sponsorships', [
            'id' => $sponsorship->id,
            'status' => 'success',
        ]);

        $this->assertEquals('Diasuh', $this->child->fresh()->status);
    }

    public function test_approve_sets_dates_when_null()
    {
        $sponsorship = Sponsorship::factory()->create([
            'foster_child_id' => $this->child->id,
            'status' => 'pending',
            'starts_at' => null,
            'expires_at' => null,
        ]);

        $this->actingAs($this->admin)
            ->patch("/admin/sponsorships/{$sponsorship->order_id}/approve");

        $sponsorship->refresh();

        $this->assertNotNull($sponsorship->starts_at);
        $this->assertNotNull($sponsorship->expires_at);
        $this->assertTrue($sponsorship->expires_at->isFuture());
    }

    public function test_admin_can_delete_sponsorship()
    {
        $sponsorship = Sponsorship::factory()->create([
            'foster_child_id' => $this->child->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->delete("/admin/sponsorships/{$sponsorship->order_id}");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('sponsorships', ['id' => $sponsorship->id]);
    }

    public function test_sponsorship_is_active_returns_true()
    {
        $sponsorship = Sponsorship::factory()->active()->create();

        $this->assertTrue($sponsorship->isActive());
    }

    public function test_sponsorship_is_active_returns_false_when_expired()
    {
        $sponsorship = Sponsorship::factory()->expired()->create();

        $this->assertFalse($sponsorship->isActive());
    }

    public function test_sponsorship_is_active_returns_false_when_pending()
    {
        $sponsorship = Sponsorship::factory()->create(['status' => 'pending']);

        $this->assertFalse($sponsorship->isActive());
    }

    public function test_donatur_can_create_sponsorship()
    {
        $data = [
            'donor_name' => 'Donatur Test',
            'donor_email' => 'donatur@test.com',
            'donor_phone' => '081234567890',
            'amount' => 200000,
            'paket_komitmen' => 'Reguler',
            'description' => 'Semoga berkah',
            'payment_method' => 'QRIS Yayasan',
        ];

        $response = $this->actingAs($this->donatur)
            ->post("/foster-children/{$this->child->id}/sponsor", $data);

        $response->assertOk();

        $this->assertDatabaseHas('sponsorships', [
            'foster_child_id' => $this->child->id,
            'user_id' => $this->donatur->id,
            'donor_name' => 'Donatur Test',
            'amount' => 200000,
            'package' => 'Reguler',
            'status' => 'pending',
        ]);
    }

    public function test_donatur_phone_is_normalized_to_international_format()
    {
        $sponsorship = Sponsorship::factory()->create([
            'donor_phone' => '081234567890',
        ]);

        $this->assertStringStartsWith('62', $sponsorship->donor_phone);
        $this->assertEquals('6281234567890', $sponsorship->donor_phone);
    }
}
