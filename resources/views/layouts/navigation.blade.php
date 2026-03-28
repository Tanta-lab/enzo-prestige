<nav class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__left">
            <a href="{{ url('/') }}" class="brand">EnzoPrestige</a>

            <a href="{{ route('products.index') }}" class="nav-link">Galerie</a>
            <a href="{{ route('cart.index') }}" class="nav-link">Panier</a>

            @auth
                <a href="{{ route('orders.index') }}" class="nav-link">Mes commandes</a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.home') }}" class="nav-link">Admin</a>
                @endif
            @endauth
        </div>

        <div class="topbar__right">
            @guest
                <a href="{{ route('login') }}" class="nav-link nav-pill">Se connecter</a>
                <a href="{{ route('register') }}" class="button-link">Créer un compte</a>
            @endguest

            @auth
                <span class="muted">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit">Déconnexion</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
