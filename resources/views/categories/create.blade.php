<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>
    <button type="submit">Add Category</button>
</form>

