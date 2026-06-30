<?php

namespace Tests\Unit;

use App\Http\Controllers\CheckoutController;
use App\Models\Coupon;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class CheckoutCalculationsTest extends TestCase
{
    private function call(string $method, array $args): mixed
    {
        $controller = new CheckoutController();
        $reflection = new ReflectionMethod($controller, $method);
        $reflection->setAccessible(true);

        return $reflection->invokeArgs($controller, $args);
    }

    public function test_shipping_is_free_above_threshold(): void
    {
        $this->assertSame(0.0, $this->call('shippingFee', [75.0, 'France']));
        $this->assertSame(0.0, $this->call('shippingFee', [100.0, 'Germany']));
    }

    public function test_shipping_uses_france_rate_below_threshold(): void
    {
        $this->assertSame(4.99, $this->call('shippingFee', [50.0, 'France']));
    }

    public function test_shipping_uses_eu_rate_for_other_countries_below_threshold(): void
    {
        $this->assertSame(9.99, $this->call('shippingFee', [50.0, 'Germany']));
    }

    public function test_vat_amount_is_extracted_from_vat_inclusive_total(): void
    {
        // 120 inclusive of 20% VAT => 20 of VAT.
        $this->assertSame(20.0, $this->call('vatAmount', [120.0]));
    }

    public function test_discount_for_null_coupon_is_zero(): void
    {
        $this->assertSame(0.0, $this->call('discountFor', [null, 100.0]));
    }

    public function test_discount_for_percent_coupon(): void
    {
        $coupon = new Coupon(['type' => 'percent', 'value' => 10]);

        $this->assertSame(10.0, $this->call('discountFor', [$coupon, 100.0]));
    }

    public function test_discount_for_fixed_coupon_is_capped_at_subtotal(): void
    {
        $coupon = new Coupon(['type' => 'fixed', 'value' => 200]);

        $this->assertSame(50.0, $this->call('discountFor', [$coupon, 50.0]));
    }
}
