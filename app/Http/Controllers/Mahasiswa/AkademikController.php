<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KuesionerAkademik;
use App\Models\RespondenAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerAkademik::forMahasiswa()->get(['id', 'judul', 'semester', 'kegiatan']);
        return view('mahasiswa.akademik.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerAkademik::with('pertanyaan.jawaban')->find($id);
        $userSession = session('mahasiswa');
        return view('mahasiswa.akademik.show', compact('kuesioner', 'userSession'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_akademik_id' => 'required',
            'responden.*.pertanyaan_akademik_id' => 'required',
            'saran' => 'required',
            'select_matkul' => 'required',
            'nama_dosen' => 'required',
        ]);

        $kuesioner = KuesionerAkademik::find($id);
        $userSession = session('mahasiswa');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_akademik by jawaban_akademik_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_akademik')->where('id', $value['jawaban_akademik_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenAkademik::create([
                'kuesioner_akademik_id' => $kuesioner->id,
                'nama' => rtrim($userSession["nmmhsMSMHS"]),
                'username' => $userSession["nimhsMSMHS"],
                'kode_fakultas' => $request->kode_fakultas,
                'kode_prodi' => $request->kode_prodi,
                'kode_matkul' => $request->kode_matkul,
                'kelas' => $request->kelas,
                'nama_matkul' => $request->nama_matkul,
                'nama_dosen' => $request->nama_dosen,
                'nodos' => $request->nodos,
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
