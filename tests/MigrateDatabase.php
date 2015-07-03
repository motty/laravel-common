<?php namespace Motty\Laravel\Common\Testing;

use Illuminate\Support\Facades\Artisan;

/**
 * This class will migrate the database according to our environment parameter MIGRATIONS_PATH
 *
 * @package Motty\Laravel\Common\Testing\Traits
 */
trait MigrateDatabase
{
    /**
     * @beforeClass
     */
    public static function migrateDatabase()
    {
        // migrate database according to our environment parameter MIGRATIONS_PATH
        Artisan::call('migrate', ['--path' => env('MIGRATIONS_PATH', 'database/migrations')]);
    }
}
