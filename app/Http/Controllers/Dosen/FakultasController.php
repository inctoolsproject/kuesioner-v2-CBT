<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KuesionerFakultas;
use App\Models\RespondenFakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakultasController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerFakultas::with(['responden' => function ($query) {
            return $query->where('username', session('dosen')['nodosMSDOS'])->exists();
        }])->forDosen()->orderBy('id', 'desc')->get();
        return view('dosen.fakultas.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerFakultas::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        $filled = RespondenFakultas::with('detail')->where('kuesioner_fakultas_id', $id)->where('username', session('dosen')['nodosMSDOS'])->first();
        $userSession = session('dosen');
        return view('dosen.fakultas.show', compact('kuesioner', 'userSession', 'filled'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_fakultas_id' => 'required',
            'responden.*.pertanyaan_fakultas_id' => 'required',
            'saran' => 'required',
        ]);

        $kuesioner = KuesionerFakultas::find($id);
        $userSession = session('dosen');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_fakultas by jawaban_fakultas_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_fakultas')->where('id', $value['jawaban_fakultas_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenFakultas::create([
                'kuesioner_fakultas_id' => $kuesioner->id,
                'nama' => rtrim($userSession["nmdosMSDOS"]),
                'username' => $userSession["nodosMSDOS"],
                'kode_fakultas' => $userSession["kdfakMSDOS"],
                'kode_prodi' => $userSession["kdjurMSDOS"],
                'tipe' => $kuesioner->tipe,
                'saran' => $request->saran,
                'indeks' => $indeks,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // insert detail_respon_fakultas
            foreach ($request->responden as $key => $value) {
                DB::table('detail_respon_fakultas')->insert([
                    'responden_fakultas_id' => $kuesionerResponden->id,
                    'pertanyaan_fakultas_id' => $value['pertanyaan_fakultas_id'],
                    'jawaban_fakultas_id' => $value['jawaban_fakultas_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Berhasil mengirimkan kuesioner!');
    }
}
