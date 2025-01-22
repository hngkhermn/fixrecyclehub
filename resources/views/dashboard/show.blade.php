<x-layout>
    <div class="container">
        <h1>Products</h1>
        <!-- <a href="{{ route('dashboard.create') }}" class="btn btn-primary">Add Product</a> -->
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
                <tr>
                    <td>{{ $dashboard->id_products }}</td>
                    @if(isset($dashboard) && $dashboard->images)
                    <td>
                        <img src="/storage/images/{{$dashboard->images}}" alt="Product Image" width="100px">
                    </td>  
                    @endif
                    <td>{{ $dashboard->name }}</td>
                    <td>{{ $dashboard->description }}</td>
                    <td>{{ $dashboard->price }}</td>
                    <td>{{ $dashboard->stock }}</td>
                    <td>{{ $dashboard->categories }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>