@extends('layouts.customer')

@section('title', $kedai->name)

@section('content')
    <section id="menu" class="contentku menu">
        <div class="container">
            <h2 class="color-f"><span>Menu</span> Kedai {{ $kedai->name }}</h2>
            <p class="color-f">
               {{ $kedai->description }}
            </p>

            <div class="row">
                @foreach ($kedai->menus as $menu)
                    <div class="col-md-4">
                        <div class="menu-card">
                            <div class="menu-icons">
                                <a href="{{ route('order.create', $menu->id) }}" class="order-menu-link">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <use href="{{asset('img/feather-sprite.svg#shopping-cart')}}"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="menu-image">
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" />
                            </div>
                            <div class="menu-content">
                                <h3 class="color-f">{{ $menu->name }}</h3>
                            </div>
                            <div class="menu-kedai">
                                <h3 class="color-f">- by Kedai {{ $kedai->name }} -</h3>
                            </div>
                            <div class="menu-price">
                                <span class="color-f">{{ $menu->price }}</span> <!-- Sesuaikan dengan format harga yang diinginkan -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
