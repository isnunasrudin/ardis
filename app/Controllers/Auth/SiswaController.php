<?php

namespace Controllers\Auth;

use Exception;
use Libraries\Database\DB;
use Libraries\Request;
use Models\Rombel;
use Models\SiswaInfo;
use Models\User;

class SiswaController
{
    public function index()
    {
        $data = [
            'peserta_didik' => SiswaInfo::get(),
            'add_enable' => Rombel::count() > 0
        ];

        return view('auth.siswa.index', $data, title: 'Peserta Didik');
    }

    public function tambah()
    {
        $data = [
            'rombel' => Rombel::get()
        ];
        return view('auth.siswa.tambah', $data, title: 'Tambah Peserta Didik');
    }

    public function tambah_post(Request $request)
    {
        $validate = $request->validate([
            'nama' => ['required', 'name'],
            'nisn' => ['required', 'digits:10', 'unique:siswa_info,nisn,true'],
            'tempat-lahir' => ['required'],
            'tgl-lahir' => ['required', 'date'],
            'email' => ['email', 'unique:user,email,true'],
            'provinsi' => ['required', 'digits:2'],
            'kota' => ['required', 'digits:4'],
            'kecamatan' => ['required', 'digits:7'],
            'desa' => ['required', 'digits:10'],
            'rt' => ['numeric'],
            'rw' => ['numeric'],
            'tahun-masuk' => ['required', 'digits:4'],
            'kelas' => ['required', 'in:10,11,12'],
            'rombel' => ['required', 'exists:rombel,id'],
        ]);

        if($validate->run() === FALSE) return response()->json([
            'status' => false,
            'message' => $validate->getMessage(),
            'errors' => $validate->getErrors()
        ]);

        DB::transaction(function() use($request) {
            $user = User::insert([
                'full_name' => $request->post('nama'),
                'password' => bcrypt($request->post('tgl-lahir')),
                'email' => $request->post('email') ?? '',
                'role_id' => 1
            ]);

            SiswaInfo::insert([
                'user_id' => $user->id,
                'nisn' => $request->post('nisn'),
                'born_place' => $request->post('tempat-lahir'),
                'born_date' => $request->post('tgl-lahir'),
                'gender' => 'L',
                'tahun_masuk' => $request->post('tahun-masuk'),
                'rt' => $request->post('rt'),
                'rw' => $request->post('rw'),
                'address_street' => $request->post('alamat'),
                'address_code' => $request->post('desa'),
                'status' => 1,
                'asal_sekolah' => $request->post('asal-sekolah'),
                'kelas' => $request->post('kelas'),
                'rombel_id' => $request->post('rombel')
            ]);
        });

        return response()->json([
            'status' => true,
            'link' => url_make('auth.siswa')
        ]);
    }

    public function delete(Request $request)
    {
        $siswa_info = SiswaInfo::find($request->post('id'));
        $user = $siswa_info->akun;

        $siswa_info->delete();
        $user->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function view(Request $request)
    {
        $validate = $request->validate([
            'id' => ['required', 'exists:siswa_info,id']
        ]);

        if(!$validate->run()) not_found();

        $data = [
            'siswa' => SiswaInfo::find($request->any('id')),
            'rombel' => Rombel::get()
        ];

        return view('auth.siswa.view', $data);
    }

    public function edit(Request $request)
    {
        $siswa = SiswaInfo::find($request->any('id'));
        $rombel = Rombel::get();
        return view('auth.siswa.edit', compact('siswa', 'rombel'), title: 'Edit Data Siswa');
    }

    public function edit_run(Request $request)
    {
        $validate = $request->validate([
            'nama' => ['required', 'name'],
            'nisn' => ['required', 'digits:10'],
            'tempat-lahir' => ['required'],
            'tgl-lahir' => ['required', 'date'],
            'email' => ['email'],
            'provinsi' => ['required', 'digits:2'],
            'kota' => ['required', 'digits:4'],
            'kecamatan' => ['required', 'digits:7'],
            'desa' => ['required', 'digits:10'],
            'rt' => ['numeric'],
            'rw' => ['numeric'],
            'tahun-masuk' => ['required', 'digits:4'],
            'kelas' => ['required', 'in:10,11,12'],
            'rombel' => ['required', 'exists:rombel,id'],
        ]);

        try {
            if($validate->run() === FALSE) throw new Exception($validate->getMessage());

            $siswa = SiswaInfo::find($request->any('id'));

            DB::transaction(function() use($request, $siswa) {
                $siswa->update([
                    'nisn' => $request->post('nisn'),
                    'born_place' => $request->post('tempat-lahir'),
                    'born_date' => $request->post('tgl-lahir'),
                    'gender' => 'L',
                    'tahun_masuk' => $request->post('tahun-masuk'),
                    'rt' => $request->post('rt'),
                    'rw' => $request->post('rw'),
                    'address_street' => $request->post('alamat'),
                    'address_code' => $request->post('desa'),
                    'status' => 1,
                    'asal_sekolah' => $request->post('asal-sekolah'),
                    'kelas' => $request->post('kelas'),
                    'rombel_id' => $request->post('rombel')
                ]);
                
                $siswa->akun->update([
                    'full_name' => $request->post('nama'),
                    'password' => bcrypt($request->post('tgl-lahir')),
                    'email' => $request->post('email') ?? '',
                ]);
            });
            
            return response()->json([
                'status' => true,
                'link' => auth()::user()->isRole('admin', 'kepsek') ? url_make('auth.siswa') : url_make('auth.siswa.view', ['id', $siswa->akun->id])
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}