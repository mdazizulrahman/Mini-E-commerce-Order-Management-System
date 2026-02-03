<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Category::updateOrCreate([
            'name' => 'Electronics',
            'slug' => 'electronics',
        ], [
            'active' => true,
        ]);
        Category::updateOrCreate([
            'name' => 'Books',
            'slug' => 'books',
            'active' => true,
        ]);
        Category::updateOrCreate([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'active' => true,
        ]);
    }
}
