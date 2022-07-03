<?php

namespace Controllers;

use Libraries\Request;
use Models\SiswaInfo;

class WelcomeController
{
    public function index()
    {
        return view('welcome', title: 'Selamat Datang');
    }

    public function nisn(Request $request)
    {
        if(SiswaInfo::where('nisn', $request->post('nisn'))->count() > 0) return response()->json([
            'status' => true,
            'message' => 'Data Ditemukan! Silahkan masuk dengan NISN dan Tanggal Lahir',
            'data' => [
                'link' => url_make('login')
            ]
        ]);

        return response()->json([
            'status' => false,
            'message' => 'NISN yang anda masukkan tidak terdaftar di database kami'
        ]);
    }
}