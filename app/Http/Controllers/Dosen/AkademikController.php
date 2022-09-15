<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KuesionerAkademik;
use App\Models\RespondenAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerAkademik::forDosen()->orderBy('id', 'desc')->get();
        return view('dosen.akademik.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerAkademik::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        $userSession = session('dosen');
        return view('dosen.akademik.show', compact('kuesioner', 'userSession'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_akademik_id' => 'required',
            'responden.*.pertanyaan_akademik_id' => 'required',
            'saran' => 'required',
            'select_matkul' => 'required',
        ]);

        $kuesioner = KuesionerAkademik::find($id);
        $userSession = session('dosen');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_akademik by jawaban_akademik_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_akademik')->where('id', $value['jawaban_akademik_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenAkademik::create([
                'kuesioner_akademik_id' => $kuesioner->id,
                'nama' => rtrim($userSession["nmdosMSDOS"]),
                'username' => $userSession["nodosMSDOS"],
                'kode_fakultas' => $request->kode_fakultas,
                'kode_prodi' => $request->kode_prodi,
                'kode_matkul' => $request->kode_matkul,
                'kelas' => $request->kelas,
                'nama_matkul' => $request->nama_matkul,
                'tipe' => $kuesioner->tipe,
                'saran' => $request->saran,
                'indeks' => $indeks,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // insert detail_respon_akademik
            foreach ($request->responden as $key => $value) {
                DB::table('detail_respon_akademik')->insert([
                    'responden_akademik_id' => $kuesionerResponden->id,
                    'pertanyaan_akademik_id' => $value['pertanyaan_akademik_id'],
                    'jawaban_akademik_id' => $value['jawaban_akademik_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Berhasil mengirimkan kuesioner!');
    }
}
