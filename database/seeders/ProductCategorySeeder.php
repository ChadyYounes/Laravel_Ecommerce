<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           //product Categories 
   DB::table('categories')->insert([
    ['category_name' => 'Automotive'],
    ['category_name' => 'Electronics'],
    ['category_name' => 'Clothing & Apparel'],
    ['category_name' => 'Beauty & Personal Care'],
    ['category_name' => 'Sports & Outdoors'],
    ['category_name' => 'Health & Wellness'],
    ['category_name' => 'Jewelry & Accessories'],
    ['category_name' => 'Other']
]);
    }
}
