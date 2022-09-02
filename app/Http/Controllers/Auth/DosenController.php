<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.dosen');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:9',
            'password' => 'required|string|max:6',
        ]);
        // dd($request->all());
        $response = Http::asForm()->post(config('app.urlApi') . 'dosen/login', [
            'username' => $request->username,
            'password' => $request->password,
            'APIKEY' => config('app.API_KEY')
        ]);
        $resjson = $response->json();
        if ($resjson['success']) {
            $request->session()->put('dosen', $resjson['user']);
            $request->session()->put('login', 'dosen');
            $request->session()->put('islogin', true);
            return redirect()->route('dosen.akademik.index');
        } else {
            return redirect()->route('auth.dosen.login')->with('error', 'Username atau Password salah!');
        }
    }
}
