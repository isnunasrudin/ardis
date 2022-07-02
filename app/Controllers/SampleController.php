<?php

namespace Controllers;

use Libraries\Request;
use Models\Role;
use Models\SiswaInfo;
use Models\User;

class SampleController
{
    public function index(Request $request)
    {
        Role::insert([
            "name"=>"user",
            "display_name"=>"Pengguna Biasa"
        ]);
        Role::insert([
            "name"=>"admin",
            "display_name"=>"Operator Sekolah"
        ]);
        Role::insert([
            "name"=>"kepsek",
            "display_name"=>"Kepala Sekolah"
        ]);
        User::insert([
            "name"=>"Agus Harianto, M.Pd",
            "email"=>"agushari@gmail.com",
            "role_id"=>"3"
        ]);
        User::insert([
            "name"=>"Muhammad Isnu Nasrudin",
            "email"=>"isnunas@gmail.com",
            "role_id"=>"2"
        ]);
        User::insert([
            "name"=>"Miftakhul Zhendi",
            "email"=>"miftakhulzhendi@gmail.com",
            "role_id"=>"2"
        ]);
        User::insert([
            "name"=>"Rahmani Nurul Fatimah",
            "email"=>"rahmaninurulfatimah12@gmail.com",
            "role_id"=>"1"
        ]);
        User::insert([
            "name"=>"Ellyfiana NS",
            "email"=>"ellyfianans@gmail.com",
            "role_id"=>"1"
        ]);
        SiswaInfo::insert([
            "user_id"=>"1b8a90ec-3763-4d05-98fe-1c8d8bf21c0b",
            "nisn"=>"0012345678",
            "born_place"=>"Tulungagung",
            "born_date"=>"2001-01-30",
            "gender"=>"P",
            "tahun_masuk"=>"2008",
            "rt"=>"002",
            "rw"=>"001",
            "address_code"=>"35.03.08.2001",
            "status"=>"aktif",
            "asal_sekolah"=>"SMP Berdaya"
        ]);
    }
}