<?php

namespace Migrations;

use Library\Migration;

return new class extends Migration {

    public function run()
    {
        $this->string('id', 64)->primary();
        $this->string('name');
        $this->string('email')->unique();
        $this->integer('role_id')->foreign('role');
        $this->timestamp('created_at');
        $this->timestamp('deleted_at')->nullable();
    }

};