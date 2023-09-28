<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $faker = Faker::create();

    // Crear los roles en la tabla roles
    $roles = ["Administrador", "Usuario"];

    foreach ($roles as $role) {
        Rol::create(['name' => $role]);
    }

    // Crear 10 usuarios con un rol aleatorio
    for ($i=0;$i<10; $i++){
    // Obtener un rol aleatorio de la tabla roles
    $rol = Rol::inRandomOrder()->first();

    // Crear el usuario con el rol asignado
    User::create([
        'name' => $faker->name,
        'rol_id' => $rol->id,
        'email' => $faker->email,
        'password' => Hash::make($faker->password()),
    ]);
}
    }
}
