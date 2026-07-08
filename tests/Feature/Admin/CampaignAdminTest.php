<?php

namespace Tests\Feature\Admin;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CampaignAdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_index_displays_all_campaigns()
    {
        $campaigns = Campaign::factory(3)->create();

        $response = $this->actingAs($this->admin)
            ->get('/admin/campaigns');

        $response->assertOk();
        foreach ($campaigns as $campaign) {
            $response->assertSee($campaign->title);
        }
    }

    public function test_create_displays_the_form()
    {
        $response = $this->actingAs($this->admin)
            ->get('/admin/campaigns/create');

        $response->assertOk();
    }

    public function test_store_creates_a_new_campaign()
    {
        Storage::fake('public');

        $data = [
            'title' => 'Test Campaign Baru',
            'description' => 'Deskripsi campaign test',
            'target_amount' => 50000000,
            'image' => UploadedFile::fake()->image('campaign.jpg'),
        ];

        $response = $this->actingAs($this->admin)
            ->post('/admin/campaigns', $data);

        $response->assertRedirect('/admin/campaigns');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('campaigns', [
            'title' => 'Test Campaign Baru',
            'slug' => 'test-campaign-baru',
            'target_amount' => 50000000,
            'collected_amount' => 0,
            'status' => 'active',
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/campaigns', []);

        $response->assertSessionHasErrors(['title', 'description', 'target_amount', 'image']);
    }

    public function test_show_displays_a_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get("/admin/campaigns/{$campaign->id}");

        $response->assertOk();
        $response->assertSee($campaign->title);
    }

    public function test_update_modifies_a_campaign()
    {
        $campaign = Campaign::factory()->create();

        $data = [
            'title' => 'Judul Campaign Diubah',
            'description' => 'Deskripsi setelah diedit',
            'target_amount' => 75000000,
        ];

        $response = $this->actingAs($this->admin)
            ->put("/admin/campaigns/{$campaign->id}", $data);

        $response->assertRedirect('/admin/campaigns');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'title' => 'Judul Campaign Diubah',
            'slug' => 'judul-campaign-diubah',
            'target_amount' => 75000000,
        ]);
    }

    public function test_destroy_deletes_a_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete("/admin/campaigns/{$campaign->id}");

        $response->assertRedirect('/admin/campaigns');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    }

    public function test_donatur_cannot_create_campaign()
    {
        $donatur = User::factory()->create(['role' => 'donatur']);

        $response = $this->actingAs($donatur)
            ->get('/admin/campaigns/create');

        $response->assertForbidden();
    }
}
