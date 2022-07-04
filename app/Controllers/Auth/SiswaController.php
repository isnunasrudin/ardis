<?php

namespace Controllers\Auth;

use Libraries\Request;
use Models\SiswaInfo;

class SiswaController
{
    public function index()
    {
        $data = [
            'peserta_didik' => SiswaInfo::get()
        ];

        return view('auth.siswa.index', $data, title: 'Peserta Didik');
    }

    public function tambah()
    {
        return view('auth.siswa.tambah');
    }

    public function tambah_post(Request $request)
    {
        dd($request);
    }
}