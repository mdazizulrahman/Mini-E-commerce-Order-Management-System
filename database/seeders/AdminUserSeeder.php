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
        User::updateOrCreate([
          'email' => 'admin@dev.com',
        ],
         [
          'name' => 'Admin',
          'password' => bcrypt('admin123'), 
          'role' => 'admin',
          'active' => 1,
        ]);
    }
}
