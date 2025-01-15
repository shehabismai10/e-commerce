@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">image:</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($category->image)
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="150">
        @endif
    </div>
            
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
