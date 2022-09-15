<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DetailRespondenVisiMisi;
use App\Models\KuesionerVisiMisi;
use App\Models\RespondenVisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiMisiController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerVisiMisi::with(['responden' => function ($query) {
            return $query->where('username', session('mahasiswa')['nimhsMSMHS'])->exists();
        }])->forMahasiswa()->orderBy('id', 'desc')->get();
        return view('mahasiswa.visi-misi.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerVisiMisi::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        $filled = RespondenVisiMisi::with('detail')->where('kuesioner_visi_misi_id', $id)->where('username', session('mahasiswa')['nimhsMSMHS'])->first();
        $userSession = session('mahasiswa');
        return view('mahasiswa.visi-misi.show', compact('kuesioner', 'userSession', 'filled'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_visi_misi_id' => 'required',
            'responden.*.pertanyaan_visi_misi_id' => 'required',
            'saran' => 'required',
        ]);
        // dd($request->all());
        $kuesioner = KuesionerVisiMisi::find($id);
        $userSession = session('mahasiswa');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            $kuesionerResponden = RespondenVisiMisi::create([
                'kuesioner_visi_misi_id' => $kuesioner->id,
                'nama' => rtrim($userSession["nmmhsMSMHS"]),
                'username' => $userSession["nimhsMSMHS"],
                'kode_fakultas' => $userSession["kdfakMSMHS"],
                'kode_prodi' => $userSession["kdjurMSMHS"],
                'tipe' => $kuesioner->tipe,
                'saran' => $request->saran,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // insert detail_respon_visi_misi
            foreach ($request->responden as $key => $value) {
                if (is_array($value['jawaban_visi_misi_id'])) {
                    foreach ($value['jawaban_visi_misi_id'] as $key => $value2) {
                        DetailRespondenVisiMisi::create([
                            'responden_visi_misi_id' => $kuesionerResponden->id,
                            'pertanyaan_visi_misi_id' => $value['pertanyaan_visi_misi_id'],
                            'jawaban_visi_misi_id' => $value2,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } else {
                    DetailRespondenVisiMisi::create([
                        'responden_visi_misi_id' => $kuesionerResponden->id,
                        'pertanyaan_visi_misi_id' => $value['pertanyaan_visi_misi_id'],
                        'jawaban_visi_misi_id' => $value['jawaban_visi_misi_id'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Berhasil mengirimkan kuesioner!');
    }
}
