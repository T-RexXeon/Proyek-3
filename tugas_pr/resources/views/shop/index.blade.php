<!DOCTYPE html>
<html>
<head>
    <title>Toko Online PR</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto;">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Daftar Barang</h2>
        <div>
            @auth
                <span>Halo, {{ auth()->user()->nama_lengkap }}!</span>
                <a href="/keranjang" style="margin: 0 10px;">[ Keranjang ({{ $totalItem }}) ]</a>
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="/login">Login untuk Belanja</a>
            @endauth
        </div>
    </div>
    
    <hr>
    
    @if(session('error')) <p style="color:red;">{{ session('error') }}</p> @endif
    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach($products as $p)
            <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
                <strong>{{ $p->nama_barang }}</strong><br>
                <small>{{ $p->deskripsi }}</small><br>
                <p style="color: green;">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                <p>Stok: {{ $p->stok }}</p>
                
                @if($p->stok > 0)
                    <form action="/keranjang/tambah/{{ $p->id_barang }}" method="POST">
                        @csrf
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                @else
                    <button disabled style="color: red;">Stok Habis</button>
                @endif
            </div>
        @endforeach
    </div>

</body>
</html>