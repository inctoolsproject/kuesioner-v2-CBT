<?php

namespace App\Exports;

use App\Models\RespondenFakultas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KuesionerFakultasExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $tahun_akademik, $role;
    public function __construct(string $tahun_akademik, string $role)
    {
        $this->tahun_akademik = $tahun_akademik;
        $this->role = $role;
    }

    public function query()
    {
        return RespondenFakultas::query()->selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('kuesioner_fakultas_id', $this->tahun_akademik, '', 'and')->where('tipe', $this->role, '', 'and')->groupBy('username', 'nama', 'indeks');
    }

    public function headings(): array
    {
        return [
            ($this->role === "mahasiswa") ? "NRP" : ($this->role === "dosen" || $this->role === "tendik" ? "NIP" : "Username"),
            "Nama",
            "Rata-rata Indeks",
        ];
    }
}
