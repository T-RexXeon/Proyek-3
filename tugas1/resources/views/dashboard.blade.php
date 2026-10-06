<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
        <h2>Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">[ Logout ]</button>
        </form>
    </div>

    <div style="margin-top: 20px;">
        <p>Selamat datang, {{ Auth::user()->nama_lengkap }}!</p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ Auth::user()->username }}</p>
    </div>
</body>
</html>