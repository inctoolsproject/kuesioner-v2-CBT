<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TendikController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.tendik');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required|string|max:9',
            'password' => 'required|string|max:6',
        ]);
        $loginAttempts = Auth::attempt($credentials);
        if ($loginAttempts) {
            $user = Auth::user();
            if ($user->role == 'tendik') {
                $request->session()->regenerate();
                $request->session()->put('login', 'tendik');
                $request->session()->put('islogin', true);
                return redirect()->route('tendik.sarpras.index');
            } else {
                $request->session()->regenerate();
                $request->session()->put('login', 'admin');
                $request->session()->put('islogin', true);
                return redirect()->route('admin.index');
            }
        }

        return back()->with('error', 'Username atau Password salah!');
    }
}
