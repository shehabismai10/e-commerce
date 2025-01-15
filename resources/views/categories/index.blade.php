@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        


        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                            <!-- Delete Form -->
                        <td> <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style='color:blue' class="btn btn-danger">Delete</button>
                            </form>
                            
                            <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary mb-3" style="color: red   ">edit</a>




                            </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3" style="color: red   ">Add New Category</a>

@endsection
