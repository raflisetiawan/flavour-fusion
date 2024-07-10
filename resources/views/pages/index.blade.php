<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlavourFusion</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />

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
    <!-- Navbarku end -->

    <!-- Hero Section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Selamat Datang di FlavourFusion</h1>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt,
                aut.
            </p>
            <a href="#" class="cta">Beli Sekarang</a>
        </main>
    </section>
    <!-- Hero Section end -->

    <!-- About Section start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>

        <div class="row">
            <div class="about-img">
                <img src="img/tentang-kami.jpg" alt="Tentang Kami" />
            </div>
            <div class="content">
                <h3>Kenapa Harus di FlavourFusion?</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. In
                    doloribus esse iure necessitatibus, suscipit animi.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore
                    veniam asperiores consequuntur quis magnam voluptatibus provident ex
                    commodi quia aliquid.
                </p>
            </div>
        </div>
    </section>
    <!-- About Section ec:\Users\USER\Desktop\FFd -->

    <!-- Kedai Section start -->
    <section id="kedai" class="kedai">
        <h2><span>Daftar</span> Kedai</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus quas
            quod distinctio optio porro voluptates.
        </p>

        <div class="row">
            @foreach($kedais as $kedai)
            <div class="col-md-4">
                <div class="kedai-card">
                    <a href="{{ route('kedai.show', $kedai->id) }}"> <!-- Tautkan ke halaman detail -->
                        <img src="{{ asset('storage/' . $kedai->image) }}" alt="{{ $kedai->name }}" class="kedai-card-img" />
                        <h3 class="kedai-card-title">- {{ $kedai->name }} -</h3>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Menu Section start -->
    <section class="menu" id="menu" x-data="menu">
        <h2><span>Menu Dari</span> Berbagai Kedai</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, aut
            recusandae necessitatibus provident consectetur asperiores!
        </p>

        <div class="row">
            @foreach($kedais as $kedai)
            @foreach($kedai->menus as $menu)
            <div class="menu-card">
                <div class="menu-icons">
                    <a href="#" @click.prevent="$store.cart.add(item)">
                        <svg width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <use href="img/feather-sprite.svg#shopping-cart" />
                        </svg>
                    </a>
                    <a href="#" class="item-detail-button"><svg width="24" height="24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <use href="img/feather-sprite.svg#eye" />
                        </svg></a>
                </div>
                <div class="menu-image">
                    <img width="200" src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" />
                </div>
                <div class="menu-content">
                    <h3>{{ $menu->name }}</h3>
                </div>
                <div class="menu-kedai">
                    <h3>- by {{ $kedai->name }} -</h3>
                </div>
                <div class="menu-price">
                    <span>{{ $menu->price }}</span>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </section>

    <!-- Menu Section end -->

    <!-- Modal Box Item Detal start   -->
    <div class="modal" id="item-detail-modal">
        <div class="modal-container">
            <a href="#" class="close-icon"><i data-feather="x"></i></a>
            <div class="modal-content">
                <img src="img/menu/1.jpg" alt="Menu 1" />
                <div class="product-content">
                    <h3>Menu 1</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id
                        eveniet sunt corrupti, consequatur error quos commodi numquam
                        nulla perspiciatis aliquid eaque quasi qui dolorem quas, dolore
                        molestias omnis dicta eius nihil, laboriosam blanditiis sapiente.
                        Magnam.
                    </p>
                    <div class="menu-price">IDR 55K <span>IDR 70K</span></div>
                    <a href="#"><i data-feather="shopping-cart"></i> <span>add to cart</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Box Item Detal end   -->

    <!-- Feather Icon -->
    <script>
        feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/sbadmin.js') }}"></script>
</body>

</html>
