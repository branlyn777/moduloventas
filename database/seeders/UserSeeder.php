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
            'name' => 'Soporte Sistema',
            'phone' => '00000000',
            'email' => 'sistema@gmail.com',
            'profile' => 'Sistema',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Edwin Choque Tinta',
            'phone' => '60778498',
            'email' => 'juan@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Rosa Ortiz',
            'phone' => '75975652',
            'email' => 'rosa@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Armando Cahuaya',
            'phone' => '68007552',
            'email' => 'armando@gmail.com',
            'profile' => 'Cajero',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Yazmin Torres',
            'phone' => '',
            'email' => 'yazminca.torres@gmail.com',
            'profile' => 'Cajero',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
    }
}
