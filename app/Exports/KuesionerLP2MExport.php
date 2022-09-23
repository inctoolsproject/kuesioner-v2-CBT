<?php

namespace App\Exports;

use App\Models\RespondenLP2M;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KuesionerLP2MExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $tahun_akademik, $role;
    public function __construct(string $tahun_akademik, string $role)
    {
        $this->tahun_akademik = $tahun_akademik;
        $this->role = $role;
    }

    public function query()
    {
        return RespondenLP2M::query()->selectRaw('username, nama, CAST(ROUND(AVG(indeks), 2) AS DEC(10, 2)) indeks')->where('kuesioner_lp2m_id', $this->tahun_akademik, '', 'and')->where('tipe', $this->role, '', 'and')->groupBy('username', 'nama', 'indeks');
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
