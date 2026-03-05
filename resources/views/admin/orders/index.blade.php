@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Commandes</h1>

        @if($orders->isEmpty())
            <p>Aucune commande.</p>
        @else
            <table border="1" cellpadding="8">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>

                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user?->name ?? 'N/A' }}</td>
                        <td>{{ number_format($order->total, 2, ',', ' ') }} €</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><a href="{{ route('admin.orders.show', $order) }}">Voir</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
