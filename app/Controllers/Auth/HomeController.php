<?php

namespace Controllers\Auth;

use Libraries\Authenticable\Auth;
use Models\SiswaBerkas;
use Models\SiswaInfo;

class HomeController
{
    public function index()
    {
        if(Auth::user()->isRole('user')) return response()->redirect('auth.siswa.view', ['id' => Auth::user()->siswa->id]);
        
        $data = [
            'total_siswa' => SiswaInfo::count(),
            'total_berkas' => SiswaBerkas::count()
        ];
        return view('auth.dashboard', $data, title: 'Beranda');
    }
}