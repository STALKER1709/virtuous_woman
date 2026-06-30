<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_apply_a_valid_coupon(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity' => 5, 'regular_price' => 100]);
        $coupon = Coupon::factory()->create(['code' => 'SAVE10', 'type' => 'percent', 'value' => 10]);

        $this->actingAs($user)->post('/cart/add', ['id' => $product->id, 'quantity' => 1]);

        $response = $this->actingAs($user)->post('/checkout/coupon', ['code' => 'save10']);

        $response->assertSessionHas('success');
        $this->assertSame('SAVE10', session('coupon_code'));
    }

    public function test_invalid_coupon_code_is_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/checkout/coupon', ['code' => 'DOESNOTEXIST']);

        $response->assertSessionHasErrors('code');
    }

    public function test_expired_coupon_is_rejected(): void
    {
        $user = User::factory()->create();
        Coupon::factory()->create(['code' => 'OLDCODE', 'expires_at' => now()->subDay()]);

        $response = $this->actingAs($user)->post('/checkout/coupon', ['code' => 'OLDCODE']);

        $response->assertSessionHasErrors('code');
    }
}
