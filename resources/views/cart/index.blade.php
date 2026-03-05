@extends('layouts.app')

@section('content')

    <h1>Panier</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(empty($cart))
        <p>Votre panier est vide</p>
    @else

        <table border="1" cellpadding="8">
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th></th>
            </tr>

            @php $total = 0; @endphp

            @foreach($cart as $item)

                @php $line = $item['price'] * $item['quantity']; $total += $line; @endphp

                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }} €</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $line }} €</td>

                    <td>
                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>

                </tr>

            @endforeach

        </table>

        <h3>Total : {{ $total }} €</h3>

        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <button type="submit">Commander</button>
        </form>

    @endif

@endsection
