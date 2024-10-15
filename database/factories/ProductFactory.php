<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product; // Make sure to import the Product model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word,
            'category_id' => $this->faker->numberBetween(1, 8), // Assigning a random category ID
            'store_id' => 1, // Assuming you currently have one store
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'product_url' => $this->faker->imageUrl(640, 480, 'product', true), // Generating a random product image URL
            'description' => $this->faker->sentence, // Adding a random description
        ];
    }
}
