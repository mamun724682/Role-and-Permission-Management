<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'mamun@gmail.com')->first()){
            User::create([
                'name' => 'Mamun',
                'email' => 'mamun@gmail.com',
                'password' => Hash::make(12345678)
            ]);
        }
    }
}
