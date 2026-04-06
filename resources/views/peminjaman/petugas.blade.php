<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Konfirmasi Antrean - Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ===== GLOBAL DARK THEME (Slate 900) ===== */
        body, #page-top, #wrapper, #content-wrapper {
            background-color: #0f172a !important;
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== SIDEBAR CUSTOM ===== */
        .sidebar { 
            background-color: #1e293b !important; 
            background-image: none !important; 
            border-right: 1px solid #334155;
        }
        .sidebar .nav-link { color: #94a3b8 !important; font-weight: 600; }
        .sidebar .nav-link i { color: #94a3b8 !important; }
        .sidebar .nav-item.active .nav-link { 
            background-color: rgba(16, 185, 129, 0.1) !important; 
            color: #10b981 !important; 
        }
        .sidebar .nav-item.active .nav-link i { color: #10b981 !important; }
        .sidebar-brand { color: #10b981 !important; }

        /* ===== CARD & TABLE ===== */
        .card { 
            background-color: #1e293b; 
            border: 1px solid #334155; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .card-header { 
            background-color: #1e293b; 
            border-bottom: 1px solid #334155; 
            color: #10b981; 
            font-weight: 800;
        }
        
        .table { color: #f8fafc; }
        .table thead th { 
            background-color: #0f172a; 
            color: #10b981; 
            border: none; 
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .table td { border-top: 1px solid #334155; vertical-align: middle !important; }
        .table-hover tbody tr:hover { background-color: rgba(255, 255, 255, 0.02); }

        /* ===== BADGES & BUTTONS ===== */
        .badge { border-radius: 6px; font-weight: 700; padding: 6px 12px; }
        .btn-emerald { background-color: #10b981; color: white !important; border: none; font-weight: 700; }
        .btn-emerald:hover { background-color: #059669; transform: translateY(-1px); }
        
        /* Modal Styling */
        .modal-content { background-color: #1e293b; color: #f8fafc; border: 1px solid #334155; border-radius: 15px; }
        .modal-header { border-bottom: 1px solid #334155; }
        .modal-footer { border-top: 1px solid #334155; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #10b981; }

        /* Animation for Return Request */
        @keyframes pulse-blue {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .animate-pulse-custom { animation: pulse-blue 2s infinite; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon"><i class="fas fa-book"></i></div>
                <div class="sidebar-brand-text mx-3">Pinjaman Buku</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->routeIs('pageDashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pageDashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('buku.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('buku.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Buku</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('booking.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <i class="fas fa-fw fa-bookmark"></i>
                    <span>Bookmark</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('peminjaman.index') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Peminjaman Saya</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            @if(in_array(auth()->user()->role_id, [1, 3]))
                <div class="sidebar-heading">Manajemen Data</div>

                <li class="nav-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kategori.index') }}">
                        <i class="fas fa-fw fa-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('buku.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('buku.list') }}">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Manajemen Buku</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('peminjaman.petugas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('peminjaman.petugas') }}">
                        <i class="fas fa-fw fa-clipboard-check"></i>
                        <span>Konfirmasi Antrean</span>
                    </a>
                </li>

                @if(auth()->user()->role_id == 1)
                    <div class="sidebar-heading">Admin Panel</div>
                    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Manajemen Users</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('laporan-buku*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('laporan.index') }}">
                            <i class="fas fa-fw fa-file-alt"></i>
                            <span>Laporan Buku</span>
                        </a>
                    </li>
                @endif
                <hr class="sidebar-divider">
            @endif

            <li class="nav-item px-3 mt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm btn-block shadow-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pt-4">

                    <div class="mb-4">
                        <h1 class="h3 mb-0 font-weight-bold text-white">Konfirmasi Antrean</h1>
                        <p class="text-muted">Kelola penyerahan dan pengembalian buku secara real-time.</p>
                    </div>

                    @if(session('success'))
                        <script>
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

                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-stream mr-2"></i>Antrean Aktif</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No. Antrean</th>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th>Status</th>
                                            <th>Aksi Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $adaAntrean = false; @endphp
                                        @foreach($peminjamans as $p)
                                            @if(in_array($p->status, ['pending', 'pinjam', 'terlambat', 'permintaan_kembali']))
                                            @php $adaAntrean = true; @endphp
                                            <tr>
                                                <td class="font-weight-bold" style="color: #10b981;">#{{ str_pad($p->nomor_antrian, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td class="font-weight-bold">{{ $p->user->name }}</td>
                                                <td>{{ $p->buku->judul }}</td>
                                                <td>
                                                    @if($p->status == 'pending')
                                                        <span class="badge badge-warning text-dark">MENUNGGU DIAMBIL</span>
                                                    @elseif($p->status == 'pinjam')
                                                        <span class="badge badge-info">SEDANG DIPINJAM</span>
                                                    @elseif($p->status == 'terlambat')
                                                        <span class="badge badge-danger text-white">TERLAMBAT</span>
                                                    @elseif($p->status == 'permintaan_kembali')
                                                        <span class="badge badge-primary animate-pulse-custom">PENGAJUAN KEMBALI</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($p->status == 'pending')
                                                        <form action="{{ route('peminjaman.konfirmasiAmbil', $p->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-emerald btn-sm px-3 shadow-sm">
                                                                <i class="fas fa-hand-holding mr-1"></i> Serahkan
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('peminjaman.cancel', $p->id) }}" method="POST" class="d-inline form-cancel">
                                                            @csrf
                                                            <button type="button" class="btn btn-outline-danger btn-sm btn-konfirmasi-tolak">Tolak</button>
                                                        </form>
                                                    @elseif(in_array($p->status, ['pinjam', 'terlambat', 'permintaan_kembali']))
                                                        <button type="button" class="btn {{ $p->status == 'permintaan_kembali' ? 'btn-primary' : 'btn-outline-primary' }} btn-sm btn-kembali shadow-sm" 
                                                            data-url="{{ route('peminjaman.konfirmasiKembali', $p->id) }}" 
                                                            data-toggle="modal" data-target="#modalKembali">
                                                            <i class="fas fa-check-circle mr-1"></i> Konfirmasi Kembali
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @if(!$adaAntrean)
                                            <tr>
                                                <td colspan="5" class="py-5 text-muted">Tidak ada antrean aktif saat ini.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKembali" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary">Cek Fisik & Pengembalian</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formKembali" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold small text-muted text-uppercase">Kondisi Buku Saat Ini:</label>
                            <select name="kondisi_buku" class="form-control" required>
                                <option value="baik">Baik (Normal)</option>
                                <option value="rusak">Rusak (Denda Sesuai Kebijakan)</option>
                                <option value="hilang">Hilang (Ganti Rugi Buku)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold small text-muted text-uppercase">Catatan Petugas (Opsional):</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Tulis catatan jika ada kerusakan atau keterlambatan khusus..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-emerald px-4">Proses Terima Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Modal Handle
            $('.btn-kembali').on('click', function() {
                var url = $(this).data('url');
                $('#formKembali').attr('action', url);
            });

            // Konfirmasi Tolak
            $('.btn-konfirmasi-tolak').on('click', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Tolak Pesanan?',
                    text: "Pesanan ini akan dibatalkan dan stok buku akan dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'Ya, Tolak!',
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