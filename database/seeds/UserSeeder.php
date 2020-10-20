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
        $user = User::where('email', 'mamun@mamun.com')->first();
        if (is_null($user)) {
        	$u = new User();
        	$u->name = 'Mamun';
        	$u->email = 'mamun@mamun.com';
        	$u->password = Hash::make('12345678');
        	$u->save();
        }
    }
}
