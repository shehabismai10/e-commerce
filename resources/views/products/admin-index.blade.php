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
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->image }}</td>


                        

                            <!-- Delete Form -->
                        <td> <form action="{{ route('products.admin-delete', $product->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style='color:blue' class="btn btn-danger">Delete</button>
                            </form>
                            
                            <a href="{{ route('products.admin-edit',$product->id) }}" class="btn btn-primary mb-3" style="color: red   ">edit</a>


                            


                            </td>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <a href="{{ route('products.admin-create') }}" class="btn btn-primary mb-3" style="color: red   ">Add New products</a>

@endsection
