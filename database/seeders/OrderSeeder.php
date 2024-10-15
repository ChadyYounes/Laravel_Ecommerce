<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Create 10 orders
        Order::factory(10)->create()->each(function ($order) {
            // For each order, create 1 to 5 order items
            $productIds = Product::inRandomOrder()->pluck('id')->toArray(); // Get an array of product IDs

            $orderItemsCount = rand(1, 5); // Randomly decide the number of items for this order
            
            foreach (range(1, $orderItemsCount) as $index) {
                $order->getOrderItem()->create([ // Use the getOrderItem() method
                    'product_id' => $productIds[array_rand($productIds)], // Randomly pick a product ID
                    'quantity' => rand(1, 10),
                    'unit_price' => rand(10, 100),
                ]);
            }
        });
    }
}
