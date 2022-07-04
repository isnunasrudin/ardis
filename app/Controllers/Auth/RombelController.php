<?php

namespace Controllers\Auth;

use Models\Rombel;

class RombelController
{
    public function index()
    {
        $data = [
            'rombel' => Rombel::get()
        ];

        return view('auth.rombel', $data, title: 'Rombongan Belajar');
    }
}