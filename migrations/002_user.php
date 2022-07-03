<?php

namespace Migrations;

use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;
use Models\User;

return new class extends Migration implements MigrationInterface {

    public function run()
    {
        $this->string('id', 64)->primary();
        $this->string('full_name');
        $this->string('email')->unique();
        $this->integer('role_id')->foreign('role');
        $this->string('token')->nullable();
        $this->string('password')->nullable();
        $this->timestamps(
            withDeletedAt: true
        );
    }

    public function postExecute()
    {
        User::insert([
            "role_id" => 3,
            "full_name" => "Kepala Sekolah",
            "email" => "kepalasekolah@localhost",
            "password" => bcrypt("12345678")
        ]);

        User::insert([
            "role_id" => 2,
            "full_name" => "Operator",
            "email" => "admin@localhost",
            "password" => bcrypt("12345678")
        ]);
    }

};