@extends('dashboard')

@section('content')
<table id="cart" class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>quantity</th>

            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $item)

                <tr rowId="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ isset($item['poster']) ? $item['poster'] : 'N/A' }}" class="card-img-top"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $item['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    
                    <td data-th="Price">${{ $item['price'] }}</td>

                    <td data-th="Price">${{ $item['quantity'] }}</td>


                    <td data-th="Subtotal" class="text-center">${{ $item['price'] * $item['quantity'] }}</td>
                    <td class="actions">
                        <form action="{{ route('delete.cart.item') }}" method="POST" class="delete-item-form">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/products-list') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-danger">Checkout</button>
            </td>
        </tr>
    </tfoot>
</table>
@endsection


