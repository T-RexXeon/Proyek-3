<!DOCTYPE html>
<html>
<body>
    <h2>Form Login</h2>
    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif
    @if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif

    <form action="/login" method="POST">
        @csrf
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
    <p><a href="/produk">Kembali ke Beranda (Tanpa Login)</a></p>
</body>
</html>