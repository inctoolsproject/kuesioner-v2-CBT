@extends('layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Kuesioner Akademik</h1>

        <div class="app-card alert shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Instrumen Penilaian Efektivitas Proses Pembelajaran Online</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12">
                            <div>Kuesioner ini menanyakan pendapat anda mengenai Pembelajaran dan Suasana Akademik selama
                                semester ini. Pengumpulan data menggunakan kuesioner ini bertujuan mengukur keefektifan
                                kegiatan belajar daring yang telah dilakukan. Berikan tanggapan berdasarkan pendapat sendiri
                                dan bukan pandangan/pendapat orang lain. Kami mengucapkan banyak terima kasih atas
                                partisipasinya dalam pengisian kuesioner ini.
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <div class="row mt-3">
                        <div class="col col-md-3">
                            <label class="fs-4 fw-bold form-control-label">
                                Pilih Semester
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                @foreach ($semester as $sem)
                                    <option value="{{ $sem->semester . ';' . $sem->kegiatan }}">
                                        {{ substr_replace($sem->semester, '/', 4, 0) . ' - ' . $sem->kegiatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
