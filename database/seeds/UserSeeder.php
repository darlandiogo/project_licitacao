<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'darlan',
            'email' => 'darlandiogo@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), 
            'remember_token' => Str::random(10),
        ]);
    }
}
