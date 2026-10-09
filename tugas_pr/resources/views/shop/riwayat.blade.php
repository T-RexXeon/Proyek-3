<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto;">

    <h2>Riwayat Pesanan Anda</h2>
    <p><a href="/produk">Kembali Belanja</a></p>
    <hr>

    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif

    @forelse($orders as $order)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
            <strong>ID Pesanan: {{ $order->id_order }}</strong><br>
            Waktu Checkout: {{ $order->tanggal_order }}<br>
            Total Bayar: <strong style="color: green;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong><br>
            Dikirim ke: {{ $order->alamat_pengiriman }}
        </div>
    @empty
        <p>Anda belum memiliki riwayat pesanan.</p>
    @endforelse

</body>
</html>