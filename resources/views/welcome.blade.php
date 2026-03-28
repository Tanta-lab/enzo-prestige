@extends('layouts.app')

@section('content')
    <div class="container page-section">
        <div class="hero-box">
            <p class="badge" style="margin-bottom: 16px;">Maison • Galerie • Commande</p>
            <h1>Une expérience sobre, élégante, tournée vers l’essentiel.</h1>
            <p class="muted" style="max-width: 720px; margin: 0 auto 28px auto;">
                Découvrez une sélection de produits dans une interface minimaliste, avec panier, commandes
                et espace d’administration.
            </p>

            <div class="form-inline" style="justify-content:center;">
                <a href="{{ route('products.index') }}" class="button-link">Découvrir la galerie</a>

                @guest
                    <a href="{{ route('login') }}" class="nav-link nav-pill">Se connecter</a>
                @endguest
            </div>
        </div>
    </div>
@endsection
