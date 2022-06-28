<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;

return new class extends Migration implements MigrationInterface {

    public function run()
    {
        $this->string('id', 64)->primary();
        $this->string('name');
        $this->string('email')->unique();
        $this->integer('role_id')->foreign('role');
        $this->timestamps(
            withDeletedAt: true
        );
    }

};