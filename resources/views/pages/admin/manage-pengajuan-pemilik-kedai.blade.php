@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Pengajuan Pemilik Kedai</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Manage Pengajuan Pemilik Kedai</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Pengajuan Kedai
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nama Kedai</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Pengaju</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuanKedai as $kedai)
                        <tr>
                            <td>{{ $kedai->name }}</td>
                            <td>{{ $kedai->description }}</td>
                            <td>
                                @if($kedai->image)
                                    <img src="{{ asset('storage/'.$kedai->image) }}" alt="{{ $kedai->name }}" width="100">
                                @endif
                            </td>
                            <td>{{ $kedai->user->name }}</td>
                            <td>
                                <form action="{{ route('admin.manage-pengajuan-pemilik-kedai.approve', $kedai->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.manage-pengajuan-pemilik-kedai.reject', $kedai->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
