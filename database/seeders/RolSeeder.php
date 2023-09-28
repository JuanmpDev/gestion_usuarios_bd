<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    DB::statement('SET FOREIGN_KEY_CHECKS=0');

    Rol::truncate();
    $faker = Faker::create();

    // Crear los roles en la tabla roles
    $roles = ["Administrador", "Usuario"];

    foreach ($roles as $role) {
        Rol::create(['name' => $role]);
    }

}
}

