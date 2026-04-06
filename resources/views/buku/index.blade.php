<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Buku - Pinjaman Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* ===== GLOBAL DARK THEME (Sama dengan Login/Register) ===== */
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

        /* ===== CARD BUKU STYLE ===== */
        .card-book {
            background-color: #1e293b !important; /* Slate 800 */
            border: 1px solid #334155 !important;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .card-book:hover {
            transform: translateY(-8px);
            border-color: #10b981 !important;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
        }

        .book-img-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            background-color: #0f172a;
        }

        .book-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #10b981;
            color: white;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        /* ===== TEXT & BUTTON STYLE ===== */
        .text-emerald { color: #10b981 !important; }
        .book-title { color: #f8fafc; font-size: 1rem; margin-bottom: 2px; }
        .book-author { color: #94a3b8; font-size: 0.85rem; }

        .btn-logout-custom {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 700;
            transition: 0.3s;
            border-radius: 0;
        }
        .btn-logout-custom:hover { background-color: #b91c1c; color: white; }
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
                <div class="container-fluid mt-4">
                    <h3 class="mb-4 font-weight-bold text-white">
                        <i class="fas fa-book-open text-emerald mr-2"></i> Daftar Koleksi Buku
                    </h3>

                    <div class="row">
                        @foreach($bukus as $buku)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card card-book shadow-sm">
                                <div class="book-img-container">
                                    <a href="{{ route('buku.show', $buku->id) }}">
                                        @php
                                            $cleanPath = str_replace('cover_buku/', '', $buku->cover);
                                            $finalPath = $buku->cover 
                                                ? asset('storage/cover_buku/' . $cleanPath) 
                                                : asset('img/no-cover.png');
                                        @endphp
                                        <img src="{{ $finalPath }}"
                                             alt="{{ $buku->judul }}"
                                             onerror="this.src='{{ asset('img/no-cover.png') }}'">
                                    </a>
                                    
                                    @if($buku->kategori)
                                    <span class="category-badge">
                                        {{ $buku->kategori->nama_kategori }}
                                    </span>
                                    @endif
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="font-weight-bold book-title text-truncate" title="{{ $buku->judul }}">
                                        {{ $buku->judul }}
                                    </h6>
                                    <p class="book-author mb-0 text-truncate">{{ $buku->penulis }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>