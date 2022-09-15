<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KuesionerSarpras;
use App\Models\RespondenSarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SarprasController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerSarpras::with(['responden' => function ($query) {
            return $query->where('username', session('dosen')['nodosMSDOS'])->exists();
        }])->forDosen()->orderBy('id', 'desc')->get();
        return view('dosen.sarpras.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerSarpras::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        $filled = RespondenSarpras::with('detail')->where('kuesioner_sarpras_id', $id)->where('username', session('dosen')['nodosMSDOS'])->first();
        $userSession = session('dosen');
        return view('dosen.sarpras.show', compact('kuesioner', 'userSession', 'filled'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_sarpras_id' => 'required',
            'responden.*.pertanyaan_sarpras_id' => 'required',
            'saran' => 'required',
        ]);

        $kuesioner = KuesionerSarpras::find($id);
        $userSession = session('dosen');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_sarpras by jawaban_sarpras_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_sarpras')->where('id', $value['jawaban_sarpras_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenSarpras::create([
                'kuesioner_sarpras_id' => $kuesioner->id,
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

            // insert detail_respon_sarpras
            foreach ($request->responden as $key => $value) {
                DB::table('detail_respon_sarpras')->insert([
                    'responden_sarpras_id' => $kuesionerResponden->id,
                    'pertanyaan_sarpras_id' => $value['pertanyaan_sarpras_id'],
                    'jawaban_sarpras_id' => $value['jawaban_sarpras_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Berhasil mengirimkan kuesioner!');
    }
}
