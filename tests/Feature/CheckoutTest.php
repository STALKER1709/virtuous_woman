<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_checkout(): void
    {
        $response = $this->get('/checkout');

        $response->assertRedirect('/login');
    }

    public function test_user_can_place_an_order_and_stock_is_decremented(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity' => 5, 'regular_price' => 50]);

        $this->actingAs($user)->post('/cart/add', [
            'id' => $product->id,
            'quantity' => 2,
        ])->assertRedirect();

        $response = $this->actingAs($user)->post('/checkout', [
            'name' => 'Jane Doe',
            'email' => $user->email,
            'mobile' => '0612345678',
            'address' => '1 Rue de Paris',
            'city' => 'Paris',
            'zip' => '75000',
            'country' => 'France',
            'payment_method' => 'cod',
            'terms' => '1',
        ]);

        $order = Order::where('user_id', $user->id)->first();

        $this->assertNotNull($order);
        $response->assertRedirect(route('checkout.confirmation', $order->order_number));
        $this->assertSame(1, $order->items()->count());
        $this->assertSame(3, $product->fresh()->quantity);
        Mail::assertQueued(\App\Mail\OrderPlaced::class);
    }

    public function test_checkout_is_rejected_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity' => 1, 'regular_price' => 50]);

        $this->actingAs($user)->post('/cart/add', [
            'id' => $product->id,
            'quantity' => 1,
        ]);

        // Stock sells out from under the cart between add-to-cart and checkout.
        $product->quantity = 0;
        $product->save();

        $response = $this->actingAs($user)->post('/checkout', [
            'name' => 'Jane Doe',
            'email' => $user->email,
            'mobile' => '0612345678',
            'address' => '1 Rue de Paris',
            'city' => 'Paris',
            'zip' => '75000',
            'country' => 'France',
            'payment_method' => 'cod',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors('stock');
        $this->assertSame(0, Order::count());
    }
}
