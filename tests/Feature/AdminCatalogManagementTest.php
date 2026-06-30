<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCatalogManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_cannot_create_a_product(): void
    {
        $user = User::factory()->create(['utype' => 'USR']);
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($user)->post('/admin/product/store', [
            'name' => 'Blocked Product',
            'slug' => 'blocked-product',
            'short_description' => 'desc',
            'description' => 'desc',
            'regular_price' => 10,
            'sale_price' => 8,
            'SKU' => 'SKU1',
            'stock_status' => 'instock',
            'featured' => 0,
            'quantity' => 5,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('products', ['slug' => 'blocked-product']);
    }

    public function test_product_creation_requires_a_unique_slug(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        Product::factory()->create(['slug' => 'taken-slug']);

        $response = $this->actingAs($admin)->post('/admin/product/store', [
            'name' => 'Duplicate Slug Product',
            'slug' => 'taken-slug',
            'short_description' => 'desc',
            'description' => 'desc',
            'regular_price' => 10,
            'sale_price' => 8,
            'SKU' => 'SKU2',
            'stock_status' => 'instock',
            'featured' => 0,
            'quantity' => 5,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_product_creation_requires_an_image(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/product/store', [
            'name' => 'No Image Product',
            'slug' => 'no-image-product',
            'short_description' => 'desc',
            'description' => 'desc',
            'regular_price' => 10,
            'sale_price' => 8,
            'SKU' => 'SKU3',
            'stock_status' => 'instock',
            'featured' => 0,
            'quantity' => 5,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response->assertSessionHasErrors('image');
        $this->assertDatabaseMissing('products', ['slug' => 'no-image-product']);
    }

    public function test_regular_user_cannot_delete_a_product(): void
    {
        $user = User::factory()->create(['utype' => 'USR']);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete("/admin/product/{$product->id}/delete");

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_category_creation_requires_a_unique_slug(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        Category::factory()->create(['slug' => 'taken-category']);

        $response = $this->actingAs($admin)->post('/admin/category/store', [
            'name' => 'Duplicate Category',
            'slug' => 'taken-category',
        ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_brand_creation_requires_a_unique_slug(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        Brand::factory()->create(['slug' => 'taken-brand']);

        $response = $this->actingAs($admin)->post('/admin/brand/store', [
            'name' => 'Duplicate Brand',
            'slug' => 'taken-brand',
        ]);

        $response->assertSessionHasErrors('slug');
    }
}
