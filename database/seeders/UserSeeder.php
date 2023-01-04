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
        User::create([
            'name' => 'Miguel Gonzalez',
            'phone' => '71787963',
            'email' => 'admin@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('12345'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Luis Sera',
            'phone' => '71787963',
            'email' => 'luis@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('12345'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Juan Torrez',
            'phone' => '71787963',
            'email' => 'juan@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('12345'),
            'image' => 'user_admin.png'
        ]);
    }
}
