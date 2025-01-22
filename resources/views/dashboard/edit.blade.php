<x-header></x-header>
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{route('dashboard.update', ['dashboard' => $dashboard->id_products])}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($dashboard))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $dashboard->name }}" required>
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images" class="form-control" value="{{ $dashboard->images }}" nullable>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $dashboard->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $dashboard->price }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $dashboard->stock }}" required>
        </div>
        <div class="form-group">
            <label for="name">Categories</label>
            <input type="text" name="categories" class="form-control" value="{{ $dashboard->categories }}" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
</body>

</html>