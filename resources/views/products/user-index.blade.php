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
                        <td>{{ $product->image?? 'no image' }}</td>

                        




                            


                            </td>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

@endsection
