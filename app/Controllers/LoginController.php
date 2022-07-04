<?php

namespace Controllers;

use Exception;
use Libraries\Authenticable\Auth;
use Libraries\Request;
use Models\SiswaInfo;
use Models\User;

class LoginController
{

    public function index()
    {
        return view('login', title: 'Masuk');
    }

    public function login_run(Request $request)
    {
        $validate = $request->validate([
            'input_1' => ['required'],
            'input_2' => ['required']
        ], [
            'input_1' => 'Email/NISN',
            'input_2' => 'Kata Sandi/Tgl. Lahir'
        ]);

        if($validate->run() === FALSE) return response()->json([
            'status' => false,
            'message' => $validate->getMessage()
        ]);

        try {

            if(filter_var($request->post('input_1'), FILTER_VALIDATE_EMAIL))
            {
                // GTK
                $user = User::where('email', $request->post('input_1'))->first();
                if( $user === null ) throw new Exception();
                if(!Auth::login($user->id, $request->post('input_2'))) throw new Exception();
            }
            else
            {
                // Siswa
                $data_siswa = SiswaInfo::where('nisn', $request->post('input_1'))->first();
                if( $data_siswa === null ) throw new Exception();

                $user = $data_siswa->akun;
                if(!Auth::login($user->id, $request->post('input_2'))) throw new Exception();

            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Data yang dimasukkan tidak valid!"
            ]);
        }
        
        return response()->pendingRedirect('auth.home')->json([
            'status' => true
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->redirect('/');
    }
}