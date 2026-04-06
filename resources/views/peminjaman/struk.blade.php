<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: auto; }
        .text-center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        .nomor { font-size: 40px; font-weight: bold; display: block; margin: 10px 0; }
        table { width: 100%; font-size: 12px; }
    </style>
</head>
<body>
    <div class="text-center">
        <h3>{{ $nama_web }}</h3>
        <p>Bukti Booking/Peminjaman</p> <div class="line"></div>
        <span class="nomor">{{ $antrian }}</span>
        <div class="line"></div>
    </div>
    <table>
        <tr><td>Nama</td><td>: {{ $nama }}</td></tr>
        <tr><td>Email</td><td>: {{ $email }}</td></tr>
        <tr><td>Buku</td><td>: {{ $judul }}</td></tr>
        <tr><td>Pinjam</td><td>: {{ $pinjam }}</td></tr>
        <tr><td>Kembali</td><td>: {{ $kembali }}</td></tr>
    </table>
    <div class="line"></div>
    <p class="text-center" style="font-size: 10px;">Tunjukkan nomor antrean ini kepada petugas perpustakaan.</p>
</body>
</html>