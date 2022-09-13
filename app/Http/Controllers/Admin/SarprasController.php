<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KuesionerSarpras;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SarprasController extends Controller
{
    public function index()
    {
        return view('admin.sarpras.index');
    }

    public function list(Request $request)
    {
        $data = KuesionerSarpras::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipe', function ($row) {
                return Str::ucfirst($row->tipe);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.sarpras.edit', $row->id);
                $show_url = route('admin.sarpras.show', $row->id);
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
        return view('admin.sarpras.create');
    }

    public function show($id)
    {
        $kuesioner = KuesionerSarpras::with('pertanyaan.jawaban')->find($id);
        return view('admin.sarpras.show', compact('kuesioner'));
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
            // add data kuesioner sarpras dengan pertanyaan dan jawaban
            $kuesioner = KuesionerSarpras::create([
                'judul' => $request->judul,
                'tipe' => $request->tipe,
                'keterangan' => $request->keterangan,
                'semester' => $request->semester,
                'kegiatan' => $request->kegiatan,
            ]);

            $pertanyaan_sarpras = array(
                array(
                    "pertanyaan" => "Prosedur pelayanan keuangan yang mudah dipahami.",
                    "nomor" => 1,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Kecepatan proses pemberian layanan keuangan.",
                    "nomor" => 2,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ketersediaan layanan keuangan sesuai kebutuhan.",
                    "nomor" => 3,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Tanggapan petugas keuangan cepat dan tepat terhadap keluhan pengguna layanan.",
                    "nomor" => 4,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Petugas keuangan memberikan informasi secara jelas dan mudah dimengerti.",
                    "nomor" => 5,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Alat dan Bahan Praktikum (tersedia, berfungsi dan jumlah alat/bahan cukup, dan tersedia SOP).",
                    "nomor" => 6,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ruang Laboratorium (kebersihan, kecukupan luas ruangan, dan arah evakuai saat bahaya).",
                    "nomor" => 7,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ruang laboratorium selalu siap digunakan dan jadwal terstruktur.",
                    "nomor" => 8,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboratorium mendukung kegiatan pembelajaran.",
                    "nomor" => 9,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Petunjuk pelayanan (ketersedian dan akses) peminjaman ruang laboratorium, alat, dan bahan praktikum.",
                    "nomor" => 10,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Petunjuk peminjaman alat dan bahan.",
                    "nomor" => 11,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Tersedianya jadwal praktikum yang terstruktur.",
                    "nomor" => 12,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboran menyiapkan peralatan dan bahan yang dibutuhkan pada setiap kegiatan pembelajaran di laboratorium.",
                    "nomor" => 13,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ketepatan waktu laboran dalam menyiapkan peminjaman alat dan bahan praktikum.",
                    "nomor" => 14,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboran mengecek peralatan (kelengkapan, kerusakan) setiap selesai digunakan.",
                    "nomor" => 15,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboran bersikap ramah, sopan, dan bertanggungjawab.",
                    "nomor" => 16,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboran menguasai informasi terkait laboratorium.",
                    "nomor" => 17,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Laboran melayani sesuai dengan nilai-nilai institusi (emphaty, humble, genuine, helpful, loyalty, forgiving).",
                    "nomor" => 18,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Pustakawan membantu saat membutuhkan informasi di menemukan informasi di Perpustakaan.",
                    "nomor" => 19,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Pustakawan bersikap ramah, sopan dan bertanggungjawab saat memberikan pelayanan.",
                    "nomor" => 20,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Perpustakaan menyediakan koleksi (buku dan jurnal) untuk menunjang kegiatan belajar.",
                    "nomor" => 21,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Perpustakaan menyediakan koleksi (buku dan jurnal) elektronik untuk memenuhi informasi mahasiswa.",
                    "nomor" => 22,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Perpustakaan menyediakan (buku dan Jurnal) tercetak versi mutakhir (terkini).",
                    "nomor" => 23,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Koleksi buku mudah diakses baik versi cetak dan elektronik.",
                    "nomor" => 24,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Itenas memiliki sistem informasi untuk layanan proses pembelajaran dan program kreativitas mahasiswa.",
                    "nomor" => 25,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Website Itenas mudah diakses.",
                    "nomor" => 26,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Website Itenas memberikan informasi terbaru mengenai kegiatan dan prestasi yang diperoleh.",
                    "nomor" => 27,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Itenas memiliki fasilitas Sistem Informasi akademik (SIKAD).",
                    "nomor" => 28,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Sistem Informasi akademik (SIKAD) Itenas mudah diakses oleh seluruh sivitas akademik.",
                    "nomor" => 29,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Itenas memiliki sistem informasi administrasi, akademik, keuangan, SDM, dan sarana prasarana yang efektif.",
                    "nomor" => 30,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Staf UPT TIK merawat hardware komputer dan pembaharuan software computer.",
                    "nomor" => 31,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Staf UPT TIK melakukan perawatan terhadap jaringan koneksi internet dan jaringan area network internal.",
                    "nomor" => 32,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Staf UPT TIK memberikan layanan dengan baik.",
                    "nomor" => 33,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Staf UPT TIK memberikan pengarahan dan pemahaman untuk penggunaan perangkat teknologi/komputer dan jaringan di area kampus.",
                    "nomor" => 34,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Staf UPT TIK memberikan pelatihan sistem informasi kepada sivitas akademik.",
                    "nomor" => 35,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ruang kuliah tertata dengan bersih dan rapi.",
                    "nomor" => 36,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ruang kuliah sejuk dan nyaman.",
                    "nomor" => 37,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Sarana pembelajaran tersedia di ruang kuliah.",
                    "nomor" => 38,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Sarana pembelajaran berfungsi dengan baik.",
                    "nomor" => 39,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ketersediaan fasilitas kamar kecil/toilet yang cukup dan bersih.",
                    "nomor" => 40,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ketersediaan fasilitas tempat ibadah.",
                    "nomor" => 41,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Ketersediaan fasilitas berkegiatan dan bekerja untuk mahasiswa.",
                    "nomor" => 42,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
            );

            $kuesioner->pertanyaan()->createMany($pertanyaan_sarpras)->each(function ($item, $key) {
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

        return redirect()->route('admin.sarpras.index')->with('success', 'Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $kuesioner = KuesionerSarpras::find($id);
        return view('admin.sarpras.edit', compact('kuesioner'));
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

        $kuesioner = KuesionerSarpras::find($id);
        $kuesioner->update($request->all());

        return redirect()->route('admin.sarpras.index')->with('success', 'Kuesioner berhasil diubah');
    }

    public function destroy($id)
    {
        $kuesioner = KuesionerSarpras::find($id);
        $kuesioner->delete();

        return response()->json(['status' => TRUE]);
    }
}
