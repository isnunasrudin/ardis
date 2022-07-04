<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;

return new class extends Migration implements MigrationInterface
{

    public function run()
    {
        $this->integer('id')->autoIncrement()->primary();
        $this->string('user_id', 64)->foreign('user');

        $this->string('nisn', 10);
        $this->string('born_place');
        $this->date('born_date');
        $this->string('gender')->nullable();
        $this->string('tahun_masuk')->nullable();
        $this->string('tahun_keluar')->nullable();
        $this->string('rt', 5)->nullable();
        $this->string('rw', 5)->nullable();
        $this->text('address_street')->nullable();
        $this->string('address_code', 15)->nullable();
        $this->integer('status', 1)->nullable();
        $this->string('asal_sekolah')->nullable();

        $this->integer('kelas')->nullable();
        $this->integer('rombel_id')->nullable();

        $this->timestamps(
            withDeletedAt: true
        );
    }

};