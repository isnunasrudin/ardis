<?php

namespace Controllers\Auth;

use Libraries\Request;
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

    public function action(Request $request)
    {
        switch ($request->post('action')) {
            case 'tambah':
                $validate = $request->validate([
                    'name' => ['required', 'unique:rombel,name'],
                    'display_name' => ['required']
                ], [
                    'name' => 'Nama Rombel',
                    'display_name' => 'Nama Rombel Lengkap'
                ]);

                if(!$validate->run()) return response()->json([
                    'status' => false,
                    'message' => $validate->getMessage()
                ]);

                Rombel::insert([
                    'name' => $request->post('name'),
                    'display_name' => $request->post('display_name')
                ]);
        
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil ditambahkan"
                ]);
                break;
            
            case 'edit':
                Rombel::find($request->post('id'))->update([
                    'name' => $request->post('name'),
                    'display_name' => $request->post('display_name')
                ]);
        
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil diubah"
                ]);
                break;
            
            case 'delete':
                Rombel::find($request->post('id'))->delete();
                return response()->json([
                    'status' => true,
                    'message' => $request->post('name') . " berhasil dihapus"
                ]);
        }
    }
}