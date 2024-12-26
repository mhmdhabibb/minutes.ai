<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = 'admin@gmail.com';

        // Check if the admin user already exists
        if (User::where('email', $adminEmail)->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('password!!'),
                'type' => 'admin',
            ]);
        }
    }
}
