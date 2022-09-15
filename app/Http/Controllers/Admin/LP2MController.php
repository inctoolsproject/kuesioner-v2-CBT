<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KuesionerLP2M;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LP2MController extends Controller
{
    public function index()
    {
        return view('admin.lp2m.index');
    }

    public function list(Request $request)
    {
        $data = KuesionerLP2M::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipe', function ($row) {
                return Str::ucfirst($row->tipe);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.lp2m.edit', $row->id);
                $show_url = route('admin.lp2m.show', $row->id);
                $actionBtn = '
                <a class="btn btn-sm text-white btn-success" href="' . $show_url . '" target="_blank">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <a class="btn btn-sm text-white btn-info" href="' . $edit_url . '">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn btn-sm text-white btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->judul . '" href="#">
                    <i class="fa-solid fa-trash-can"></i>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        $kuesioner = KuesionerLP2M::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        return view('admin.lp2m.show', compact('kuesioner'));
    }

    public function create()
    {
        return view('admin.lp2m.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
            'semester' => 'required',
            'kegiatan' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            // add data kuesioner fakultas dengan pertanyaan dan jawaban
            $kuesioner = KuesionerLP2M::create([
                'judul' => $request->judul,
                'tipe' => $request->tipe,
                'keterangan' => $request->keterangan,
                'semester' => $request->semester,
                'kegiatan' => $request->kegiatan,
            ]);

            $pertanyaan_lp2m = array(
                array(
                    "pertanyaan" => "Sosialisasi peluang publikasi ilmiah eksternal dari LP2M",
                    "nomor" => 1,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Sosialisasi peluang publikasi ilmiah eksternal dari LP2M",
                    "nomor" => 2,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Peran website LP2M dalam merepresentasikan Institut (memuat informasi mengenai profil dan keahlian dosen, serta kelengkapan sarana prasarana kampus)",
                    "nomor" => 3,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Intensifikasi pembinaan dosen oleh LP2M dalam kegiatan penelitian",
                    "nomor" => 4,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Intensifikasi pembinaan dosen oleh LP2M dalam kegiatan pengabdian kepada masyarakat",
                    "nomor" => 5,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Keterlibatan civitas akademika dalam proses monitoring dan evaluasi LP2M ",
                    "nomor" => 6,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Transparansi pendanaan kegiatan penelitian oleh LP2M",
                    "nomor" => 7,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Transparansi pendanaan kegiatan pengabdian kepada masyarakat oleh LP2M",
                    "nomor" => 8,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Peran roadmap penelitian LP2M dalam memayungi roadmap Prodi dan Dosen",
                    "nomor" => 9,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Upaya LPPM dalam mendorong dan memfasilitasi proses perolehan hak kekayaan intelektual (HKI)",
                    "nomor" => 10,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kinerja SIMPENMAS",
                    "nomor" => 11,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kinerja/pelayanan pegawai LP2M dalam memfasilitasi kegiatan penelitian",
                    "nomor" => 12,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kinerja/pelayanan pegawai LP2M dalam memfasilitasi kegiatan pengabdian kepada masyarakat",
                    "nomor" => 13,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kinerja/pelayanan LP2M dalam diseminasi dan publikasi hasil penelitian dan pengabdian oleh civitas akademika",
                    "nomor" => 14,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kinerja/pelayanan LP2M dalam memfasilitasi Kerjasama Prodi dengan Instansi lain",
                    "nomor" => 15,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
            );

            $kuesioner->pertanyaan()->createMany($pertanyaan_lp2m)->each(function ($item, $key) {
                $jawaban = [
                    array(
                        "jawaban" => "Sangat Tidak Puas",
                        "nilai" => 1,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ),
                    array(
                        "jawaban" => "Tidak Puas",
                        "nilai" => 2,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ),
                    array(
                        "jawaban" => "Puas",
                        "nilai" => 3,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ),
                    array(
                        "jawaban" => "Sangat Puas",
                        "nilai" => 4,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ),
                ];
                $item->jawaban()->createMany($jawaban);
            });
        });

        return redirect()->route('admin.lp2m.index')->with('success', 'Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $kuesioner = KuesionerLP2M::find($id);
        return view('admin.lp2m.edit', compact('kuesioner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
            'semester' => 'required',
            'kegiatan' => 'required',
        ]);

        $kuesioner = KuesionerLP2M::find($id);
        $kuesioner->update($request->all());

        return redirect()->route('admin.lp2m.index')->with('success', 'Kuesioner berhasil diubah');
    }

    public function destroy($id)
    {
        $kuesioner = KuesionerLP2M::find($id);
        $kuesioner->delete();

        return response()->json(['status' => TRUE]);
    }
}
