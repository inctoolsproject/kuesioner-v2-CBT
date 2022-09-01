<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RespondenAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MataKuliahController extends Controller
{
    public function mahasiswa(Request $request, $id)
    {
        $response = Http::asForm()->post(config('app.urlApi') . 'mahasiswa/jadwal_kuliah', [
            'nrp' => $request->nrp,
            'smt' => $request->semester,
            'APIKEY' => config('app.API_KEY')
        ]);
        $res = $response->json();
        $jadwal = $res['data'];

        $filled = RespondenAkademik::with(['detail'])->where('kuesioner_akademik_id', $id)->where('username', session('mahasiswa')['nimhsMSMHS'])->get();
        return response()->json(['jadwal' => $jadwal, 'filled' => $filled]);
    }
}
