<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            User::truncate();
            $faker = Faker::create();
            $rol = Rol::inRandomOrder()->first();

            foreach(range(1,10) as $user){

                // Crear el usuario con el rol asignado
                User::create([
                    'name' => $faker->name,
                    'rol_id' => $rol->id,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make($faker->password()),
                ]);

            }

        User::create([
            'name' => 'Juan Manuel',
            'rol_id' => '1',
            'email' => 'juanmanuel@admin.com',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                ]);

        User::create([
            'name' => 'Juan Manuel',
            'rol_id' => '2',
            'email' => 'juanmanuel@user.com',
            'password' => Hash::make('user'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                ]);

            }

}



