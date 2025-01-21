<x-layout>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('dashboard.update', $product->id_products) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>
            <div class="form-group">
                <label for="categories">Category</label>
                <input type="text" name="categories" id="categories" class="form-control" value="{{ $product->categories }}" required>
            </div>
            <div class="form-group">
                <label for="images">Image</label>
                <input type="file" name="images" id="images" class="form-control">
                @if($product->images)
                    <img src="{{ asset('storage/' . $product->images) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-layout>
