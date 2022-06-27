<?php

namespace Migrations;

use Libraries\Database\Migration;

return new class extends Migration {

    public function run()
    {
        $this->integer('id')->primary()->autoIncrement();
        $this->string('name')->unique();
        $this->string('display_name')->nullable();
    }

};