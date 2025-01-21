<x-layout>
  <section class="checkout-section mt-5">
    <div class="container">
      <h1 class="text-center mb-4">Checkout</h1>

      @if(session('cart') && count(session('cart')) > 0)
      <div class="row">
        <div class="col-md-8">
          <!-- Formulir Detail Pemesan -->
          <form action="{{ route('order.confirm') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="customer_name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>

            <div class="mb-3">
              <label for="customer_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="customer_email" name="customer_email" required>
            </div>

            <div class="mb-3">
              <label for="customer_phone" class="form-label">Telepon</label>
              <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
            </div>

            <div class="mb-3">
              <label for="shipping_address" class="form-label">Alamat Pengiriman</label>
              <textarea class="form-control" id="shipping_address" name="shipping_address" required></textarea>
            </div>

            <div class="mb-3">
              <label for="shipping_city" class="form-label">Kota</label>
              <input type="text" class="form-control" id="shipping_city" name="shipping_city" required>
            </div>

            <div class="mb-3">
              <label for="shipping_postal" class="form-label">Kode Pos</label>
              <input type="text" class="form-control" id="shipping_postal" name="shipping_postal" required>
            </div>

            <!-- Daftar Produk di Keranjang -->
            <h4>Rincian Belanja</h4>
            <table class="table table-bordered mt-3">
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
                  <td>{{ $details['quantity'] }}</td>
                  <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <!-- Total Belanja -->
            <div class="d-flex justify-content-between mt-4">
              <h5>Subtotal</h5>
              <p>Rp {{ number_format($cartTotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
              }, session('cart'))), 0, ',', '.') }}</p>
            </div>
            <div class="d-flex justify-content-between">
              <h5>Biaya Pengiriman</h5>
              <p>Rp 10.000</p>
            </div>
            <div class="d-flex justify-content-between">
              <h5>Total</h5>
              <p>Rp {{ number_format($cartTotal + 10000, 0, ',', '.') }}</p>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-success w-100">Konfirmasi Pesanan</button>
            </div>
          </form>
        </div>

        <!-- Ringkasan Belanja (Optional) -->
        <div class="col-md-4">
          <div class="cart-summary">
            <h4>Ringkasan Belanja</h4>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Subtotal
                <span>Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
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
          </div>
        </div>
      </div>
      @else
      <p class="text-center">Keranjang Anda kosong. Silakan tambahkan produk.</p>
      @endif
    </div>
  </section>
</x-layout>
