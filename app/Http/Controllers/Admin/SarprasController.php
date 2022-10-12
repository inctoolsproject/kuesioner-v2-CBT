<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KuesionerSarprasExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\TemplatePertanyaanTrait;
use App\Models\KuesionerSarpras;
use App\Models\RespondenSarpras;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SarprasController extends Controller
{
	use TemplatePertanyaanTrait;
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
        $kuesioner = KuesionerSarpras::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
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

            $this->createPertanyaanSarpras($kuesioner);
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

    public function export(Request $request)
    {
        if ($request->get('filter1') != "<>") {
            $kuesioner = KuesionerSarpras::find($request->get('filter1'));
            $role = $kuesioner->tipe != null ? Str::ucfirst($kuesioner->tipe) : "All";
            $tahun = $kuesioner->semester . ' ' . $kuesioner->kegiatan;
            $filename = 'Data Kuesioner Sarpras ' . $role . ' ' . $tahun . '.xlsx';
        } else {
            $filename = 'Data Kuesioner Sarpras ' . Str::ucfirst($request->get('filter2')) . ' All.xlsx';
        }
        return Excel::download(new KuesionerSarprasExport($request->get('filter1'), $request->get('filter2')), $filename);
    }

    public function mahasiswa()
    {
        $semester = KuesionerSarpras::select(DB::raw("DISTINCT semester, kegiatan, id"))->forMahasiswa()->get();
        return view('admin.sarpras.mahasiswa', compact('semester'));
    }

    public function mahasiswa_list(Request $request)
    {
        $data = RespondenSarpras::selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'mahasiswa')->where('kuesioner_sarpras_id', $request->get('filter1'), '', 'and')->groupBy('username', 'nama', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function dosen()
    {
        $semester = KuesionerSarpras::select(DB::raw("DISTINCT semester, kegiatan, id"))->forDosen()->get();
        return view('admin.sarpras.dosen', compact('semester'));
    }

    public function dosen_list(Request $request)
    {
        $data = RespondenSarpras::selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'dosen')->where('kuesioner_sarpras_id', $request->get('filter1'), '', 'and')->groupBy('username', 'nama', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
