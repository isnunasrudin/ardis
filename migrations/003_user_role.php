<?php

namespace Migrations;

use Library\Migration;

return new class extends Migration {

    public function run()
    {
        $this->string('user_id')->foreign(
            column: 'id',
            another_table: 'user'
        );

        $this->integer('role_id')->foreign(
            column: 'id',
            another_table: 'role'
        );
        
        $this->index(['user_id', 'role_id']);
    }

};