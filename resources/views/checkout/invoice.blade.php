<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .invoice { border: 1px solid #ddd; padding: 20px; border-radius: 5px; background-color: #ffffff; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-details { margin-bottom: 20px; }
        h1 { color: #007bff; }
        .invoice-header p { font-size: 1.2em; }
        .invoice-details p { font-size: 1.1em; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        table th { background-color: #f8f9fa; }
        .total-row { font-weight: bold; }
        .back-btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Order #{{ $order->order_id }}</p>
        </div>

        <div class="invoice-details">
            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_postal }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        <h2>Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3">Total Pembayaran</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('home') }}" class="back-btn">Kembali ke Home</a>
    </div>
</body>
</html>
