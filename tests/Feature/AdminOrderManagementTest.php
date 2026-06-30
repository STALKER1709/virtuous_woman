<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminOrderManagementTest extends TestCase
{
    use RefreshDatabase;

    private function createOrder(User $user): Order
    {
        return Order::create([
            'order_number' => 'VW-TEST-'.uniqid(),
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => '0600000000',
            'address' => '1 Rue Test',
            'city' => 'Paris',
            'zip' => '75000',
            'country' => 'France',
            'subtotal' => 50,
            'shipping' => 0,
            'total' => 50,
            'payment_method' => 'cod',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_update_an_order_status(): void
    {
        Mail::fake();

        $admin = User::factory()->create(['utype' => 'ADM']);
        $customer = User::factory()->create();
        $order = $this->createOrder($customer);

        $response = $this->actingAs($admin)->put("/admin/order/{$order->id}/status", [
            'status' => 'shipped',
        ]);

        $response->assertRedirect(route('admin.order.details', $order->id));
        $this->assertSame('shipped', $order->fresh()->status);
        Mail::assertQueued(\App\Mail\OrderStatusUpdated::class);
    }

    public function test_regular_user_cannot_update_an_order_status(): void
    {
        $user = User::factory()->create(['utype' => 'USR']);
        $order = $this->createOrder($user);

        $response = $this->actingAs($user)->put("/admin/order/{$order->id}/status", [
            'status' => 'shipped',
        ]);

        $response->assertRedirect('/login');
        $this->assertSame('pending', $order->fresh()->status);
    }

    public function test_invalid_status_is_rejected(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $order = $this->createOrder($admin);

        $response = $this->actingAs($admin)->put("/admin/order/{$order->id}/status", [
            'status' => 'not-a-real-status',
        ]);

        $response->assertSessionHasErrors('status');
    }
}
