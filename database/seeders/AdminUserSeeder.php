<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
          'name' => 'Admin',
          'email' => 'admin@dev.com',
          'password' => bcrypt('admin123'), 
          'role' => 'admin',
        ]);
    }
}
