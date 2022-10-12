<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KuesionerLP2MExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\TemplatePertanyaanTrait;
use App\Models\KuesionerLP2M;
use App\Models\RespondenLP2M;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LP2MController extends Controller
{
	use TemplatePertanyaanTrait;
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

            $this->createPertanyaanLP2M($kuesioner);
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

    public function export(Request $request)
    {
        if ($request->get('filter1') != "<>") {
            $kuesioner = KuesionerLP2M::find($request->get('filter1'));
            $role = $kuesioner->tipe != null ? Str::ucfirst($kuesioner->tipe) : "All";
            $tahun = $kuesioner->semester . ' ' . $kuesioner->kegiatan;
            $filename = 'Data Kuesioner LP2M ' . $role . ' ' . $tahun . '.xlsx';
        } else {
            $filename = 'Data Kuesioner LP2M ' . Str::ucfirst($request->get('filter2')) . ' All.xlsx';
        }
        return Excel::download(new KuesionerLP2MExport($request->get('filter1'), $request->get('filter2')), $filename);
    }

    public function dosen()
    {
        $semester = KuesionerLP2M::select(DB::raw("DISTINCT semester, kegiatan, id"))->forDosen()->get();
        return view('admin.lp2m.dosen', compact('semester'));
    }

    public function dosen_list(Request $request)
    {
        $data = RespondenLP2M::selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'dosen')->where('kuesioner_lp2m_id', $request->get('filter1'), '', 'and')->groupBy('username', 'nama', 'indeks')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
