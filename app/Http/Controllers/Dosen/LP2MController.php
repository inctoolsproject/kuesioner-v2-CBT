<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KuesionerLP2M;
use App\Models\RespondenLP2M;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LP2MController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerLP2M::with(['responden' => function (Builder $query) {
            return $query->where('username', session('dosen')['nodosMSDOS'])->exists();
        }])->forDosen()->orderBy('id', 'desc')->get();
        return view('dosen.lp2m.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerLP2M::with('pertanyaan.jawaban')->find($id);
        $filled = RespondenLP2M::with('detail')->where('kuesioner_lp2m_id', $id)->where('username', session('dosen')['nodosMSDOS'])->first();
        $userSession = session('dosen');
        return view('dosen.lp2m.show', compact('kuesioner', 'userSession', 'filled'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'responden.*.jawaban_lp2m_id' => 'required',
            'responden.*.pertanyaan_lp2m_id' => 'required',
            'saran' => 'required',
        ]);

        $kuesioner = KuesionerLP2M::find($id);
        $userSession = session('dosen');
        DB::transaction(function () use ($kuesioner, $userSession, $request) {
            // get nilai field from jawaban_lp2m by jawaban_lp2m_id
            $total = 0;
            foreach ($request->responden as $key => $value) {
                $total += DB::table('jawaban_lp2m')->where('id', $value['jawaban_lp2m_id'])->value('nilai');
            }
            $indeks = round($total / count($request->responden), 2);

            $kuesionerResponden = RespondenLP2M::create([
                'kuesioner_lp2m_id' => $kuesioner->id,
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

            // insert detail_respon_lp2m
            foreach ($request->responden as $key => $value) {
                DB::table('detail_respon_lp2m')->insert([
                    'responden_lp2m_id' => $kuesionerResponden->id,
                    'pertanyaan_lp2m_id' => $value['pertanyaan_lp2m_id'],
                    'jawaban_lp2m_id' => $value['jawaban_lp2m_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Berhasil mengirimkan kuesioner!');
    }
}
