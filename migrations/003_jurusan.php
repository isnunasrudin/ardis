<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;

return new class extends Migration implements MigrationInterface
{
    public function run()
    {
        $this->integer('id')->autoIncrement()->primary();
        $this->string('name')->unique();
        $this->string('display_name')->nullable();
    }
};