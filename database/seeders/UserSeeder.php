<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mayank javiya',
                'email' => 'mayank@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Haresh patel',
                'email' => 'haresh@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Tushar Rathor',
                'email' => 'tushar@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Amit patel',
                'email' => 'amit@example.com',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }

    }
}
