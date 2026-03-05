@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Commande #{{ $order->id }}</h1>

        <p><strong>Client :</strong> {{ $order->user?->name ?? 'N/A' }}</p>
        <p><strong>Total :</strong> {{ number_format($order->total, 2, ',', ' ') }} €</p>
        <p><strong>Status :</strong> {{ $order->status }}</p>

        <h3>Lignes</h3>

        <table border="1" cellpadding="8">
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>

            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product?->name ?? 'Produit supprimé' }}</td>
                    <td>{{ number_format($item->unit_price, 2, ',', ' ') }} €</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->unit_price * $item->qty, 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </table>

        <p style="margin-top:16px;">
            <a href="{{ route('admin.orders.index') }}">← Retour</a>
        </p>
    </div>
@endsection
