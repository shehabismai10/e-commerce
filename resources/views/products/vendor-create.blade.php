<form action="{{ route('products.vendor-store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" required>
    </div>

    <div>
        <label for="sku">SKU</label>
        <input type="text" name="sku" id="sku" required>
    </div>

    <div>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" step="0.01" required>
    </div>

    <div>
        <label for="category_id">Category </label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->name}}>
                    {{ $category->name }}
                </option>
            @endforeach


            
        
    </div>

    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>
    <button type="submit">Add product</button>
</form>

