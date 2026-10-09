<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto;">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Toko Alat Tulis</h2>
        <a href="/keranjang" style="text-decoration: none; padding: 5px 10px; border: 1px solid black; color: black;">
            [ Keranjang ({{ $totalItem }}) ]
        </a>
    </div>
    
    <hr>
    <h3>Daftar barang</h3>

    @foreach($barang as $item)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>[img] {{ $item->nama }}</strong> <br>
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </div>
            
            <form action="/keranjang/tambah/{{ $item->id }}" method="POST">
                @csrf
                <button type="submit">[Masukkan ke krj]</button>
            </form>
        </div>
    @endforeach

</body>
</html>