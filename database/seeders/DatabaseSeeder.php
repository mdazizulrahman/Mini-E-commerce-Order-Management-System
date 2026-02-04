<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(AdminUserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductSeeder::class);

       User::updateOrCreate(
    ['email' => 'user@gmail.com'], // এখানে কোনো ডাবল অ্যারে হবে না
    [
        'name' => 'Regular User',
        'password' => bcrypt('password'),
        'role' => 'customer',
        'active' => 1,
    ]
);


    }
}
