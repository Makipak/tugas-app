<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dosen;


class RegisterDosenController extends Controller
{
    public function showRegisterForm()
    {
        return view('register.dosen');
    }

    

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nidn' => 'required|string',
            'nama_lengkap' => 'required|string',
            'bidang_keahlian' => 'required|string',
            'username' => 'required|string|unique:users',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'dosen',
        ]);

        Dosen::create([
            'user_id'        => $user->id,
            'nidn'           => $request->nidn,
            'nama_lengkap'   => $request->nama_lengkap,
            'bidang_keahlian'=> $request->bidang_keahlian,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil');
    }
}
