@extends('layouts.customer')

@section('title', 'Order Menu')

@section('content')
    <section class="contentku order-menu">
        <div class="container">
            <h2 class="color-f">Order Menu</h2>
            <div class="menu-details">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                <h3 class="color-f">{{ $menu->name }}</h3>
                <p class="color-f">{{ $menu->description }}</p>
                <p class="color-f">Price: {{ $menu->price }}</p>
            </div>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <label class="color-f" for="quantity">Quantity:</label>
                <input type="number" class="form-control mb-3" id="quantity" name="quantity" value="1" min="1">
                <button class="btn bg-color text-white" type="submit">Order Now</button>
            </form>
        </div>
    </section>
@endsection
