<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto;">

    <h2>Keranjang belanja</h2>
    <p>Tanpa login | <a href="/index">Kembali Belanja</a></p>
    <hr>

    @forelse($keranjang as $item)
        <div style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px;">
            <strong>{{ $item['nama'] }}</strong><br>
            Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = 
            <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
            
            <div style="margin-top: 5px; display: flex; align-items: center;">
                <form action="/keranjang/update/{{ $item['id'] }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="aksi" value="kurang">
                    <button type="submit">[-]</button>
                </form>

                <span style="margin: 0 10px;">{{ $item['jumlah'] }}</span>

                <form action="/keranjang/update/{{ $item['id'] }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="aksi" value="tambah">
                    <button type="submit">[+]</button>
                </form>

                <form action="/keranjang/hapus/{{ $item['id'] }}" method="POST" style="margin: 0; margin-left: 10px;">
                    @csrf
                    <button type="submit">[hps]</button>
                </form>
            </div>
        </div>
    @empty
        <p>Keranjang Anda masih kosong.</p>
    @endforelse

    <div style="margin-top: 20px; font-size: 18px;">
        <strong>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
    </div>
    
    @if(count($keranjang) > 0)
        <form action="/keranjang/kosongkan" method="POST" style="margin-top: 15px;">
            @csrf
            <button type="submit">[ Kosongkan keranjang ]</button>
        </form>
    @endif

</body>
</html>