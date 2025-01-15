@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                    <td>
                        <form action="{{ route('delete.cart.item') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Total Quantity: {{ array_sum(array_column(session('cart'), 'quantity')) }}</h4>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
