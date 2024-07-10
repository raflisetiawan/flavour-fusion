<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- App -->
    <script src="{{asset('src/app.js')}}"></script>
</head>

<body>
    <!-- Navbarku start -->
    <nav class="navbarku" x-data>
        <a href="{{route('home')}}" class="navbarku-logo">Flavour<span>Fusion</span>.</a>

        <div class="navbarku-nav">
            <a href="{{route('home')}}">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#kedai">Kedai</a>
            <a href="#menu">Menu</a>
            @if (Auth::check())
                <form action="{{ route('logout') }}" method="post" class="inline-form">
                    @csrf
                    <button class="logout-button" type="submit">Logout</button>
                    @if (Auth::user()->hasRole('pemilik_kedai'))
                    <a href="{{ route('pemilikKedaiIndex') }}">My Kedai</a>
                        @else
                        <a href="{{ route('halamanDaftarSebagaiPemilikKedai') }}">Mendaftar sebagai Pemilik Kedai</a>
                    @endif
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endif
        </div>

        <div class="navbarku-extra">
            <a href="#" id="search-button"><i data-feather="search"></i></a>
            <a href="#" id="shopping-cart-button">
                <i data-feather="shopping-cart"></i>
                <span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
            </a>
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>

        <!-- Search Form start -->
        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here..." />
            <label for="search-box"><i data-feather="search"></i></label>
        </div>
        <!-- Search Form end -->

        <!-- Shopping Cart start -->
        <div class="shopping-cart">
            <template x-for="(item, index) in $store.cart.items" x-keys="index">
                <div class="cart-item">
                    <img :src="'img/menu/${item.img}'" :alt="item.name" />
                    <div class="item-detail">
                        <h3 x-text="item.name"></h3>
                        <div class="item-price">
                            <span x-text="rupiah(item.price)"></span> &times;
                            <button id="remove" @click="$store.cart.remove(item.id)">
                                &minus;
                            </button>
                            <span x-text="item.quantity"></span>
                            <button id="add" @click="$store.cart.add(item)">&plus;</button>
                            &equals;
                            <span x-text="rupiah(item.total)"></span>
                        </div>
                    </div>
                </div>
            </template>
            <h4 x-show="!$store.cart.items.length" style="margin-top: 1rem">
                Cart is Empty
            </h4>
            <h4 x-show="$store.cart.items.length">
                Total : <span x-text="rupiah($store.cart.total)"></span>
            </h4>
        </div>
        <!-- Shopping Cart end -->
    </nav>
    <div>
        @yield('content')
    </div>

    <!-- Feather Icon -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/sbadmin.js')}}"></script>
  </body>
</html>
