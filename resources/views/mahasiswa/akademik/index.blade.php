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
                            <div>
                                Kuesioner ini menanyakan pendapat anda mengenai Pembelajaran dan Suasana Akademik selama
                                semester ini. Pengumpulan data menggunakan kuesioner ini bertujuan mengukur keefektifan
                                kegiatan belajar daring yang telah dilakukan. Berikan tanggapan berdasarkan pendapat sendiri
                                dan bukan pandangan/pendapat orang lain. Kami mengucapkan banyak terima kasih atas
                                partisipasinya dalam pengisian kuesioner ini.
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <div class="row mt-1">
                        <div class="col col-md-3">
                            <label class="mt-1 fs-4 fw-bold form-control-label">
                                Pilih Semester
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-select my-2" id="select-kuesioner">
                                @foreach ($kuesioner as $kue)
                                    <option value="{{ $kue->id }}">
                                        {{ substr_replace($kue->semester, '/', 4, 0) . ' - ' . $kue->kegiatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col col-md-3">
                            <label class="mt-1 fs-4 fw-bold form-control-label">
                                Mata Kuliah
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-select my-2" id="select-matkul">
                                <option value="">Pilih Mata Kuliah</option>
                            </select>
                            <button class="mt-3 btn btn-lg app-btn-primary" id="btn-start">Mulai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Start Kuesioner
            $('#btn-start').click(function() {
                let kuesioner = $('#select-kuesioner').val();
                window.open(`${window.baseUrl}/mahasiswa/akademik/${kuesioner}`, '_blank');
            });

            $("#select-matkul").select2({
                placeholder: "- Pilih Salah Satu -",
                allowClear: true,
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ route('api.mahasiswa.jadwal') }}`,
                    dataType: "json",
                    type: "POST",
                    data: function(params) {
                        return {
                            csrfToken: $('meta[name="csrf-token"]').attr('content'),
                            nrp: "152018016",
                            semester: "20211"
                        };
                    },
                    processResults: function(response) {
                        let results = [];
                        response.forEach(data => {
                            results.push({
                                "id": data.kdkmkMSJAW,
                                "text": `${data.nakmktbkmk}`
                            })
                        })
                        return {
                            results
                        };
                    },
                    cache: true,
                },
            });
        });
    </script>
@endpush
