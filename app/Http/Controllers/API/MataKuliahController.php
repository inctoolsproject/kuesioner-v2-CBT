<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RespondenAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MataKuliahController extends Controller
{
    public function mahasiswa(Request $request, $id)
    {
        try {
            $response = Http::asForm()->post(config('app.urlApi') . 'mahasiswa/jadwal_kuliah', [
                'nrp' => $request->nrp,
                'smt' => $request->semester,
                'APIKEY' => config('app.API_KEY')
            ]);
            $res = $response->json();
            $jadwal = $res['data'];

            $filled = RespondenAkademik::with(['detail'])->where('kuesioner_akademik_id', $id)->where('username', session('mahasiswa')['nimhsMSMHS'])->get();
            return response()->json(['success' => true, 'jadwal' => $jadwal, 'filled' => $filled, 'message' => 'Berhasil mengambil data']);
        } catch (\Exception $e) {
            Log::error('[Mahasiswa Jadwal Kuliah] ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function dosen(Request $request, $id)
    {
        try {
            $response = Http::asForm()->post(config('app.urlApi') . 'dosen/jadwal_kuliah', [
                'nodos' => $request->nodos,
                'smt' => $request->semester,
                'APIKEY' => config('app.API_KEY')
            ]);
            $res = $response->json();
            $jadwal = $res['data'];

            $filled = RespondenAkademik::with(['detail'])->where('kuesioner_akademik_id', $id)->where('username', session('dosen')['nodosMSDOS'])->get();
            return response()->json(['success' => true, 'jadwal' => $jadwal, 'filled' => $filled, 'message' => 'Berhasil mengambil data']);
        } catch (\Exception $e) {
            Log::error('[Dosen Jadwal Kuliah] ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
