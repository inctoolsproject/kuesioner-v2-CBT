@extends('layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Kuesioner LP2M</h1>
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('error'))
            <div class="error-session" data-flashdata="{{ session('error') }}"></div>
        @endif
        <div class="app-card alert shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Edit Kuesioner LP2M
                    </h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12">
                            <div>Kuesioner ini dapat diubah hanya untuk keterangan seperti judul, semester, dan kegiatan
                                kuesioner. Jika ingin mengubah pertanyaan, silahkan hapus kuesioner dan buat kuesioner baru.
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="app-card d-flex flex-column shadow-sm">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h4 class="app-card-title">Pertanyaan</h4>
                            </div>
                        </div>
                    </div>

                    <form class="settings-form" action="{{ route('admin.lp2m.update', $kuesioner->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="app-card-body py-2 px-4">
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label for="dosen" class="form-control-label" style="font-weight:bold">
                                        Judul
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        name="judul" id="judul" value="{{ $kuesioner->judul }}">
                                    @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label for="dosen" class="form-control-label" style="font-weight:bold">
                                        Keterangan
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        name="keterangan" id="keterangan" value="{{ $kuesioner->keterangan }}">
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label class=" form-control-label" style="font-weight:bold">
                                        Tipe
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-select my-2 @error('tipe') is-invalid @enderror" id="tipe"
                                        name="tipe">
                                        <option>Pilih Tipe</option>
                                        <option value="mahasiswa" @if ($kuesioner->tipe == 'mahasiswa') selected @endif>
                                            Mahasiswa</option>
                                        <option value="dosen" @if ($kuesioner->tipe == 'dosen') selected @endif>Dosen
                                        </option>
                                        <option value="tendik" @if ($kuesioner->tipe == 'tendik') selected @endif>Tendik
                                        </option>
                                    </select>
                                    @error('tipe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label class=" form-control-label" style="font-weight:bold">
                                        Semester
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-select my-2 @error('semester') is-invalid @enderror" id="semester"
                                        name="semester">
                                        <option>Pilih Semester</option>
                                        <option value="20211" @if ($kuesioner->semester == '20211') selected @endif>2021/1
                                        </option>
                                        <option value="20212" @if ($kuesioner->semester == '20212') selected @endif>2021/2
                                        </option>
                                        <option value="20221" @if ($kuesioner->semester == '20221') selected @endif>2022/1
                                        </option>
                                    </select>
                                    @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label for="kegiatan" class="form-control-label" style="font-weight:bold">
                                        Kegiatan
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-select my-2 @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                        name="kegiatan">
                                        <option>Pilih Kegiatan</option>
                                        <option value="UTS" @if ($kuesioner->kegiatan == 'UTS') selected @endif>UTS
                                        </option>
                                        <option value="UAS" @if ($kuesioner->kegiatan == 'UAS') selected @endif>UAS
                                        </option>
                                        <option value="Semester" @if ($kuesioner->kegiatan == 'Semester') selected @endif>
                                            Semester</option>
                                    </select>
                                    @error('kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="app-card-footer p-4 mt-auto">
                            <button type="submit" class="btn app-btn-primary">Submit Kuesioner</button>
                        </div>
                    </form>
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

        });
    </script>
@endpush
