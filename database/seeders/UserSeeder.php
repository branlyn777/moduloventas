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
            'name' => 'Usuario Administrador',
            'phone' => '00000000',
            'email' => 'admin@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
    }
}
