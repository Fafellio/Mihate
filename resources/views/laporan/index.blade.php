<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku | Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ===== GLOBAL DARK THEME (Sesuai Dashboard) ===== */
        body, #wrapper, #content-wrapper, #content {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== SIDEBAR CUSTOM ===== */
        .sidebar {
            background-color: #1e293b !important; /* Slate 800 */
            background-image: none !important;
            border-right: 1px solid #334155;
        }

        .sidebar .nav-item .nav-link {
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .sidebar .nav-item.active .nav-link, 
        .sidebar .nav-item .nav-link:hover {
            color: #10b981 !important; /* Emerald */
        }

        .sidebar .nav-item.active {
            background-color: rgba(16, 185, 129, 0.05);
            border-right: 3px solid #10b981;
        }

        .sidebar-divider { border-top: 1px solid #334155; }
        .sidebar-heading { color: #475569 !important; }

        /* ===== CARD & TABLE ===== */
        .card {
            background-color: #1e293b; /* Slate 800 */
            border: 1px solid #334155;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .page-title { 
            color: #10b981; 
            font-weight: 800; 
            border-left: 5px solid #10b981;
            padding-left: 15px;
        }

        .table { color: #f8fafc; }
        .table-bordered { border: 1px solid #334155; }
        
        .table thead th {
            background-color: #0f172a;
            color: #10b981;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
            color: white;
        }

        /* ===== BADGES ===== */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.7rem;
        }
        .badge-success { background-color: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid #10b981; }
        .badge-warning { background-color: rgba(245, 158, 11, 0.2); color: #f59e0b; border: 1px solid #f59e0b; }
        .badge-danger { background-color: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid #ef4444; }

        /* ===== BUTTON LOGOUT ===== */
        .btn-logout {
            background-color: transparent;
            color: #ef4444 !important;
            border: 1px solid #ef4444;
            transition: 0.3s;
            margin: 10px;
            border-radius: 8px;
            font-weight: 700;
        }
        .btn-logout:hover { background-color: #ef4444; color: white !important; }

        .text-muted-custom { color: #64748b !important; }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader" style="color: #10b981;"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pageDashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('buku.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <i class="fas fa-fw fa-bookmark"></i>
                    <span>Bookmark Saya</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('peminjaman.index') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Peminjaman Saya</span>
                </a>
            </li>

            @if(in_array(auth()->user()->role_id, [1, 3]))
                <hr class="sidebar-divider">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Manajemen Users</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('laporan.index') }}">
                            <i class="fas fa-fw fa-comment-alt"></i>
                            <span>Laporan Buku</span>
                        </a>
                    </li>
                @endif
            @endif

            <hr class="sidebar-divider">
            <li class="nav-item px-2">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-block text-left">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="pt-4">
                <div class="container-fluid">
                    <h2 class="page-title mb-4">LAPORAN KONDISI BUKU</h2>

                    <div class="card shadow">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pl-4">TANGGAL</th>
                                            <th>PEMINJAM</th>
                                            <th>JUDUL BUKU</th>
                                            <th class="text-center">KONDISI</th>
                                            <th>CATATAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($laporans as $l)
                                        <tr>
                                            <td class="pl-4 font-weight-bold" style="color: #94a3b8;">
                                                {{ $l->tgl_kembali ?? '-' }}
                                            </td>
                                            <td class="font-weight-bold">{{ $l->user->name }}</td>
                                            <td><span class="text-emerald-500" style="color: #10b981;">{{ $l->buku->judul }}</span></td>
                                            <td class="text-center">
                                                @if($l->kondisi_buku == 'baik')
                                                    <span class="badge badge-success badge-custom text-uppercase">Baik</span>
                                                @elseif($l->kondisi_buku == 'rusak')
                                                    <span class="badge badge-warning badge-custom text-uppercase">Rusak</span>
                                                @else
                                                    <span class="badge badge-danger badge-custom text-uppercase">Hilang</span>
                                                @endif
                                            </td>
                                            <td class="text-muted-custom italic small">
                                                <i class="fas fa-quote-left mr-1 opacity-50"></i>
                                                {{ $l->keterangan_petugas ?? '-' }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted-custom">
                                                <i class="fas fa-clipboard-list fa-3x mb-3 d-block"></i>
                                                Belum ada laporan masuk.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>