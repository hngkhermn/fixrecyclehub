<x-layout>
    <div class="container">
        <h1>Products</h1>
        <a href="{{ route('dashboard.create') }}" class="btn btn-primary">Add Product</a>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Categories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id_products }}</td>
                    @if(isset($product) && $product->images)
                    <td>
                        <img src="/storage/images/{{$product->images}}" alt="Product Image" width="100px">
                    </td>  
                    @endif
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->categories }}</td>
                    <td>
                        <a href="{{ route('dashboard.show', ['dashboard' => $product->id_products]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('dashboard.edit', ['dashboard' => $product->id_products]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('dashboard.destroy', ['dashboard' => $product->id_products]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>