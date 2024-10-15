<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'store_name' => $this->faker->company,
            'store_category' => $this->faker->word, // Assuming store_category is a string; adjust if it's a foreign key
            'store_description' => $this->faker->sentence,
            'image_url' => $this->faker->imageUrl(), // Generates a random image URL
            'is_approved' => $this->faker->boolean, // Random boolean for approval status
            'seller_id' => 2, // Set seller_id to 2
        ];
    }
}
