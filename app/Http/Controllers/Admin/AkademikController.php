<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KepuasanDosenExport;
use App\Exports\KepuasanMahasiswaExport;
use App\Exports\KuesionerAkademikDosenExport;
use App\Exports\KuesionerAkademikMahasiswa;
use App\Exports\KuesionerAkademikMahasiswaExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\TemplatePertanyaanTrait;
use App\Models\KuesionerAkademik;
use App\Models\RespondenAkademik;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AkademikController extends Controller
{
	use TemplatePertanyaanTrait;
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
        $kuesioner = KuesionerAkademik::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->findOrFail($id);
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

            $this->createPertanyaanAkademik($kuesioner);
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

    public function mahasiswa()
    {
        $semester = KuesionerAkademik::select(DB::raw("DISTINCT semester, kegiatan, id"))->forMahasiswa()->get();
        return view('admin.akademik.mahasiswa', compact('semester'));
    }

    public function mahasiswa_list(Request $request)
    {
        $data = RespondenAkademik::selectRaw('nama_matkul, kode_matkul, kelas, nama_dosen, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'mahasiswa')->where('kuesioner_akademik_id', $request->get('filter1'), '', 'and')->groupBy('kode_matkul', 'nama_matkul', 'kelas', 'nama_dosen', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function mahasiswa_export(Request $request)
    {
        $kuesioner = KuesionerAkademik::find($request->get('filter1'));
        $tahun = $request->get('filter1') != "<>" ? $kuesioner->semester . ' ' . $kuesioner->kegiatan : 'All';
        $filename = 'Data Kuesioner Akademik Mahasiswa ' . $tahun . '.xlsx';
        return Excel::download(new KuesionerAkademikMahasiswaExport($request->get('filter1')), $filename);
    }

    public function dosen()
    {
        $semester = KuesionerAkademik::select(DB::raw("DISTINCT semester, kegiatan, id"))->forDosen()->get();
        return view('admin.akademik.dosen', compact('semester'));
    }

    public function dosen_list(Request $request)
    {
        $data = RespondenAkademik::selectRaw('nama_matkul, kode_matkul, kelas, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'dosen')->where('kuesioner_akademik_id', $request->get('filter1'), '', 'and')->groupBy('kode_matkul', 'nama_matkul', 'kelas', 'nama', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function dosen_export(Request $request)
    {
        $kuesioner = KuesionerAkademik::find($request->get('filter1'));
        $tahun = $request->get('filter1') != "<>" ? $kuesioner->semester . ' ' . $kuesioner->kegiatan : 'All';
        $filename = 'Data Kuesioner Akademik Dosen ' . $tahun . '.xlsx';
        return Excel::download(new KuesionerAkademikDosenExport($request->get('filter1')), $filename);
    }

    public function kepuasan_dosen()
    {
        $semester = KuesionerAkademik::select(DB::raw("DISTINCT semester, kegiatan, id"))->where('tipe', 'dosen')->get();
        return view('admin.akademik.kepuasan.dosen', compact('semester'));
    }

    public function kepuasan_dosen_list(Request $request)
    {
        $data = DB::table('responden_akademik')->select(DB::raw('responden_akademik.nama, responden_akademik.username, prodi.nama as prodi, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks'))->join('prodi', function ($join) {
            $join->on('prodi.kode', '=', 'responden_akademik.kode_prodi')->on('prodi.kode_fakultas', '=', 'responden_akademik.kode_fakultas');
        })->where('responden_akademik.tipe', 'dosen')->where('responden_akademik.kuesioner_akademik_id', $request->get('filter1'), '', 'and')->groupBy('responden_akademik.nama', 'responden_akademik.username', 'prodi.nama', 'indeks')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function kepuasan_dosen_export(Request $request)
    {
        $kuesioner = KuesionerAkademik::find($request->get('filter1'));
        $tahun = $request->get('filter1') != "<>" ? $kuesioner->semester . ' ' . $kuesioner->kegiatan : 'All';
        $filename = 'Kepuasan Dosen Per Prodi ' . $tahun . '.xlsx';
        return Excel::download(new KepuasanDosenExport($request->get('filter1')), $filename);
    }

    public function kepuasan_mahasiswa()
    {
        $semester = KuesionerAkademik::select(DB::raw("DISTINCT semester, kegiatan, id"))->where('tipe', 'mahasiswa')->get();
        return view('admin.akademik.kepuasan.mahasiswa', compact('semester'));
    }

    public function kepuasan_mahasiswa_list(Request $request)
    {
        $data = DB::select("call kepuasan_mahasiswa_per_prodi({$request->get('filter1')})");
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function kepuasan_mahasiswa_export(Request $request)
    {
        $kuesioner = KuesionerAkademik::find($request->get('filter1'));
        $tahun = $request->get('filter1') != "<>" ? $kuesioner->semester . ' ' . $kuesioner->kegiatan : 'All';
        $filename = 'Kepuasan Mahasiswa Per Prodi ' . $tahun . '.xlsx';
        return Excel::download(new KepuasanMahasiswaExport($request->get('filter1')), $filename);
    }
}
