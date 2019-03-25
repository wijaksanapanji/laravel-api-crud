<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 2,            
        ]);

        User::insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
