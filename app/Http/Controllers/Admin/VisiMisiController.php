<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KuesionerVisiMisi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VisiMisiController extends Controller
{
    public function index()
    {
        return view('admin.visi-misi.index');
    }

    public function list(Request $request)
    {
        $data = KuesionerVisiMisi::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipe', function ($row) {
                return Str::ucfirst($row->tipe);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.visi-misi.edit', $row->id);
                $show_url = route('admin.visi-misi.show', $row->id);
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
        return view('admin.visi-misi.create');
    }

    public function show($id)
    {
        $kuesioner = KuesionerVisiMisi::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
        return view('admin.visi-misi.show', compact('kuesioner'));
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
            $kuesioner = KuesionerVisiMisi::create([
                'judul' => $request->judul,
                'tipe' => $request->tipe,
                'keterangan' => $request->keterangan,
                'semester' => $request->semester,
                'kegiatan' => $request->kegiatan,
            ]);

            $pertanyaan_visi_misi = array(
                array(
                    "pertanyaan" => "Berapa lama Bpk/Ibu/Sdr/i sudah bergabung dengan Itenas?",
                    "nomor" => 1,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Apakah Anda pernah membaca Visi, Misi dan Tujuan Itenas?",
                    "nomor" => 2,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Jika jawaban No. 2 adalah Pernah, pilih semua media sumber Bpk/Ibu/Sdr/imendapatkan informasi tentang Visi, Misi dan Tujuan Itenas?",
                    "nomor" => 3,
                    "tipe" => 2,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Menurut Anda, Visi, Misi dan Tujuan telah tercermin pada",
                    "nomor" => 4,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Visi Itenas",
                    "nomor" => 5,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Misi Itenas",
                    "nomor" => 6,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
                array(
                    "pertanyaan" => "Tujuan Itenas",
                    "nomor" => 7,
                    "tipe" => 1,
                    "created_at" => now(),
                    "updated_at" => now(),
                ),
            );


            $kuesioner->pertanyaan()->createMany($pertanyaan_visi_misi)->each(function ($item, $key) {
                switch ($item->nomor) {
                    case 1:
                        $jawaban = [
                            array(
                                "jawaban" => "< 1 Tahun",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "1-5 Tahun",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "5-10 Tahun",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "< 10 Tahun",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                        ];
                        break;

                    case 2:
                        $jawaban = [
                            array(
                                "jawaban" => "Pernah",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Tidak Pernah",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                        ];
                        break;

                    case 3:
                        $jawaban = [
                            array(
                                "jawaban" => "URL https://itenas.ac.id",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Buku panduan/pedoman",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Poster/banner/youtube",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Rapat-rapat rutin",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Media Sosial",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                        ];
                        break;
                    case 4:
                        $jawaban = [
                            array(
                                "jawaban" => "Kurikulum",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Proses pembelajaran",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Penelitian dosen/mahasiswa",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Pengabdian kepada masyarakat dosen/mahasiswa",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Kompetensi dosen/tendik/mahasiswa",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                        ];
                        break;
                    default:
                        $jawaban = [
                            array(
                                "jawaban" => "Kurang Paham",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Paham",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                            array(
                                "jawaban" => "Sangat Paham",
                                "created_at" => now(),
                                "updated_at" => now(),
                            ),
                        ];
                        break;
                }
                $item->jawaban()->createMany($jawaban);
            });
        });

        return redirect()->route('admin.visi-misi.index')->with('success', 'Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $kuesioner = KuesionerVisiMisi::find($id);
        return view('admin.visi-misi.edit', compact('kuesioner'));
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

        $kuesioner = KuesionerVisiMisi::find($id);
        $kuesioner->update($request->all());

        return redirect()->route('admin.visi-misi.index')->with('success', 'Kuesioner berhasil diubah');
    }

    public function destroy($id)
    {
        $kuesioner = KuesionerVisiMisi::find($id);
        $kuesioner->delete();

        return response()->json(['status' => TRUE]);
    }
}
