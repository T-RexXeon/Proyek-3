<!DOCTYPE html>
<html>
<body>
    <h2>Form Registrasi</h2>
    @if($errors->any()) <p style="color:red;">Ada data yang salah/kosong.</p> @endif

    <form action="/register" method="POST">
        @csrf
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Username:</label><br>
        <input type="text" name="username" required><br>

        <label>Password (minimal 6 karakter):</label><br>
        <input type="password" name="password" required><br>

        <label>No HP:</label><br>
        <input type="text" name="no_hp" required><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
</body>
</html>