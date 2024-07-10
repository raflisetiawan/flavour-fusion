@extends('layouts.admin')

@section('title', 'Manage Menus')

@section('content')
    <div class="container">
        <h1 class="my-4">Manage Menus</h1>
        <a href="{{ route('admin.manage-menus.create') }}" class="btn btn-primary mb-4">Add New Menu</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kedai</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->kedai->name }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="100">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.manage-menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.manage-menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
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
@endsection
