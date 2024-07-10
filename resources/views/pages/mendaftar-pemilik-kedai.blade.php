@extends('layouts.customer')
@section('title', 'Daftar sebagai pemilik kedai ')
@section('content')
    <section class="contentku">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Pengajuan Sebagai Pemilik Kedai</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('daftarSebagaiPemilikKedai') }}"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputName"
                                        type="text" name="name" placeholder="Nama Kedai" value="{{ old('name') }}"
                                        required />
                                    <label for="inputName" class="color-f">Nama Kedai</label>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description"
                                        placeholder="Deskripsi Kedai" rows="3" required>{{ old('description') }}</textarea>
                                    <label for="inputDescription" class="color-f">Deskripsi Kedai</label>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('image') is-invalid @enderror" id="inputImage"
                                        type="file" name="image" accept="image/*" />
                                    <label for="inputImage" class="color-f">Gambar Kedai</label>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <button class="btn btn-primary" type="submit">Kirim Pengajuan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
