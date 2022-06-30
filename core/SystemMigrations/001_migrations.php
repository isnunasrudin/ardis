<?php

namespace SystemMigrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;

return new class extends Migration implements MigrationInterface
{
    public function run()
    {
        $this->integer('id')->autoIncrement()->primary();
        $this->string('data');
        $this->timestamp('run_at');
    }
};