<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kampus.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Regular User 1
        User::create([
            'name' => 'Putu Agus Mahendra',
            'email' => 'user@kampus.ac.id',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // Create Regular User 2
        User::create([
            'name' => 'Made Sinta Dewi',
            'email' => 'sinta@kampus.ac.id',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        echo "✅ Users created successfully!\n";
        echo "Admin - Email: admin@kampus.ac.id | Password: admin123\n";
        echo "User 1 - Email: user@kampus.ac.id | Password: user123\n";
        echo "User 2 - Email: sinta@kampus.ac.id | Password: user123\n";
    }
}