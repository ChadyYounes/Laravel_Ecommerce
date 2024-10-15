<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(), // Create an order or link to an existing one
            'product_id' => Product::inRandomOrder()->first()->id, // Pick a random product (ID from 3 to 25)
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 10, 100), // Price between $10 and $100
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
