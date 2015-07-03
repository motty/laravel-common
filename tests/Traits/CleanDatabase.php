<?php namespace Motty\Laravel\Common\Testing;

/**
 * Method used to clean the database, this will be a specific method in charge of
 * restart all the autoincrement index, truncate the tables if needed and all
 * the task related to prepare the database before each the test case
 *
 * @package Motty\Laravel\Common\Testing\Traits
 */
trait CleanDatabase
{
    /**
     * @before
     */
    public function cleanDatabase()
    {
        if (env('DB_CONNECTION') === 'pgsql') {
            $tables = DB::select(
                "SELECT table_name FROM information_schema.tables
                  WHERE table_schema='public'
                    AND table_type='BASE TABLE'"
            );
            array_shift($tables);
        }

        if (isset($tables)) {
            $this->runClean($tables);
        }
    }

    protected function runClean($tables)
    {
        foreach ($tables as $tuple) {
            DB::statement("ALTER TABLE $tuple->table_name DISABLE TRIGGER ALL");
            DB::statement("TRUNCATE TABLE $tuple->table_name RESTART IDENTITY CASCADE");
            DB::statement("ALTER TABLE $tuple->table_name ENABLE TRIGGER ALL");
        }
    }
}
