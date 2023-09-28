<?php

namespace Tests\Feature\Seeders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RolsSeederTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testRolSeeder(): void
    {
        // Ejecuta el seeder
        Artisan::call('db:seed', ['--class' => 'RolSeeder']);

        // Comprueba si se han registrado usuarios en la tabla 'users'
        $this->assertGreaterThan(0, DB::table('rols')->count());
    }
}
