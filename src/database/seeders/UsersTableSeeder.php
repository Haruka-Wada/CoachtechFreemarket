<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            [
                'email' => 'user001@example.com',
                'password' => Hash::make('pass0001'),
            ],
            [
                'email' => 'user002@example.com',
                'password' => Hash::make('pass0002'),
            ],
            [
                'email' => 'user003@example.com',
                'password' => Hash::make('pass0001'),
            ],
        ]);
    }
}
