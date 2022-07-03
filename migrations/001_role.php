<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;
use Models\Role;

return new class extends Migration implements MigrationInterface {

    public function run()
    {
        $this->integer('id')->primary()->autoIncrement();
        $this->string('name')->unique();
        $this->string('display_name')->nullable();
    }

    public function postExecute()
    {
        Role::insert([
            "id" => 1,
            "name" => "user",
            "display_name" => "Siswa"
        ]);

        Role::insert([
            "id" => 2,
            "name" => "admin",
            "display_name" => "Operator Sekolah"
        ]);

        Role::insert([
            "id" => 3,
            "name" => "kepsek",
            "display_name" => "Kepala Sekolah"
        ]);
    }

};