@extends('layouts.auth')

@section('title', 'Daftar - Flavour Fusion')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h3 class="text-center font-weight-light my-4">Daftar</h3></div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control @error('name') is-invalid @enderror" id="inputName" type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required />
                        <label for="inputName" class="color-f">Nama Lengkap</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required />
                        <label for="inputEmail" class="color-f">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control @error('phone') is-invalid @enderror" id="inputPhone" type="tel" name="phone"  value="{{ old('phone') }}" required />
                        <label for="inputPhone" class="color-f">Phone</label>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Password" required />
                        <label for="inputPassword" class="color-f">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPasswordConfirmation" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required />
                        <label for="inputPasswordConfirmation" class="color-f">Konfirmasi Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="{{ route('login') }}" class="color-f">Sudah punya akun? Login!</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
