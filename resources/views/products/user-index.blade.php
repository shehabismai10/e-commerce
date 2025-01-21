@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        


        <table class="table table-bordered table-striped" style="color: white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>

                    <th>Description</th>
                    <th>Category</th>
                    <th>Image</th>


                </tr>
            </thead>
            <tbody>
            

                @foreach ($products as $product)

            


                    <tr>
                    
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name ?? 'No Name' }}</td>
                        <td>{{ $product->price ?? 'No price' }}</td>

                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->image?? 'no image' }}</td>
                        <td><form action="{{ route('add-product-to-shopping-cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" style="color: black" value="1" min="1" class="form-control mb-2" style="width: 80px; display: inline-block;">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Add to Cart</button>
                        </form></td>
                        




                            


                            </td>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

@endsection
