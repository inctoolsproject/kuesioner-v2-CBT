<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KuesionerFakultasExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\TemplatePertanyaanTrait;
use App\Models\KuesionerFakultas;
use App\Models\RespondenFakultas;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FakultasController extends Controller
{
	use TemplatePertanyaanTrait;
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
        $kuesioner = KuesionerFakultas::with(['pertanyaan' => function ($query) {
            return $query->orderBy('nomor', 'asc');
        }, 'pertanyaan.jawaban'])->find($id);
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

            $this->createPertanyaanFakultas($kuesioner);
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

    public function export(Request $request)
    {
        if ($request->get('filter1') != "<>") {
            $kuesioner = KuesionerFakultas::find($request->get('filter1'));
            $role = $kuesioner->tipe != null ? Str::ucfirst($kuesioner->tipe) : "All";
            $tahun = $kuesioner->semester . ' ' . $kuesioner->kegiatan;
            $filename = 'Data Kuesioner Fakultas ' . $role . ' ' . $tahun . '.xlsx';
        } else {
            $filename = 'Data Kuesioner Fakultas ' . Str::ucfirst($request->get('filter2')) . ' All.xlsx';
        }
        return Excel::download(new KuesionerFakultasExport($request->get('filter1'), $request->get('filter2')), $filename);
    }

    public function dosen()
    {
        $semester = KuesionerFakultas::select(DB::raw("DISTINCT semester, kegiatan, id"))->forDosen()->get();
        return view('admin.fakultas.dosen', compact('semester'));
    }

    public function dosen_list(Request $request)
    {
        $data = RespondenFakultas::selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'dosen')->where('kuesioner_fakultas_id', $request->get('filter1'), '', 'and')->groupBy('username', 'nama', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
