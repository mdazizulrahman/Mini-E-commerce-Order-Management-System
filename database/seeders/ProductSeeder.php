<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();
        if (!$category){
            return;
        }
        
        product::updateOrCreate([
            'name' => 'Sample Product',
            'price' => 19.99,
            'stock' => 100,
            'category_id' => $category->id,
            'status' => 1,
        ]);
        product::updateOrCreate([
            'name' => 'Another Product',
            'price' => 29.99,
            'stock' => 50,
            'category_id' => $category->id,
            'status' => 1,
        ]);

    }
}
