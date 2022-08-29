<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    public function index()
    {
        $semester = DB::table('kuesioner_akademik')->select(DB::raw("DISTINCT semester, kegiatan"))->get();
        return view('mahasiswa.akademik.index', compact('semester'));
    }

    public function show()
    {
        return view('mahasiswa.akademik.show');
    }
}
