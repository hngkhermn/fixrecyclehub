<x-layout>

  <section class="cart-section mt-5">
    <div class="container">
      <h1 class="text-center mb-4">Keranjang Belanja</h1>

      @if(session('cart') && count(session('cart')) > 0)
      <div class="row">
        <div class="col-md-8">
          <!-- Daftar Produk di Keranjang -->
          <form action="{{ route('cart.update_all') }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>Harga</th>
                  <th>Kuantitas</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach(session('cart') as $id => $details)
                <tr>
                  <td>{{ $details['name'] }}</td>
                  <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                  <td>
                    <!-- Input untuk Mengubah Kuantitas -->
                    <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" min="0" style="width: 50px;" >
                  </td>
                  <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" class="btn btn-warning btn-sm">Perbarui Keranjang</button>
          </form>


          <div class="text-center mt-4">
            <a href="{{ route('product') }}" class="btn btn-outline-secondary">Lanjutkan Belanja</a>
          </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="col-md-4">
          <div class="cart-totals">
            <h4>Ringkasan Belanja</h4>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Subtotal
                <span>Rp {{ number_format($cartTotal = array_sum(array_map(function ($item) {
                  return $item['price'] * $item['quantity'];
                }, session('cart'))), 0, ',', '.') }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Biaya Pengiriman
                <span>Rp 10.000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Total</strong>
                <strong>Rp {{ number_format($cartTotal + 10000, 0, ',', '.') }}</strong>
              </li>
            </ul>

            <!-- Tombol Checkout -->
            <div class="text-center mt-4">
              <a href="{{ route('checkout') }}" class="btn btn-success w-100">Lanjut ke Checkout</a>
            </div>
          </div>
        </div>
      </div>

      @else
      <p class="text-center">Keranjang Anda kosong. Silakan tambahkan produk.</p>
      @endif
    </div>
  </section>

</x-layout>