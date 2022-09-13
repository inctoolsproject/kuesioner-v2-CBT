<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KuesionerAkademik;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AkademikController extends Controller
{
    public function index()
    {
        return view('admin.akademik.index');
    }

    public function list(Request $request)
    {
        $data = KuesionerAkademik::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipe', function ($row) {
                return Str::ucfirst($row->tipe);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.akademik.edit', $row->id);
                $show_url = route('admin.akademik.show', $row->id);
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

    public function create()
    {
        return view('admin.akademik.create');
    }

    public function show($id)
    {
        $kuesioner = KuesionerAkademik::with('pertanyaan.jawaban')->find($id);
        return view('admin.akademik.show', compact('kuesioner'));
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
            // add data kuesioner akademik dengan pertanyaan dan jawaban
            $kuesioner = KuesionerAkademik::create([
                'judul' => $request->judul,
                'tipe' => $request->tipe,
                'keterangan' => $request->keterangan,
                'semester' => $request->semester,
                'kegiatan' => $request->kegiatan,
            ]);

            $pertanyaan_akademik = [
                array(
                    "pertanyaan" => "Kesiapan dosen dalam mempersiapkan materi perkuliahan (video, hand out presentasi, bahan bacaan, atau link materi disematkan pada sistem e-learning)",
                    "nomor" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kejelasan penyampaian materi perkuliahan (meeting online atau materi online)",
                    "nomor" => 2,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kelengkapan materi perkuliahan dosen (RPS online, viseo, hand out presentasi, bahan bacaan, atau link materi disematkan pada sistem e-learning)",
                    "nomor" => 3,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemampuan dosen menggunakan media pembelajaran daring (penggunaan modul-modul di sistem e-learning dan berbagai media interaktif online lainnya)",
                    "nomor" => 4,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemampuan dosen menyampaikan materi perkuliahan dengan metode daring yang bervariasi (ceramah, diskusi, problem-based learning, project-based learning)",
                    "nomor" => 5,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Dosen mengembalikan hasil ujian/tugas dengan hasil penilaian yang obyektif",
                    "nomor" => 6,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kecepatan dosen dalam membantu mahasiswa di waktu perkuliahan online",
                    "nomor" => 7,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kesesuaian kehadiran dosen sesuai dengan jadwal yang telah ditentukan",
                    "nomor" => 8,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kesesuaian materi kuliah dengan Rencana Perkuliahan",
                    "nomor" => 9,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kesediaan dosen untuk membantu mahasiswa yang mengalami kesulitan di waktu perkuliahan online",
                    "nomor" => 10,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemudahan mengakses sistem informasi (sistem e-learning Moodle, sikad, website, dan layanan e-mail) dari luar lingkungan kampus",
                    "nomor" => 11,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kualitas sarana dan prasarana perkuliahan secara daring (sistem e-learning Moodle, peralatan informasi, koneksi jaringan dan server)",
                    "nomor" => 12,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Dukungan pimpinan terhadap terbangunnya suasana akademik",
                    "nomor" => 13,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Dukungan dosen terhadap terbangunnya suasana akademik",
                    "nomor" => 14,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Layanan tendik terhadap terbangunnya suasana akademik",
                    "nomor" => 15,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
            ];

            $kuesioner->pertanyaan()->createMany($pertanyaan_akademik)->each(function ($item, $key) {
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

        return redirect()->route('admin.akademik.index')->with('success', 'Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $kuesioner = KuesionerAkademik::find($id);
        return view('admin.akademik.edit', compact('kuesioner'));
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

        $kuesioner = KuesionerAkademik::find($id);
        $kuesioner->update($request->all());

        return redirect()->route('admin.akademik.index')->with('success', 'Kuesioner berhasil diubah');
    }

    public function destroy($id)
    {
        $kuesioner = KuesionerAkademik::find($id);
        $kuesioner->delete();

        return response()->json(['status' => TRUE]);
    }
}
