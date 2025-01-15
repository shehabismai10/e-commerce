@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.admin-update', $products->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">product Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $products->name) }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $products->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <textarea id="quantity" name="quantity" class="form-control">{{ old('quantity', $products->quantity) }}</textarea>
        </div>

        <div class="form-group">
            <label for="sku">Sku:</label>
            <textarea id="sku" name="sku" class="form-control">{{ old('sku', $products->sku) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <textarea id="price" name="price" class="form-control">{{ old('price', $products->price) }}</textarea>
        </div>



        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">image:</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($products->image)
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $products->image) }}" alt="Category Image" width="150">
        @endif
    </div>
            
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
