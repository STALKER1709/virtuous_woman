<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCouponManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_coupon(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);

        $response = $this->actingAs($admin)->post('/admin/coupon/store', [
            'code' => 'newyear',
            'type' => 'percent',
            'value' => 15,
        ]);

        $response->assertRedirect(route('admin.coupons'));
        $this->assertDatabaseHas('coupons', ['code' => 'NEWYEAR', 'active' => 1]);
    }

    public function test_duplicate_coupon_code_is_rejected(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        Coupon::factory()->create(['code' => 'DUPLICATE']);

        $response = $this->actingAs($admin)->post('/admin/coupon/store', [
            'code' => 'DUPLICATE',
            'type' => 'percent',
            'value' => 10,
        ]);

        $response->assertSessionHasErrors('code');
    }

    public function test_admin_can_toggle_a_coupon_active_state(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $coupon = Coupon::factory()->create(['active' => true]);

        $this->actingAs($admin)->put("/admin/coupon/{$coupon->id}/toggle");

        $this->assertFalse((bool) $coupon->fresh()->active);
    }

    public function test_regular_user_cannot_create_a_coupon(): void
    {
        $user = User::factory()->create(['utype' => 'USR']);

        $response = $this->actingAs($user)->post('/admin/coupon/store', [
            'code' => 'BLOCKED',
            'type' => 'percent',
            'value' => 10,
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('coupons', ['code' => 'BLOCKED']);
    }
}
