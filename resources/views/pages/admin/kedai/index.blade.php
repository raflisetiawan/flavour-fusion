@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manage Kedai</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kedai</li>
        </ol>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-store me-1"></i>
                Kedai List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kedai as $k)
                            <tr>
                                <td>{{ $k->name }}</td>
                                <td>{{ $k->description }}</td>
                                <td><img src="{{ asset('storage/' . $k->image) }}" alt="{{ $k->name }}" width="100"></td>
                                <td>
                                    <a href="{{ route('admin.kedai.edit', $k->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('admin.kedai.destroy', $k->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
