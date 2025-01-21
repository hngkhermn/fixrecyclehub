<x-layout>
  <!-- Konten halaman detail produk -->
  <section class="product-detail mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="product-image">
            <img src="{{ asset('storage/' . $product->images) }}" class="img-fluid" alt="{{ $product->name }}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="product-info">
            <h1 class="product-title">{{ $product->name }}</h1>
            <div class="price-section">
              <span class="sale-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            <p class="product-description">{{ $product->description }}</p>
            <p class="product-stock">
              Stock: {{ $product->stock }}
            </p>
            <div class="quantity-section d-flex align-items-center mt-4">
              <input type="number" name="quantity" class="form-control quantity-input me-3" value="1" min="1" max="{{ $product->stock }}">
              <form action="{{ route('cart.add') }}" method="POST" class="mb-0">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id_products }}">
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-cart-plus"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>