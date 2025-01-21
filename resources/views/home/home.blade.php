<x-layout>

  <section class="hero-section">
    <div class="hero-overlay">
      <div class="container text-center text-white">
        <h1>RECYCLE HUB WHERE WASTE TRANSFORMS INTO VALUE</h1>
        <p>RecycleHub adalah marketplace yang mengubah limbah menjadi barang berguna seperti hiasan, alat rumah tangga, dan dekorasi unik. Kami mendukung daur ulang untuk masa depan yang lebih berkelanjutan.</p>
      </div>
    </div>
  </section>

  <section class="product-section">
  <h2 class="section-title">PRODUCTS</h2>
  <div class="product-container">
    @foreach($products as $product)
      <div class="product-card">
        <!-- <a href="{{ route('product.detail', $product->id_products) }}"> -->
        <a href="{{ route('product') }}">
          <img src="{{ asset('storage/' . $product->images) }}" alt="{{ $product->name }}">
          <div class="product-name">{{ $product->name }}</div>
        </a>
      </div>
    @endforeach
    </div>
  </section>


  <section class="features-section">
    <div class="container features mt-5">
      <div class="row text-center">
        <div class="col-md-3">
          <div class="feature-item">
            <i class="bi bi-truck fs-1 text-success"></i>
            <h5>Fast delivery</h5>
            <p>Quick and efficient</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="feature-item">
            <i class="bi bi-arrow-repeat fs-1 text-success"></i>
            <h5>Easy return</h5>
            <p>Simple return process</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="feature-item">
            <i class="bi bi-headset fs-1 text-success"></i>
            <h5>Continuous support</h5>
            <p>24/7 customer care</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="feature-item">
            <i class="bi bi-credit-card fs-1 text-success"></i>
            <h5>Flexible payment</h5>
            <p>Various payment options</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</x-layout>