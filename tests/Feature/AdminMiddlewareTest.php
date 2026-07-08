<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->get('/admin/dashboard');

        $response->assertOk();
    }

    public function test_non_admin_gets_403()
    {
        $donatur = User::factory()->create(['role' => 'donatur']);

        $response = $this->actingAs($donatur)
            ->get('/admin/dashboard');

        $response->assertForbidden();
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_all_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $routes = [
            '/admin/campaigns',
            '/admin/sponsorships',
            '/admin/foster-children',
            '/admin/news',
            '/admin/transactions',
            '/admin/users',
            '/admin/profil',
            '/admin/pendiri',
            '/admin/rekap/donasi',
            '/admin/rekap/donatur',
            '/admin/rekap/orang-tua-asuh',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get($route);
            $response->assertOk();
        }
    }

    public function test_donatur_blocked_from_all_admin_routes()
    {
        $donatur = User::factory()->create(['role' => 'donatur']);

        $routes = [
            '/admin/campaigns',
            '/admin/sponsorships',
            '/admin/foster-children',
            '/admin/news',
            '/admin/transactions',
            '/admin/users',
            '/admin/rekap/donasi',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($donatur)->get($route);
            $response->assertForbidden();
        }
    }
}
