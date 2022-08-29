<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.mahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:9',
            'password' => 'required|string|max:6',
        ]);
        $response = Http::asForm()->post(config('app.urlApi') . 'mahasiswa/login', [
            'username' => $request->username,
            'password' => $request->password,
            'APIKEY' => config('app.API_KEY')
        ]);
        $resjson = $response->json();
        if ($resjson['success']) {
            $request->session()->put('mahasiswa', $resjson['user']);
            $request->session()->put('login', 'mahasiswa');
            return redirect()->route('mahasiswa.akademik.index');
        } else {
            return redirect()->route('auth.mahasiswa.login')->with('error', 'Username atau Password salah!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('auth.mahasiswa.showLoginForm');
    }
}
