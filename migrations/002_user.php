<?php

namespace Migrations;

use Libraries\Database\Migration;

return new class extends Migration {

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