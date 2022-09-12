@extends('layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Kuesioner Visi Misi</h1>
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('error'))
            <div class="error-session" data-flashdata="{{ session('error') }}"></div>
        @endif
        <div class="app-card alert shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Kuesioner Pemahaman Visi, Misi, dan Tujuan Itenas
                    </h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12">
                            <div>
                                Kuesioner ini menanyakan pendapat Anda mengenai visi dan misi yang ada di Itenas.
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
                                        {{ substr_replace($kue->semester, '/', 4, 0) . ' - ' . $kue->kegiatan . (!$kue->responden->isEmpty() ? ' (Sudah Diisi)' : '') }}
                                    </option>
                                @endforeach
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

            // Start Kuesioner
            $('#btn-start').click(function() {
                let kuesioner = $('#select-kuesioner').val();
                window.open(`${window.baseUrl}/tendik/visi-misi/${kuesioner}`, '_blank');
            });
        });
    </script>
@endpush
