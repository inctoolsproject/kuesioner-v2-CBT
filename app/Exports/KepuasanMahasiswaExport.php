<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KepuasanMahasiswaExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithMapping
{
    use RegistersEventListeners;
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
        return new Collection(DB::select("call kepuasan_mahasiswa_per_prodi({$this->tahun_akademik})"));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:A2');
                $event->sheet->getDelegate()->mergeCells('B1:E1');
                $event->sheet->getDelegate()->mergeCells('F1:I1');
                $event->sheet->getDelegate()->mergeCells('J1:M1');
                $event->sheet->getDelegate()->mergeCells('N1:Q1');
                $event->sheet->getDelegate()->mergeCells('R1:U1');

                $event->sheet->getStyle('A1:U1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ]);
                $event->sheet->getStyle('B2:U2')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ]);
            },
        ];
    }

    public function headings(): array
    {
        return [
            ['Nama Prodi', 'Keandalan (%)', '', '', '', 'Kepastian (%)', '', '', '', 'Empati (%)', '', '', '', 'Daya Tanggap (%)', '', '', '', 'Tangible (%)', '', '', ''],
            ['', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang']
        ];
    }

    public function map($kuesioner): array
    {
        return [
            $kuesioner->nama,
            $kuesioner->keandalan_4, $kuesioner->keandalan_3, $kuesioner->keandalan_2, $kuesioner->keandalan_1, $kuesioner->kepastian_4, $kuesioner->kepastian_3, $kuesioner->kepastian_2, $kuesioner->kepastian_1, $kuesioner->empati_4, $kuesioner->empati_3, $kuesioner->empati_2, $kuesioner->empati_1, $kuesioner->daya_tanggap_4, $kuesioner->daya_tanggap_3, $kuesioner->daya_tanggap_2, $kuesioner->daya_tanggap_1, $kuesioner->tangibel_4, $kuesioner->tangibel_3, $kuesioner->tangibel_2, $kuesioner->tangibel_1
        ];
    }
}
