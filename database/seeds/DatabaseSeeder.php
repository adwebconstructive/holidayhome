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
        User::create([
            'emp_id' => "admin",
            'name' => "Admin",
            'email' => "admin@xyz.com",
            'phone_number' => "12352525",
            'role' => "1",
            'password' => Hash::make('secret'),
        ]);
    }
}
