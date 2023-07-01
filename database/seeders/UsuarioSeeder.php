<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'id' => 1,
            'nombre' => 'administrador',
            'email' => 'admin@soyhuila.co',
            'password' => bcrypt('admin'),
            'rol' => 1
        ]);

        User::insert([
            'id' => 2,
            'nombre' => 'Pepito Perez',
            'email' => 'pperez@gmail.com',
            'password' => bcrypt('pperez2023'),
            'rol' => 2
        ]);

        User::insert([
            'id' => 3,
            'nombre' => 'Juanito Pulido',
            'email' => 'jpulido@soyhuila.com',
            'password' => bcrypt('1234'),
            'rol' => 2
        ]);
    }
}
