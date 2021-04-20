<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = new User([
        'name' => 'Brian Nguyen',
        'email' => 'nguyenngocvan279@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('ngocvan@myhobby'),
        'remember_token' => Str::random(10),
        'role' => 'admin'
       ]);

       $admin->save();
    }
}
