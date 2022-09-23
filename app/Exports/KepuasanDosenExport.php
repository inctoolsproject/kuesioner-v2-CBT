<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KepuasanDosenExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    private $tahun_akademik;
    public function __construct(string $tahun_akademik)
    {
        $this->tahun_akademik = $tahun_akademik;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(DB::table('responden_akademik')->select(DB::raw('responden_akademik.nama, responden_akademik.username, prodi.nama as prodi, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks'))->join('prodi', function ($join) {
            $join->on('prodi.kode', '=', 'responden_akademik.kode_prodi')->on('prodi.kode_fakultas', '=', 'responden_akademik.kode_fakultas');
        })->where('responden_akademik.tipe', 'dosen')->where('responden_akademik.kuesioner_akademik_id', $this->tahun_akademik, '', 'and')->groupBy('responden_akademik.nama', 'responden_akademik.username', 'prodi.nama', 'indeks')->get());
    }

    public function headings(): array
    {
        return [
            "Nama Dosen",
            "NIP",
            "Prodi",
            "Indeks"
        ];
    }
}
