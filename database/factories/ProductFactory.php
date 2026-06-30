<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 1000000),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'regular_price' => fake()->randomFloat(2, 10, 200),
            'sale_price' => null,
            'SKU' => strtoupper(Str::random(8)),
            'stock_status' => 'instock',
            'featured' => false,
            'quantity' => 10,
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
