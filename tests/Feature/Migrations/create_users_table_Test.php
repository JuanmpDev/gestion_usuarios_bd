<?php

namespace Tests\Feature\Migrations;


use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class create_users_table_Test extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testMigration(): void
    {
        // Ejecuta las migraciones
        Artisan::call('migrate');

        // Comprueba si la tabla 'users' existe en la base de datos
        $this->assertTrue(Schema::hasTable('users'));

        // Comprueba si las columnas esperadas existen en la tabla 'users'
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id', 'rol_id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'
            ]), 1);
    }
}
