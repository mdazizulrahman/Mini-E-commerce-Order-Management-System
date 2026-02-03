<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'active' => true,
        ]);
        Category::create([
            'name' => 'Books',
            'slug' => 'books',
            'active' => true,
        ]);
        Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'active' => true,
        ]);
    }
}
