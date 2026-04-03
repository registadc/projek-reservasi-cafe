@extends('user.layouts.app')

@section('title', 'Menu')

@section('content')

<!-- HERO -->
<section class="hero">
    <h1>OUR MENU</h1>
</section>

<!-- Drink -->
<section class="menu-section">
    <h2>Drink Menu</h2>
    <p>Berbagai pilihan minuman berkualitas dengan cita rasa khas yang nikmat.</p>

    <div class="menu-grid">
        @foreach($drinkMenus as $menu)
        <div class="menu-item">
            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="">
            <div class="menu-info">
                <div class="menu-title">
                    <span class="menu-name">{{($menu->nama_menu) }} ------------ </span>
                    <span class="menu-price"> Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                </div>
                <div class="menu-desc">{{ $menu->deskripsi }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- BREAD -->
<section class="menu-section bread">
    <h2>Bread Menu</h2>
    <p>Aneka roti lembut dengan rasa lezat, cocok sebagai teman ngopi.</p>

    <div class="menu-grid">
        @foreach($breadMenus as $menu)
        <div class="menu-item">
            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="">
            <div class="menu-info">
                <div class="menu-title">
                    <span class="menu-name">{{($menu->nama_menu) }} ------------ </span>
                    <span class="menu-price"> Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                </div>
                <div class="menu-desc">{{ $menu->deskripsi }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>


@endsection