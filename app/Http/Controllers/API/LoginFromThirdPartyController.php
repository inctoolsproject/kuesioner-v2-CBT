<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginFromThirdPartyController extends Controller
{
    public function mahasiswa(Request $request)
    {
        if ($request->secret != md5('login-from-api')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        try {
            $response = Http::asForm()->post(config('app.urlApi') . 'mahasiswa/login', [
                'nrp' => $request->nrp,
                'pin' => $request->pin,
                'APIKEY' => config('app.API_KEY')
            ]);
            $resjson = $response->json();
            if ($resjson['success']) {
                $request->session()->put('mahasiswa', $resjson['user']);
                $request->session()->put('login', 'mahasiswa');
                $request->session()->put('islogin', true);
                return redirect()->route('mahasiswa.akademik.index');
            } else {
                return redirect()->route('auth.mahasiswa.login')->with('error', 'Username atau Password salah!');
            }
        } catch (\Exception $e) {
            Log::error('[Login Mahasiswa] ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi!');
        }
    }
}
