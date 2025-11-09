<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@ijen-driver.local'],
            [
                'name' => 'Admin Test',
                'username' => 'admin-test',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );
    }
}
