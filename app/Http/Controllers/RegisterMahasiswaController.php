<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;


class RegisterMahasiswaController extends Controller
{
    public function showRegisterForm()
    {
        return view('register.mahasiswa');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id'       => $user->id,
            'nim'           => $request->nim,
            'nama_lengkap'  => $request->nama_lengkap,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil');
    }
}
