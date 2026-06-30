<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderInvoiceTest extends TestCase
{
    use RefreshDatabase;

    private function createOrder(User $user, string $orderNumber): Order
    {
        return Order::create([
            'order_number' => $orderNumber,
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
            'status' => 'delivered',
        ]);
    }

    public function test_user_can_download_their_order_invoice_as_a_pdf(): void
    {
        $user = User::factory()->create();
        $order = $this->createOrder($user, 'VW-INV-1');

        $response = $this->actingAs($user)->get("/account-orders/{$order->order_number}/invoice");

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }

    public function test_user_cannot_download_another_users_invoice(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $order = $this->createOrder($owner, 'VW-INV-2');

        $response = $this->actingAs($intruder)->get("/account-orders/{$order->order_number}/invoice");

        $response->assertStatus(404);
    }

    public function test_guest_cannot_download_an_invoice(): void
    {
        $user = User::factory()->create();
        $order = $this->createOrder($user, 'VW-INV-3');

        $response = $this->get("/account-orders/{$order->order_number}/invoice");

        $response->assertRedirect('/login');
    }
}
