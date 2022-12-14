@extends('layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Kuesioner Akademik Dosen</h1>
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('error'))
            <div class="error-session" data-flashdata="{{ session('error') }}"></div>
        @endif
        <div class="app-card alert shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Instrumen Penilaian Efektivitas Proses Pembelajaran Online Oleh Dosen</h3>
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
                                            <option value="" selected>Pilih Semester</option>
                                            @foreach ($semester as $sem)
                                                <option value="{{ $sem->id }}">
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
                                <table class="table app-table-hover mb-0 text-left" id="kuesioner-table">
                                    <thead>
                                        <tr>
                                            <th class="cell">Nomor</th>
                                            <th class="cell">Nama Matkul</th>
                                            <th class="cell">Kode Matkul</th>
                                            <th class="cell">Kelas</th>
                                            <th class="cell">Nama Dosen</th>
                                            <th class="cell">Indeks</th>
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
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.akademik.dosen.list') }}",
                    data: function(d) {
                        d.filter1 = $('#filter1').val() ? $('#filter1').val() : '<>';
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_matkul',
                        name: 'nama_matkul',
                        className: 'text-center'
                    },
                    {
                        data: 'kode_matkul',
                        name: 'kode_matkul',
                        className: 'text-center'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                        className: 'text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'text-center'
                    },
                    {
                        data: 'indeks',
                        name: 'indeks',
                        className: 'text-center'
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
                window.open("{{ route('admin.akademik.dosen.export') }}?filter1=" + filter1, '_blank');
            });
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log(message);
            };
        });
    </script>
@endpush
