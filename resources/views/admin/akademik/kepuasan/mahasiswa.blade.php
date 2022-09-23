@extends('layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Kepuasan Mahasiswa Per Prodi</h1>
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('error'))
            <div class="error-session" data-flashdata="{{ session('error') }}"></div>
        @endif
        <div class="app-card alert shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Kepuasan Mahasiswa Per Prodi</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12">
                            <div>
                                Kuesioner ini menanyakan pendapat anda mengenai Pembelajaran dan Suasana Akademik selama
                                semester ini. Pengumpulan data menggunakan kuesioner ini bertujuan mengukur keefektifan
                                kegiatan belajar daring yang telah dilakukan. Berikan tanggapan berdasarkan pendapat sendiri
                                dan bukan pandangan/pendapat orang lain. Kami mengucapkan banyak terima kasih atas
                                partisipasinya dalam pengisian kuesioner ini.

                            </div>
                            <div class="page-utilities mt-3">
                                <div class="row g-2 justify-content-start align-items-center">
                                    <div class="col-auto">
                                        <select class="form-select w-auto" name="filter1" id="filter1">
                                            @foreach ($semester as $key => $sem)
                                                <option value="{{ $sem->id }}"
                                                    @if ($key == 0) selected @endif>
                                                    {{ substr_replace($sem->semester, '/', 4, 0) . ' - ' . $sem->kegiatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button id="clear"
                                            class="btn app-btn-secondary text-danger border border-danger">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                            Hapus Filter
                                        </button>
                                        <button id="export"
                                            class="btn app-btn-secondary text-success border border-success">
                                            <i class="fa-solid fa-file-export text-success"></i>
                                            Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--//col-->
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="kuesioner-table"
                                    style="width: 100%; overflow-x:scroll">
                                    <thead class="align-items-center text-center">
                                        <tr>
                                            <th rowspan="2">Nama Prodi</th>
                                            <th colspan="4">Keandalan (%)</th>
                                            <th colspan="4">Kepastian (%)</th>
                                            <th colspan="4">Empati (%)</th>
                                            <th colspan="4">Daya Tanggap (%)</th>
                                            <th colspan="4">Tangible (%)</th>
                                        </tr>
                                        <tr>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
            let flashdatasukses = $('.success-session').data('flashdata');
            let flashdataerror = $('.error-session').data('flashdata');
            if (flashdatasukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashdatasukses,
                    type: 'success'
                })
            }
            if (flashdataerror) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: flashdataerror,
                    type: 'error'
                })
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let table = $('#kuesioner-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.akademik.kepuasan.mahasiswa.list') }}",
                    data: function(d) {
                        d.filter1 = $('#filter1').val() ? $('#filter1').val() : '<>';
                    }
                },
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'keandalan_4',
                        name: 'keandalan_4'
                    },
                    {
                        data: 'keandalan_3',
                        name: 'keandalan_3'
                    },
                    {
                        data: 'keandalan_2',
                        name: 'keandalan_2'
                    },
                    {
                        data: 'keandalan_1',
                        name: 'keandalan_1'
                    },
                    {
                        data: 'kepastian_4',
                        name: 'kepastian_4'
                    },
                    {
                        data: 'kepastian_3',
                        name: 'kepastian_3'
                    },
                    {
                        data: 'kepastian_2',
                        name: 'kepastian_2'
                    },
                    {
                        data: 'kepastian_1',
                        name: 'kepastian_1'
                    },
                    {
                        data: 'empati_4',
                        name: 'empati_4'
                    },
                    {
                        data: 'empati_3',
                        name: 'empati_3'
                    },
                    {
                        data: 'empati_2',
                        name: 'empati_2'
                    },
                    {
                        data: 'empati_1',
                        name: 'empati_1'
                    },
                    {
                        data: 'daya_tanggap_4',
                        name: 'daya_tanggap_4'
                    },
                    {
                        data: 'daya_tanggap_3',
                        name: 'daya_tanggap_3'
                    },
                    {
                        data: 'daya_tanggap_2',
                        name: 'daya_tanggap_2'
                    },
                    {
                        data: 'daya_tanggap_1',
                        name: 'daya_tanggap_1'
                    },
                    {
                        data: 'tangibel_4',
                        name: 'tangibel_4'
                    },
                    {
                        data: 'tangibel_3',
                        name: 'tangibel_3'
                    },
                    {
                        data: 'tangibel_2',
                        name: 'tangibel_2'
                    },
                    {
                        data: 'tangibel_1',
                        name: 'tangibel_1'
                    },
                ],
            });
            $("#clear").on('click', function(e) {
                e.preventDefault();
                // location.reload();
                $("#filter1").val('').trigger('change');
            });
            $("#filter1").on('change', function() {
                table.draw();
            });
            $("#export").on('click', function(e) {
                e.preventDefault();
                let filter1 = $('#filter1').val() ? $('#filter1').val() : '<>';
                window.open("{{ route('admin.akademik.kepuasan.mahasiswa.export') }}?filter1=" + filter1,
                    '_blank');
            })
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log(message);
            };
        });
    </script>
@endpush
