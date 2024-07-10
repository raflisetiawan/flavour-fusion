@extends('layouts.kedai')

@section('content')
<div class="container">
    <h1 class="mt-4">Manage Menu</h1>
    <a href="{{ route('pemilikKedai.menu.create') }}" class="btn btn-primary mb-3">Create New Menu</a>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Menu List
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>
                            @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pemilikKedai.menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemilikKedai.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('pemilikKedai.menu.showOrderDetails', $menu->id) }}" class="btn btn-info btn-sm">View Orders</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
