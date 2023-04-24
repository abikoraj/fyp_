<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',    // Admin's name
            'phone' => '+9779800000000',    // Admin's phone number
            'password' => bcrypt('Admin@123'),    // Admin's password
            'role' => 0,    // Admin's role
            'isVerified' => true
        ]);
    }
}
