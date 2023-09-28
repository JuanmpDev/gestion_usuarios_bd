<?php

namespace Tests\Feature\Seeders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function testUserSeeder(): void

    {
        // Ejecuta el seeder
        Artisan::call('db:seed', ['--class' => 'UserSeeder']);

        // Comprueba si se han registrado usuarios en la tabla 'users'
        $this->assertGreaterThan(0, DB::table('users')->count());
    }
}

