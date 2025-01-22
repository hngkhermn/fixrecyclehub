<x-layout><
  <div class="filter-header d-flex justify-content-between align-items-center mb-4">
    <!-- Filter Kategori dan Pengaturan Tampilan -->
    <div class="view-options d-flex align-items-center">
      </button>
      <span class="ms-3 text-muted">{{ $products->count() }} Product</span>
    </div>
    <div class="sort-filter">
      <!-- Filter langsung pilih tanpa modal -->
      <form action="{{ route('product') }}" method="GET">
        <div class="d-flex">
          <!-- Dropdown Urutan Produk -->
          <select name="sort" id="sort" class="form-select ms-2" onchange="this.form.submit()">
            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Alphabetically (A to Z)</option>
            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Alphabetically (Z to A)</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
          </select>
        </div>
      </form>
    </div>
  </div>

  <section class="filter-section text-center mt-4">
    <div class="container">
      <a href="{{ route('product', ['category' => 'all']) }}" class="btn btn-outline-success {{ request('category') == 'all' ? 'active' : '' }}">All</a>
      <a href="{{ route('product', ['category' => 'plastik']) }}" class="btn btn-outline-success {{ request('category') == 'plastik' ? 'active' : '' }}">Plastik</a>
      <a href="{{ route('product', ['category' => 'kain']) }}" class="btn btn-outline-success {{ request('category') == 'kain' ? 'active' : '' }}">Kain</a>
      <a href="{{ route('product', ['category' => 'kayu']) }}" class="btn btn-outline-success {{ request('category') == 'kayu' ? 'active' : '' }}">Kayu</a>
      <a href="{{ route('product', ['category' => 'kaca']) }}" class="btn btn-outline-success {{ request('category') == 'kaca' ? 'active' : '' }}">Kaca</a>
      <a href="{{ route('product', ['category' => 'kertas']) }}" class="btn btn-outline-success {{ request('category') == 'kertas' ? 'active' : '' }}">Kertas</a>
      <a href="{{ route('product', ['category' => 'Besi']) }}" class="btn btn-outline-success {{ request('category') == 'Besi' ? 'active' : '' }}">Besi</a>
    </div>
  </section>

  <section class="products-section mt-4">
    <div class="container">
      <div class="row products-container">
        @foreach($products as $product)
          <div class="col-md-4 product-card" data-category="{{ $product->categories }}">
            <a href="{{ route('product.detail', $product->id_products) }}" class="text-decoration-none">
              <div class="card">
                <img src="/storage/images/{{$product->images}}" class="card-img-top" alt="{{ $product->categories }}">
                <div class="card-body text-center">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                  <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id_products }}">
                    <button type="submit" class="btn btn-success mt-3">
                      <i class="bi bi-cart-plus"></i> Masukkan ke Keranjang
                    </button>
                  </form>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</x-layout>
