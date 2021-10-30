<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Admin::where('email', 'admin@gmail.com')->first()){
            Admin::create([
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678)
            ]);
        }
    }
}
