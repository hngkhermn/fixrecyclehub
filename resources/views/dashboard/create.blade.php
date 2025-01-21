<x-header></x-header>
<div class="container">
    <h1>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h1>
    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="images">Images</label>
        <input type="file" name="images" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>
    <div class="form-group">
        <label for="categories">Categories</label>
        <input type="text" name="categories" class="form-control" value="{{ old('categories') }}" required>
    </div>
    <button type="submit" class="btn btn-success">Add Product</button>
</form>

</div>
</body>
</html>