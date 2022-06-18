<?php

namespace Migrations;

use Library\Migration;

class User extends Migration {

    public function run()
    {
        $this->string('id', 64)->primary();
        $this->string('no_hp');
    }

}