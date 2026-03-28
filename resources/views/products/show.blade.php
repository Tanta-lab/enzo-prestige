@extends('layouts.app')

@section('content')
    <div class="container page-section">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="detail-layout">
            <div class="card">
                @if($product->images->count())
                    <img
                        id="main-product-image"
                        src="{{ asset('storage/' . $product->images->first()->path) }}"
                        alt="{{ $product->name }}"
                        class="detail-main-image"
                    >

                    <div class="thumb-row">
                        @foreach($product->images as $image)
                            <img
                                src="{{ asset('storage/' . $image->path) }}"
                                alt="{{ $product->name }}"
                                onclick="document.getElementById('main-product-image').src='{{ asset('storage/' . $image->path) }}'"
                            >
                        @endforeach
                    </div>
                @elseif($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="detail-main-image">
                @else
                    <div class="detail-main-image" style="display:flex; align-items:center; justify-content:center;">
                        <span class="muted">Pas d’image</span>
                    </div>
                @endif
            </div>

            <div class="card">
                <p class="badge" style="margin-bottom: 12px;">EnzoPrestige</p>
                <h1>{{ $product->name }}</h1>

                <p class="muted" style="margin-bottom: 20px;">
                    @if($product->categories->count())
                        {{ $product->categories->pluck('name')->join(', ') }}
                    @else
                        Aucune catégorie
                    @endif
                </p>

                <p style="font-size: 1.2rem; margin-bottom: 10px;">
                    <strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong>
                </p>

                <p class="muted" style="margin-bottom: 22px;">Stock disponible : {{ $product->stock }}</p>

                <p style="margin-bottom: 28px;">{{ $product->description }}</p>

                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="form-inline">
                            @csrf
                            <div style="width: 90px;">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                            </div>
                            <button type="submit">Ajouter au panier</button>
                        </form>
                    @else
                        <p style="color:#8a1f1f;"><strong>Rupture de stock</strong></p>
                    @endif
                @else
                    <p class="muted">
                        <a href="{{ route('login') }}">Connectez-vous</a> pour commander ce produit.
                    </p>
                @endauth
            </div>
        </div>
    </div>
@endsection
