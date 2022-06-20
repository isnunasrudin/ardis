<?php

namespace Migrations;

use Library\Migration;

return new class extends Migration {

    public function run()
    {
        $this->string('id', 64)->primary();
        $this->string('name');
        $this->timestamp('created_at');
        $this->timestamp('deleted_at')->nullable();
    }

};