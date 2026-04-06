<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Manajemen Buku - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* ===== GLOBAL DARK THEME ===== */
        body, #page-top, #wrapper, #content-wrapper, #content {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== SIDEBAR DARK SLATE ===== */
        .sidebar {
            width: 240px !important;
            min-width: 240px !important;
            background-color: #1e293b !important; /* Slate 800 */
            background-image: none !important;
            border-right: 1px solid #334155;
        }

        .sidebar .nav-link { color: #94a3b8 !important; font-weight: 500; }
        .sidebar .nav-link:hover { color: #10b981 !important; }
        
        .sidebar .nav-item.active .nav-link {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 100%) !important;
            color: #10b981 !important;
            border-left: 4px solid #10b981;
        }

        .sidebar-brand { color: #f8fafc !important; }
        .sidebar-heading { color: #475569 !important; }

        /* ===== CARD & TABLE STYLE ===== */
        .card {
            background-color: #1e293b !important; /* Slate 800 */
            border: 1px solid #334155 !important;
            border-radius: 12px;
        }

        .card-header {
            background-color: rgba(16, 185, 129, 0.05) !important;
            border-bottom: 1px solid #334155 !important;
        }

        .table { color: #cbd5e1 !important; }
        .table-bordered { border: 1px solid #334155 !important; }
        .table-bordered td, .table-bordered th { border: 1px solid #334155 !important; }
        
        .table thead th {
            background-color: #0f172a !important;
            color: #10b981 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        /* ===== IMAGES & BUTTONS ===== */
        img.cover-img {
            width: 45px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #475569;
        }

        .btn-emerald {
            background-color: #10b981;
            border: none;
            color: white;
            font-weight: 600;
        }
        .btn-emerald:hover { 
            background-color: #059669; 
            color: white; 
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4); 
        }

        .btn-logout-custom {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-logout-custom:hover { background-color: #b91c1c; color: white; }

        .text-emerald { color: #10b981 !important; }
        
        /* Memberikan warna teks putih pada input filter pencarian jika ada dataTable nantinya */
        .dataTables_wrapper .dataTables_filter input {
            color: white !important;
            background-color: #0f172a !important;
            border: 1px solid #334155 !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-book-reader text-emerald"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Library</div>
            </a>

            <hr class="sidebar-divider my-0" style="border-top: 1px solid #334155;">

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
                    <span>Booking Saya</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('peminjaman.index') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Peminjaman Saya</span>
                </a>
            </li>

            <hr class="sidebar-divider" style="border-top: 1px solid #334155;">

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
                            <i class="fas fa-fw fa-comment-alt"></i>
                            <span>Laporan Buku</span>
                        </a>
                    </li>
                @endif
                <hr class="sidebar-divider" style="border-top: 1px solid #334155;">
            @endif

            <li class="nav-item mt-auto">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="btn btn-logout-custom btn-block text-left">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pt-4">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-white font-weight-bold">Manajemen Produk</h1>
                        <a href="{{ route('buku.create') }}" class="btn btn-emerald shadow-sm">
                            <i class="fas fa-plus fa-sm mr-2"></i> Tambah Buku Baru
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                    @endif

                    <div class="card shadow-lg mb-4">
                        <div class="card-header py-3 d-flex align-items-center">
                            <i class="fas fa-table text-emerald mr-2"></i>
                            <h6 class="m-0 font-weight-bold text-emerald">Koleksi & Stok Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cover</th>
                                            <th>Judul Buku</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bukus as $b)
                                        <tr>
                                            <td class="align-middle">
                                                @php
                                                    $cleanPath = str_replace('cover_buku/', '', $b->cover);
                                                    $finalPath = $b->cover 
                                                        ? asset('storage/cover_buku/' . $cleanPath) 
                                                        : 'https://via.placeholder.com/50x70?text=No+Cover';
                                                @endphp
                                                <img src="{{ $finalPath }}" class="cover-img shadow-sm" onerror="this.src='https://via.placeholder.com/50x70?text=Error'">
                                            </td>
                                            <td class="text-left align-middle font-weight-bold text-white">{{ $b->judul }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-pill {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}" style="padding: 6px 12px; {{ $b->stok > 0 ? 'background-color:#10b981;' : '' }}">
                                                    {{ $b->stok }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-outline-warning btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini dari sistem?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="sticky-footer" style="background: transparent;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-muted small">
                        <span>Copyright &copy; <strong>Fafellio Gienola</strong>, 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>