@extends('auth.layouts')

@section('content')
    <form method="post" action="" class="sign-in-form">
        <h1 class="title" style="color: green; font-size:medium">
            <h6 class="title" align="center" style="font-size: 30px;">Selamat Datang di<br>
                Sistem Kuesioner Umpan Balik terhadap Pelayanan Itenas
            </h6>
            <div class="card-body">
                <button type="button" class="btn btn-primary"><a href="{{ route('auth.dosen.login') }}"
                        style="text-decoration:none; color:white; font-size:large">Dosen</button>
                <button type="button" class="btn btn-primary"><a href="{{ route('auth.mahasiswa.login') }}"
                        style="text-decoration:none; color:white; font-size:large">Mahasiswa</button>
                <button type="button" class="btn btn-primary"><a href="{{ route('auth.tendik.login') }}"
                        style="text-decoration:none; color:white; font-size:large">Tendik</button>
            </div>
    </form>
@endsection
