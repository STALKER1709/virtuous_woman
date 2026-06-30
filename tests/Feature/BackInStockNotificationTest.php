<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackInStockNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_request_a_notification_for_an_out_of_stock_product(): void
    {
        $product = Product::factory()->create(['stock_status' => 'outofstock']);

        $response = $this->post("/shop/{$product->slug}/notify-stock", ['email' => 'fan@example.com']);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('stock_notifications', [
            'product_id' => $product->id,
            'email' => 'fan@example.com',
        ]);
    }

    public function test_cannot_request_a_notification_for_an_in_stock_product(): void
    {
        $product = Product::factory()->create(['stock_status' => 'instock']);

        $response = $this->post("/shop/{$product->slug}/notify-stock", ['email' => 'fan@example.com']);

        $response->assertStatus(403);
    }
}
