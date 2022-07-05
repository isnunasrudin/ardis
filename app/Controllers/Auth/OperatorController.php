<?php

namespace Controllers\Auth;

use Libraries\Request;
use Models\Role;
use Models\Rombel;
use Models\User;

class OperatorController
{
    public function index()
    {
        $data = [
            'operator' => User::where('role_id', 2)->get()
        ];
        return view('auth.operator', $data, title: 'Operator');
    }

    public function action(Request $request)
    {
        switch ($request->post('action')) {
            case 'tambah':
                $validate = $request->validate([
                    'name' => ['required'],
                    'email' => ['required', 'unique:user,email'],
                ], [
                    'name' => 'Nama Lengkap',
                    'email' => 'Email'
                ]);

                if(!$validate->run()) return response()->json([
                    'status' => false,
                    'message' => $validate->getMessage()
                ]);

                User::insert([
                    'full_name' => $request->post('name'),
                    'email' => $request->post('email'),
                    'password' => bcrypt($request->post('password')),
                    'role_id' => 2
                ]);
        
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil ditambahkan"
                ]);
                break;
            
            case 'edit':
                if($request->post('password') != '')
                {
                    User::find($request->post('id'))->update([
                        'full_name' => $request->post('name'),
                        'email' => $request->post('email'),
                        'password' => bcrypt($request->post('password'))
                    ]);
                }
                else
                {
                    User::find($request->post('id'))->update([
                        'full_name' => $request->post('name'),
                        'email' => $request->post('email'),
                    ]);
                }
        
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil diubah"
                ]);
                break;
            
            case 'delete':
                User::find($request->post('id'))->delete();
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil dihapus"
                ]);
        }
    }

}