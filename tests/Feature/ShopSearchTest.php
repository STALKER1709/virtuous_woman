<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_query_filters_products_by_name(): void
    {
        Product::factory()->create(['name' => 'Red Silk Dress']);
        Product::factory()->create(['name' => 'Blue Cotton Shirt']);

        $response = $this->get('/shop?q=Silk');

        $response->assertOk();
        $response->assertSee('Red Silk Dress');
        $response->assertDontSee('Blue Cotton Shirt');
    }

    public function test_can_filter_by_category(): void
    {
        $matching = Category::factory()->create();
        $other = Category::factory()->create();
        Product::factory()->create(['name' => 'Matching Product', 'category_id' => $matching->id]);
        Product::factory()->create(['name' => 'Other Product', 'category_id' => $other->id]);

        $response = $this->get('/shop?categories='.$matching->id);

        $response->assertOk();
        $response->assertSee('Matching Product');
        $response->assertDontSee('Other Product');
    }

    public function test_can_filter_by_brand(): void
    {
        $matching = Brand::factory()->create();
        $other = Brand::factory()->create();
        Product::factory()->create(['name' => 'Matching Brand Product', 'brand_id' => $matching->id]);
        Product::factory()->create(['name' => 'Other Brand Product', 'brand_id' => $other->id]);

        $response = $this->get('/shop?brands='.$matching->id);

        $response->assertOk();
        $response->assertSee('Matching Brand Product');
        $response->assertDontSee('Other Brand Product');
    }
}
