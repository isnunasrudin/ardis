<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;

return new class extends Migration implements MigrationInterface
{
    public function run()
    {
        $this->integer('id')->autoIncrement()->primary();
        $this->integer('siswa_info_id')->foreign('siswa_info');
        $this->string('jenis');
        $this->string('path');
        $this->timestamps(
            withDeletedAt: true
        );
    }
};