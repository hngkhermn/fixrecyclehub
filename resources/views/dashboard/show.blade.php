<x-layout>
    <div class="container">
        <h1>Product Details</h1>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Category:</strong> {{ $product->categories }}</p>
        @if ($product->images)
            <img src="{{ asset('storage/' . $product->images) }}" alt="Product Image" style="max-width: 300px;">
        @endif
        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</x-layout>
