<?php

namespace Tests\Unit;

use App\Models\Campaign;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_campaign_has_transactions_relation()
    {
        $campaign = Campaign::factory()->create();
        $transaction = Transaction::factory()->create(['campaign_id' => $campaign->id]);

        $this->assertInstanceOf(Transaction::class, $campaign->transactions->first());
        $this->assertEquals(1, $campaign->transactions->count());
    }

    public function test_campaign_default_collected_amount_is_zero()
    {
        $campaign = Campaign::factory()->create();

        $this->assertEquals(0, $campaign->collected_amount);
    }

    public function test_campaign_can_be_active_or_completed()
    {
        $active = Campaign::factory()->create(['status' => 'active']);
        $completed = Campaign::factory()->completed()->create();

        $this->assertEquals('active', $active->status);
        $this->assertEquals('completed', $completed->status);
    }
}
