<?php

namespace Controllers\Auth;

use Models\SiswaBerkas;
use Models\SiswaInfo;

class HomeController
{
    public function index()
    {
        $data = [
            'total_siswa' => SiswaInfo::count(),
            'total_berkas' => SiswaBerkas::count()
        ];
        return view('auth.dashboard', $data, title: 'Beranda');
    }
}