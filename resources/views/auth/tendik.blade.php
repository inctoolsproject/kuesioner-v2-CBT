@extends('auth.layouts')

@section('content')
    <form method="post" action="{{ route('auth.tendik.login.submit') }}" class="sign-in-form">
        @csrf
        <h2 class="title">Login Tendik</h2>
        <h4 style="color: green;"> Silahkan Login menggunakan Username NIP (4 Angka) dan Password 'user'.
        </h4>
        <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control form-control-user" id="username" name="username"
                placeholder="Username (NIP)" value="">
        </div>
        <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" class="form-control form-control-user" id="password" name="password"
                placeholder="Password (Password di SIKAD)">
        </div>
        <button type="submit" class="btn btn-block login-btn mb-4">Login</button>
        <a href="{{ route('index') }}" class="btn btn-block login-btn mb-4"
            style="align-items: center;display: flex;justify-content: center;">Kembali</a>
    </form>
@endsection
