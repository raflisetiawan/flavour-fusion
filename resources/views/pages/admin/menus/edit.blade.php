@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Menu</h1>
        <form action="{{ route('admin.manage-menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kedai_id">Kedai</label>
                <select class="form-control" id="kedai_id" name="kedai_id" required>
                    @foreach ($kedais as $kedai)
                        <option value="{{ $kedai->id }}" {{ $kedai->id == $menu->kedai_id ? 'selected' : '' }}>{{ $kedai->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $menu->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Menu</button>
        </form>
    </div>
@endsection
