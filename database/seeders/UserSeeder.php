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
            $faker = Faker::create();
            $rol = Rol::inRandomOrder()->first();

            for($i=0;$i<10;$i++){
                $name = $faker->name;
                $email = $faker->unique()->safeEmail;
                $password = bcrypt($faker->password);

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



