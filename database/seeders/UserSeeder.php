<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@lifemedia.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Surveyor',
            'email' => 'surveyor@lifemedia.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'name' => 'Adi',
            'email' => 'adi@lifemedia.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
