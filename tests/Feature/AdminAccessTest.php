<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_away_from_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin(): void
    {
        $user = User::factory()->create(['utype' => 'USR']);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_admin_user_can_access_admin(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertOk();
    }
}
