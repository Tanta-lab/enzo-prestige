@extends('layouts.app')

@section('content')
    <div class="container page-section">
        <h1 style="margin-bottom: 20px;">Galerie</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('products.index') }}" class="form-inline" style="margin-bottom: 28px;">
            <div style="flex:1; min-width: 240px;">
                <input
                    type="text"
                    name="search"
                    placeholder="Rechercher un produit..."
                    value="{{ $search }}"
                >
            </div>

            <div style="min-width: 220px;">
                <select name="category">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string)$categoryId === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Filtrer</button>
            <a href="{{ route('products.index') }}" class="nav-link">Réinitialiser</a>
        </form>

        @if($products->isEmpty())
            <p class="muted">Aucun produit trouvé.</p>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->images->count())
                            <a href="{{ route('products.show', $product) }}">
                                <img
                                    src="{{ asset('storage/' . $product->images->first()->path) }}"
                                    alt="{{ $product->name }}"
                                    class="product-card__image"
                                >
                            </a>
                        @elseif($product->image)
                            <a href="{{ route('products.show', $product) }}">
                                <img
                                    src="{{ $product->image }}"
                                    alt="{{ $product->name }}"
                                    class="product-card__image"
                                >
                            </a>
                        @else
                            <a href="{{ route('products.show', $product) }}">
                                <div class="product-card__image" style="display:flex; align-items:center; justify-content:center;">
                                    <span class="muted">Pas d’image</span>
                                </div>
                            </a>
                        @endif

                        <div class="product-card__body">
                            <a href="{{ route('products.show', $product) }}">
                                <h3 class="product-card__title">{{ $product->name }}</h3>
                            </a>

                            <p class="product-card__meta">
                                {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                            </p>

                            <p class="product-card__price">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </p>

                            <p class="product-card__meta">Stock : {{ $product->stock }}</p>

                            <p class="product-card__meta">
                                @if($product->categories->count())
                                    {{ $product->categories->pluck('name')->join(', ') }}
                                @else
                                    Aucune catégorie
                                @endif
                            </p>

                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="form-inline" style="margin-top: 14px;">
                                        @csrf
                                        <div style="width: 90px;">
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                                        </div>
                                        <button type="submit">Ajouter</button>
                                    </form>
                                @else
                                    <p style="color:#8a1f1f;"><strong>Rupture de stock</strong></p>
                                @endif
                            @else
                                <p class="muted">
                                    <a href="{{ route('login') }}">Connectez-vous</a> pour ajouter au panier
                                </p>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
