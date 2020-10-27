<?php

use App\User;
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
        $user = User::where('email', 'admin@admin.com')->first();
        if (is_null($user)) {
        	$u = new User();
        	$u->name = 'Admin';
        	$u->email = 'admin@admin.com';
        	$u->password = Hash::make('password');
        	$u->save();
        }
    }
}
