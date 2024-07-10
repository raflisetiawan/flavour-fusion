@extends('layouts.kedai')

@section('content')
<div class="container">
    <h1>{{$kedai->name}}</h1>
    {{-- <a href="{{ route('kedai.create') }}" class="btn btn-primary">Create Kedai</a> --}}

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

</div>
@endsection
