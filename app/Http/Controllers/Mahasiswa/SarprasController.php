<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KuesionerSarpras;
use App\Models\RespondenSarpras;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SarprasController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerSarpras::with(['responden' => function (Builder $query) {
            return $query->where('username', session('mahasiswa')['nimhsMSMHS'])->exists();
        }])->forMahasiswa()->orderBy('id', 'desc')->get();
        return view('mahasiswa.sarpras.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerSarpras::with('pertanyaan.jawaban')->find($id);
        $filled = RespondenSarpras::with('detail')->where('kuesioner_sarpras_id', $id)->where('username', session('mahasiswa')['nimhsMSMHS'])->first();
        $userSession = session('mahasiswa');
        return view('mahasiswa.sarpras.show', compact('kuesioner', 'userSession', 'filled'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_sarpras_id' => 'required',
            'responden.*.pertanyaan_sarpras_id' => 'required',
            'saran' => 'required',
        ]);

        $kuesioner = KuesionerSarpras::find($id);
        $userSession = session('mahasiswa');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_sarpras by jawaban_sarpras_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_sarpras')->where('id', $value['jawaban_sarpras_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenSarpras::create([
                'kuesioner_sarpras_id' => $kuesioner->id,
                'nama' => rtrim($userSession["nmmhsMSMHS"]),
                'username' => $userSession["nimhsMSMHS"],
                'kode_fakultas' => $userSession["kdfakMSMHS"],
                'kode_prodi' => $userSession["kdjurMSMHS"],
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
