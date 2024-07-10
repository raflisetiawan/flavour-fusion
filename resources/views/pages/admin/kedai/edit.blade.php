@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Kedai</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Kedai</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-store me-1"></i>
                Edit Kedai
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kedai.update', $kedai->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $kedai->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $kedai->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($kedai->image)
                            <img src="{{ asset('storage/' . $kedai->image) }}" alt="{{ $kedai->name }}" width="100" class="mt-2">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
