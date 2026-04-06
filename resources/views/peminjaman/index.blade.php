<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya | Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ===== GLOBAL DARK THEME ===== */
        body {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
            padding-bottom: 50px;
        }

        .header-title { 
            color: #10b981; 
            font-weight: 800; 
            border-left: 5px solid #10b981;
            padding-left: 15px;
        }

        /* ===== TABEL CUSTOM ===== */
        .card-table {
            background-color: #1e293b; /* Slate 800 */
            border: 1px solid #334155;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .table { color: #f8fafc; margin-bottom: 0; }
        .table thead th {
            background-color: #0f172a;
            color: #10b981;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
            padding: 15px;
        }
        .table td { vertical-align: middle !important; border-top: 1px solid #334155; padding: 12px 15px; }
        .table-hover tbody tr:hover { background-color: rgba(255, 255, 255, 0.02); }

        /* ===== KOMPONEN BUKU ===== */
        .img-buku { 
            width: 50px; 
            height: 70px; 
            object-fit: cover; 
            border-radius: 6px; 
            border: 1px solid #475569;
            transition: transform 0.3s;
        }
        .img-buku:hover { transform: scale(1.1); }
        .text-judul { color: #f8fafc; font-weight: 700; text-decoration: none !important; transition: 0.3s; }
        .text-judul:hover { color: #10b981; }

        /* ===== BADGE WAKTU & STATUS ===== */
        .waktu-badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; display: inline-block; }
        .waktu-hijau { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid #10b981; }
        .waktu-kuning { background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid #f59e0b; }
        .waktu-merah { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid #ef4444; }

        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 10px; font-weight: 800; letter-spacing: 0.5px; }

        /* ===== BUTTONS ===== */
        .btn-emerald { background-color: #10b981; color: white !important; font-weight: 700; border-radius: 8px; border: none; transition: 0.3s; }
        .btn-emerald:hover { background-color: #059669; transform: translateY(-2px); }
        
        .btn-print { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid #3b82f6; border-radius: 6px; font-weight: 600; }
        .btn-print:hover { background: #3b82f6; color: white; }

        .btn-kembali-buku { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; border-radius: 6px; font-weight: 600; }
        .btn-kembali-buku:hover { background: #10b981; color: white; }

        /* SweetAlert Dark */
        .swal2-popup { background-color: #1e293b !important; color: #f8fafc !important; border: 1px solid #334155; }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="header-title">📋 Peminjaman Saya</h3>
            <a href="{{ route('buku.index') }}" class="btn btn-sm btn-emerald px-3">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <script>
                // Kita pakai SweetAlert untuk notifikasi sukses biar konsisten
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        background: '#1e293b',
                        color: '#f8fafc',
                        confirmButtonColor: '#10b981'
                    });
                });
            </script>
        @endif

        <div class="card card-table">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th width="80">Sampul</th>
                            <th>Judul Buku</th>
                            <th>Sisa Waktu</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $index => $p)
                        <tr>
                            <td class="text-center font-weight-bold text-muted" style="font-size: 0.9rem;">{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('buku.show', $p->buku->id) }}">
                                    @if($p->buku->cover)
                                        <img src="/storage/{{ $p->buku->cover }}" class="img-buku" alt="Cover">
                                    @else
                                        <img src="{{ asset('img/no-cover.png') }}" class="img-buku" alt="No Cover">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $p->buku->id) }}" class="text-judul">
                                    {{ $p->buku->judul }}
                                </a>
                                <div class="small text-muted">{{ $p->buku->penulis }}</div>
                            </td>
                            <td>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $target = \Carbon\Carbon::parse($p->tgl_kembali);
                                    $jam = (int) $now->diffInHours($target, false);
                                    $hari = (int) $now->diffInDays($target, false);
                                    $statusUser = strtolower($p->status);
                                @endphp

                                @if($jam < 0)
                                    <span class="waktu-badge waktu-merah"><i class="fas fa-exclamation-circle mr-1"></i>Terlambat</span>
                                @elseif($jam <= 24)
                                    <span class="waktu-badge waktu-kuning"><i class="fas fa-clock mr-1"></i>{{ $jam }} Jam Lagi</span>
                                @else
                                    <span class="waktu-badge waktu-hijau"><i class="fas fa-calendar-alt mr-1"></i>{{ $hari }} Hari Lagi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @php
                                    $statusColors = [
                                        'pending' => 'badge-secondary',
                                        'booking' => 'badge-info',
                                        'pinjam' => 'btn-emerald', // Pakai emerald biar mantap
                                        'permintaan_kembali' => 'badge-warning',
                                        'kembali' => 'badge-success',
                                        'terlambat' => 'badge-danger',
                                    ];
                                    $warna = $statusColors[$statusUser] ?? 'badge-light';
                                @endphp
                                <span class="badge {{ $warna }} badge-status text-uppercase">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap: 8px;">
                                    <a href="{{ route('peminjaman.cetak', $p->id) }}" target="_blank" class="btn btn-sm btn-print" title="Cetak Bukti">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>

                                    @if($statusUser == 'pinjam' || $statusUser == 'terlambat')
                                        <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" class="form-kembalikan">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-kembali-buku btn-konfirmasi-kembali">
                                                <i class="fas fa-undo mr-1"></i> Kembalikan
                                            </button>
                                        </form>
                                    @elseif($statusUser == 'permintaan_kembali')
                                        <span class="text-warning small font-weight-bold">
                                            <i class="fas fa-hourglass-half mr-1"></i> Menunggu Validasi
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-history fa-3x mb-3 d-block opacity-20"></i>
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Konfirmasi Pengembalian
            $('.btn-konfirmasi-kembali').on('click', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Kembalikan Buku?',
                    text: "Pastikan buku dalam kondisi baik saat dikembalikan ke petugas.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'Ya, Kembalikan!',
                    cancelButtonText: 'Batal',
                    background: '#1e293b',
                    color: '#f8fafc'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>