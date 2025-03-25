<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'UserName' => 'Administrator', // Changed 'name' to 'UserName'
                'Email' => 'admin@mail.com',    // Changed 'email' to 'Email'
                'password' => bcrypt('12345'),
                // Removed 'level' => 1,
            ],
        ];

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['Email' => $user['Email']], // Changed 'email' to 'Email'
                $user
            );
        }, $users);
    }
}