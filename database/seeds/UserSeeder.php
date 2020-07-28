<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $mainUser = factory(User::class)->create([
             'login' => '123',
             'email' => '123@123.123',
             'role' => '50',
             'password' => Hash::make('123321'),
         ]);
         $secUser = factory(User::class)->create([
             'login' => '321',
             'email' => '321@321.321',
             'password' => Hash::make('321123'),
         ]);

        factory(User::class, 15)->create();
    }
}
