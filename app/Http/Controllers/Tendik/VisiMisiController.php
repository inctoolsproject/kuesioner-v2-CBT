<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use App\Models\DetailRespondenVisiMisi;
use App\Models\KuesionerVisiMisi;
use App\Models\RespondenVisiMisi;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiMisiController extends Controller
{
    public function index()
    {
        $kuesioner = KuesionerVisiMisi::with(['responden' => function (Builder $query) {
            return $query->where('username', auth()->user()->username)->exists();
        }])->forDosen()->orderBy('id', 'desc')->get();
        return view('tendik.visi-misi.index', compact('kuesioner'));
    }

    public function show($id)
    {
        $kuesioner = KuesionerVisiMisi::with('pertanyaan.jawaban')->find($id);
        $filled = RespondenVisiMisi::with('detail')->where('kuesioner_visi_misi_id', $id)->where('username', auth()->user()->username)->first();
        return view('tendik.visi-misi.show', compact('kuesioner', 'filled'));
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
        DB::transaction(function () use ($kuesioner, $request) {
            $kuesionerResponden = RespondenVisiMisi::create([
                'kuesioner_visi_misi_id' => $kuesioner->id,
                'nama' => auth()->user()->name,
                'username' => auth()->user()->username,
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
