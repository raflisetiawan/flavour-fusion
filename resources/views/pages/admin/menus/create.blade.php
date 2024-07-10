@extends('layouts.admin')

@section('title', 'Add New Menu')

@section('content')
    <div class="container">
        <h1 class="my-4">Add New Menu</h1>
        <form action="{{ route('admin.manage-menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kedai_id">Kedai</label>
                <select class="form-control" id="kedai_id" name="kedai_id" required>
                    @foreach ($kedais as $kedai)
                        <option value="{{ $kedai->id }}">{{ $kedai->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Add Menu</button>
        </form>
    </div>
@endsection
