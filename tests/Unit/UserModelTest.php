<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_role_attribute()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $donatur = User::factory()->create(['role' => 'donatur']);

        $this->assertEquals('admin', $admin->role);
        $this->assertEquals('donatur', $donatur->role);
    }

    public function test_user_default_role_is_donatur()
    {
        $user = User::factory()->create();

        $this->assertEquals('donatur', $user->role);
    }

    public function test_user_has_donations_relation()
    {
        $user = User::factory()->create(['role' => 'donatur']);

        $this->assertEmpty($user->donations);
    }

    public function test_user_has_sponsorships_relation()
    {
        $user = User::factory()->create(['role' => 'donatur']);

        $this->assertEmpty($user->sponsorships);
    }
}
