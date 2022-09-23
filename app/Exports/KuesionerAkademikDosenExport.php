<?php

namespace App\Exports;

use App\Models\RespondenAkademik;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KuesionerAkademikDosenExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $tahun_akademik;
    public function __construct(string $tahun_akademik)
    {
        $this->tahun_akademik = $tahun_akademik;
    }

    public function query()
    {
        return RespondenAkademik::query()->selectRaw('nama_matkul, kode_matkul, kelas, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('tipe', 'dosen')->where('kuesioner_akademik_id', $this->tahun_akademik, '', 'and')->groupBy('kode_matkul', 'nama_matkul', 'kelas', 'nama', 'indeks');
    }

    public function headings(): array
    {
        return [
            "Nama Matkul",
            "Kode Matkul",
            "Kelas",
            "Dosen",
            "Rata-rata Indeks Dosen",
        ];
    }
}
