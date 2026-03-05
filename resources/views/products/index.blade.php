@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Catalogue</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if($products->count() === 0)
            <p>Aucun produit disponible.</p>
        @else
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px;">
                @foreach($products as $product)
                    <div style="border:1px solid #ddd; padding: 12px; border-radius: 8px;">
                        <h3 style="margin:0 0 8px 0;">{{ $product->name }}</h3>

                        <p style="margin:0 0 8px 0;">
                            <strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong>
                            <span style="color:#666;">— Stock: {{ $product->stock }}</span>
                        </p>

                        <p style="margin:0 0 12px 0; color:#444;">
                            {{ \Illuminate\Support\Str::limit($product->description, 120) }}
                        </p>

                        <form action="{{ route('cart.add', $product) }}" method="POST" style="display:flex; gap:8px; align-items:center;">
                            @csrf

                            <label for="qty-{{ $product->id }}">Qté</label>
                            <input
                                id="qty-{{ $product->id }}"
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $product->stock }}"
                                style="width:80px;"
                            >

                            <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                Ajouter au panier
                            </button>
                        </form>

                        @if($product->stock <= 0)
                            <p style="color:#b00; margin-top:8px;">Rupture de stock</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
