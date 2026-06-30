<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_a_product_to_their_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post('/wishlist/toggle', ['product_id' => $product->id]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('wishlists', ['user_id' => $user->id, 'product_id' => $product->id]);
    }

    public function test_toggling_twice_removes_it_from_the_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]);

        $this->actingAs($user)->post('/wishlist/toggle', ['product_id' => $product->id]);

        $this->assertDatabaseMissing('wishlists', ['user_id' => $user->id, 'product_id' => $product->id]);
    }

    public function test_guest_cannot_toggle_wishlist(): void
    {
        $product = Product::factory()->create();

        $response = $this->post('/wishlist/toggle', ['product_id' => $product->id]);

        $response->assertRedirect('/login');
    }
}
