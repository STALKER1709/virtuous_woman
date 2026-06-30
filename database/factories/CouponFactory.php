<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->unique()->lexify('CODE????')),
            'type' => 'percent',
            'value' => 10,
            'max_uses' => null,
            'times_used' => 0,
            'expires_at' => null,
            'active' => true,
        ];
    }
}
