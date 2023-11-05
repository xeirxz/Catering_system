<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users') -> insert([

            [
            'name' => 'Admin',
            'lastname' => 'Admin',
            'address' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>hash::make(123)
            ],
            [
                'name' => 'staff',
                'lastname' => 'staff',
                'address' => 'staff',
                'role' => 'staff',
                'email' => 'staff@gmail.com',
                'password' =>hash::make(123)
                ],
                [
                    'name' => 'customer',
                    'lastname' => 'customer',
                    'address' => 'alubijid',
                    'role' => 'customer',
                    'email' => 'customer@gmail.com',
                    'password' =>hash::make(123)
                ],
                [
                     'name' => 'barik',
                    'lastname' => 'antigbao',
                    'address' => 'amerika',
                    'role' => 'customer',
                    'email' => 'barik@gmail.com',
                    'password' =>hash::make(123)
                ],
                [
                     'name' => 'aljon',
                    'lastname' => 'unsay',
                    'address' => 'unahanAlub',
                    'role' => 'customer',
                    'email' => 'unsay@gmail.com',
                    'password' =>hash::make(123)
                ],
                ]);
    }
}
