<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'buyer_id' => User::factory(), // You can link to an existing user or create a new one
            'total_amount' => $this->faker->randomFloat(2, 50, 1000), // Amount between $50 and $1000
            'delivery_address' => $this->faker->address,
            'delivery_longitude_latitude' => $this->faker->latitude . ', ' . $this->faker->longitude,
            'order_status' => $this->faker->randomElement(['pending', 'shipped', 'delivered', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
