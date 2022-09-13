<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KuesionerFakultas;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FakultasController extends Controller
{
    public function index()
    {
        return view('admin.fakultas.index');
    }

    public function list(Request $request)
    {
        $data = KuesionerFakultas::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipe', function ($row) {
                return Str::ucfirst($row->tipe);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.fakultas.edit', $row->id);
                $show_url = route('admin.fakultas.show', $row->id);
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
        return view('admin.fakultas.create');
    }

    public function show($id)
    {
        $kuesioner = KuesionerFakultas::with('pertanyaan.jawaban')->find($id);
        return view('admin.fakultas.show', compact('kuesioner'));
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
            $kuesioner = KuesionerFakultas::create([
                'judul' => $request->judul,
                'tipe' => $request->tipe,
                'keterangan' => $request->keterangan,
                'semester' => $request->semester,
                'kegiatan' => $request->kegiatan,
            ]);

            $pertanyaan_fakultas = array(
                array(
                    "pertanyaan" => "Kesesuaian penyusunan SK mengajar dengan kesediaan dosen",
                    "nomor" => 1,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan jadwal penetapan dosen pengampu mata kuliah setiap semester",
                    "nomor" => 2,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan jadwal penyerahan distribusi mengajar dari prodi",
                    "nomor" => 3,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan proporsi jumlah kelas untuk pembagian kelas setiap mata kuliah setiap semester",
                    "nomor" => 4,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan jadwal penyerahan hasil evaluasi pembagian kelas dari prodi ",
                    "nomor" => 5,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan jadwal penyusunan Rencana Kerja Dosen (RKD) dan Jadwal Kerja Dosen (JKD) setiap semester",
                    "nomor" => 6,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan Daftar Hadir Kelas untuk kegiatan kuliah",
                    "nomor" => 7,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan Daftar Hadir Kelas untuk kegiatan responsi (jika ada)",
                    "nomor" => 8,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan jadwal penyusunan Rencana Pembelajaran Semester (RPS) dan Laporan Pengampu (awal, tengah, dan akhir)",
                    "nomor" => 9,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan template format Rencana Pembelajaran Semester (RPS)",
                    "nomor" => 10,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan template format Laporan Pengampu (awal, tengah, dan akhir)",
                    "nomor" => 11,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyusun dan menginformasikan pelaksanaan jadwal UTS dan UAS setiap mata kuliah setiap semester",
                    "nomor" => 12,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Memberikan informasi waktu pengumpulan soal dan solusi ujian, dan batas waktu posting nilai akhir kuliah",
                    "nomor" => 13,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kesesuaian rekapitulasi data dengan data aktual terkait waktu pengumpulan soal dan solusi ujian, dan batas waktu posting nilai akhir kuliah",
                    "nomor" => 14,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menginformasikan hasil evaluasi proses pembelajaran setiap semester",
                    "nomor" => 15,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan data secara tepat dan akurat untuk penilaian kinerja dosen setiap semester",
                    "nomor" => 16,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan dan mendistribusikan SK pembimbing Tugas Akhir (TA)",
                    "nomor" => 17,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan dan mendistribusikan SK penguji Tugas Akhir (TA)",
                    "nomor" => 18,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan dan mendistribusikan SK pembimbing Praktik Kerja (KP)",
                    "nomor" => 19,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan dan mendistribusikan SK penguji Praktik Kerja (KP)",
                    "nomor" => 20,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan kelengkapan kebutuhan dalam pelaksanaan kuliah daring (pembuatan courses, kelas dan daftar hadir mahasiswa di Moodle)",
                    "nomor" => 21,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan untuk kegiatan Penelitian",
                    "nomor" => 22,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan dan Wakil Dekan untuk kegiatan PKM",
                    "nomor" => 23,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan dan Wakil Dekan untuk kegiatan lain",
                    "nomor" => 24,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Mengoordinasikan penyelanggaraan seminar / workshop tingkat nasional",
                    "nomor" => 25,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Mengoordinasikan penyelanggaraan seminar / workshop tingkat internasional",
                    "nomor" => 26,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan informasi kegiatan dengan pihak internal maupun eksternal, seperti: seminar, workshop, pelatihan, dll",
                    "nomor" => 27,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan informasi yang jelas dan update berkaitan dengan studi lanjut bagi dosen",
                    "nomor" => 28,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan informasi yang jelas dan update berkaitan dengan kegiatan kepakaran bagi dosen",
                    "nomor" => 29,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menyediakan informasi kerjasama baik dengan pihak internal maupun eksternal kampus",
                    "nomor" => 30,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
            );

            $kuesioner->pertanyaan()->createMany($pertanyaan_fakultas)->each(function ($item, $key) {
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

        return redirect()->route('admin.fakultas.index')->with('success', 'Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $kuesioner = KuesionerFakultas::find($id);
        return view('admin.fakultas.edit', compact('kuesioner'));
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

        $kuesioner = KuesionerFakultas::find($id);
        $kuesioner->update($request->all());

        return redirect()->route('admin.fakultas.index')->with('success', 'Kuesioner berhasil diubah');
    }

    public function destroy($id)
    {
        $kuesioner = KuesionerFakultas::find($id);
        $kuesioner->delete();

        return response()->json(['status' => TRUE]);
    }
}
