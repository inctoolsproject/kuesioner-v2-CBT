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
                            <label class=" form-control-label" style="color:green; font-weight:bold">
                                Petunjuk Pengisian
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static" style="color:green">Kuesioner ini terdiri
                                dari 12 butir
                                pertanyaan dengan bentuk jawaban pilihan ganda yang terdiri dari 4
                                (empat) pilihan jawaban.
                                Anda dapat memilih satu pilihan sesuai pendapat pribadi.</p>
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label " style="color:green">
                                        <input type="radio" id="radio1" name="radios" value="option1"
                                            class="form-check-input" disabled="">Kurang
                                        (Tidak Puas)
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label " style="color:green">
                                        <input type="radio" id="radio2" name="radios" value="option2"
                                            class="form-check-input" disabled="">Cukup
                                        (Kurang Puas)
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio3" class="form-check-label " style="color:green">
                                        <input type="radio" id="radio3" name="radios" value="option3"
                                            class="form-check-input" checked="" disabled="">Baik (Puas)
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio3" class="form-check-label " style="color:green">
                                        <input type="radio" id="radio4" name="radios" value="option4"
                                            class="form-check-input" disabled="">Sangat
                                        Baik (Sangat Puas)
                                    </label>
                                </div>
                            </div>
                        </div>
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
                    <div class="app-card-body px-4">
                        <form class="settings-form">
                            <div class="row mt-3">
                                <div class="col col-md-3">
                                    <label class=" form-control-label" style="font-weight:bold">
                                        Petunjuk Pengisian
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static" style="">Kuesioner ini terdiri
                                        dari 12 butir
                                        pertanyaan dengan bentuk jawaban pilihan ganda yang terdiri dari 4
                                        (empat) pilihan jawaban.
                                        Anda dapat memilih satu pilihan sesuai pendapat pribadi.</p>
                                    <div class="form-check mb-3">
                                        <div class="radio">
                                            <label for="radio1" class="form-check-label " style="">
                                                <input type="radio" id="radio1" name="radios" value="option1"
                                                    class="form-check-input">Kurang (Tidak Puas)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="app-card-footer p-4 mt-auto">
                        <a class="btn app-btn-secondary" href="#">Create New</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
