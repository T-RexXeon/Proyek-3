<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto;">

    <h2>Keranjang Belanja Anda</h2>
    <p><a href="/produk">Lanjut Belanja</a></p>
    <hr>

    @if(session('error')) <p style="color:red;">{{ session('error') }}</p> @endif

    @forelse($keranjang as $item)
        <div style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px;">
            <strong>{{ $item['nama_barang'] }}</strong><br>
            Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = 
            <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
            
            <div style="margin-top: 5px; display: flex; align-items: center;">
                <!-- Tombol Kurang -->
                <form action="/keranjang/update/{{ $item['id_barang'] }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="aksi" value="kurang">
                    <button type="submit">[-]</button>
                </form>

                <span style="margin: 0 10px;">{{ $item['jumlah'] }}</span>

                <!-- Tombol Tambah -->
                <form action="/keranjang/update/{{ $item['id_barang'] }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="aksi" value="tambah">
                    <button type="submit" {{ $item['jumlah'] >= $item['stok'] ? 'disabled' : '' }}>[+]</button>
                </form>

                <!-- Tombol Hapus -->
                <form action="/keranjang/hapus/{{ $item['id_barang'] }}" method="POST" style="margin: 0; margin-left: 10px;">
                    @csrf
                    <button type="submit">[hps]</button>
                </form>
            </div>
        </div>
    @empty
        <p>Keranjang Anda masih kosong.</p>
    @endforelse

    <div style="margin-top: 20px; font-size: 18px;">
        <strong>Total Bayar: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
    </div>
    
    @if(count($keranjang) > 0)
        <!-- Tombol Checkout (akan difungsikan di Tahap 4) -->
        <form action="/checkout" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" style="padding: 10px 20px; background: green; color: white; border: none; cursor: pointer;">
                Checkout Sekarang
            </button>
        </form>
    @endif

</body>
</html>