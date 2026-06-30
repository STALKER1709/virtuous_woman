<?php

namespace Tests\Unit;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_unexpired_coupon_with_uses_left_is_valid(): void
    {
        $coupon = Coupon::factory()->create([
            'active' => true,
            'expires_at' => now()->addDay(),
            'max_uses' => 5,
            'times_used' => 1,
        ]);

        $this->assertTrue($coupon->isValid());
    }

    public function test_inactive_coupon_is_invalid(): void
    {
        $coupon = Coupon::factory()->create(['active' => false]);

        $this->assertFalse($coupon->isValid());
    }

    public function test_expired_coupon_is_invalid(): void
    {
        $coupon = Coupon::factory()->create(['expires_at' => now()->subDay()]);

        $this->assertFalse($coupon->isValid());
    }

    public function test_coupon_with_no_uses_left_is_invalid(): void
    {
        $coupon = Coupon::factory()->create(['max_uses' => 3, 'times_used' => 3]);

        $this->assertFalse($coupon->isValid());
    }

    public function test_coupon_with_unlimited_uses_is_valid(): void
    {
        $coupon = Coupon::factory()->create(['max_uses' => null, 'times_used' => 1000]);

        $this->assertTrue($coupon->isValid());
    }
}
