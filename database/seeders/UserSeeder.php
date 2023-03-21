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
            'name' => 'Armando',
            'phone' => '60778498',
            'email' => 'juan@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Samuel',
            'phone' => '75975652',
            'email' => 'rosa@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Luis Ortega Mamani',
            'phone' => '68007552',
            'email' => 'armando@gmail.com',
            'profile' => 'Cajero',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Pedro',
            'phone' => '',
            'email' => 'yazminca.torres@gmail.com',
            'profile' => 'Cajero',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Andres',
            'phone' => '',
            'email' => 'correo1@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Sergio',
            'phone' => '',
            'email' => 'correo2@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Caja 1 Central',
            'phone' => '',
            'email' => 'correo3@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Favio Orellana Barrido',
            'phone' => '',
            'email' => 'correo4@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Nadir Dorta Muro',
            'phone' => 'Juan Mamani',
            'email' => 'correo5@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Luis Gonzalo Garey Tito',
            'phone' => '',
            'email' => 'correo6@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Gery Arcenio Agreda Colque',
            'phone' => '',
            'email' => 'correo7@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Gery Arcenio Agreda Colque',
            'phone' => '',
            'email' => 'correo8@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Enzo Mauricio Ramirez Zeballos',
            'phone' => '',
            'email' => 'correo9@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Roger Cruz Coaquira ',
            'phone' => '',
            'email' => 'correo10@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Gustavo Quisbert Ventura',
            'phone' => '',
            'email' => 'correo11@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Vania Anel Choque Caballero',
            'phone' => '',
            'email' => 'correo12@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'usuario2',
            'phone' => '',
            'email' => 'correo13@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Mauricio Marcelo Mamani Vargas',
            'phone' => '',
            'email' => 'correo14@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Isaias Coronel Peña',
            'phone' => '',
            'email' => 'correo15@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'samuel caleb suarez',
            'phone' => '',
            'email' => 'correo16@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Edwin Choque Tinta',
            'phone' => '',
            'email' => 'correo17@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Clever',
            'phone' => '',
            'email' => 'correo18@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Rosa Ortiz',
            'phone' => '',
            'email' => 'correo19@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Yazmin Torres',
            'phone' => '',
            'email' => 'correo20@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Ruben Orellana Barrido',
            'phone' => '',
            'email' => 'correo21@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Angel Becerra Ortis',
            'phone' => '',
            'email' => 'correo22@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Andrews',
            'phone' => '',
            'email' => 'correo23@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'armando cahuaya',
            'phone' => '',
            'email' => 'correo24@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'ferrufino',
            'phone' => '',
            'email' => 'correo25@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'peruuser',
            'phone' => '',
            'email' => 'correo26@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'feruruuiss',
            'phone' => '',
            'email' => 'correo27@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Ernesto Triana Cabrera',
            'phone' => '',
            'email' => 'correo28@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'angel becerra',
            'phone' => '',
            'email' => 'correo29@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'Armando',
            'phone' => '',
            'email' => 'correo30@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'emanuel2',
            'phone' => '',
            'email' => 'correo31@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'ferrufino',
            'phone' => '',
            'email' => 'correo32@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
        User::create([
            'name' => 'emanuel3',
            'phone' => '',
            'email' => 'correo33@mail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('emanuel'),
            'image' => 'user_admin.png'
        ]);
    }
}
