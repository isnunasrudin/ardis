<?php

namespace Migrations;

use Library\Migration;

return new class extends Migration {

    public function run()
    {
        $this->integer('id')->primary();
        $this->string('name')->unique();
        $this->string('display_name')->nullable();
    }

};