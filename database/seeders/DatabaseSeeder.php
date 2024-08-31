<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Administrator;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('admin123'),
        // ]);

        Administrator::insert(
            ['name' => 'admin',  'phone' => '081320938989','email' => 'admin@gmail.com','password' => Hash::make('admin123'),'created_at' => date('Y-m-d H:m:s'),'updated_at' => date('Y-m-d H:m:s')]
        );
    }
}
