<?php

namespace Controllers\Auth;

use Libraries\Authenticable\Auth;
use Models\Rombel;
use Models\SiswaInfo;

class HomeController
{
    public function index()
    {
        if(Auth::user()->isRole('user')) return response()->redirect('auth.siswa.view', ['id' => Auth::user()->siswa->id]);
        
        $data = [
            'total_siswa' => SiswaInfo::count(),
            'total_rombel' => Rombel::count()
        ];
        return view('auth.dashboard', $data, title: 'Beranda');
    }
}