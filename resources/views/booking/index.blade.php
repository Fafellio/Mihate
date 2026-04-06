<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark Saya | Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ===== GLOBAL DARK THEME ===== */
        body, #wrapper, #content-wrapper, #content {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        .topbar { background-color: #1e293b !important; border-bottom: 1px solid #334155; }

        /* ===== SIDEBAR CUSTOM ===== */
        .sidebar {
            background-color: #1e293b !important;
            background-image: none !important;
            border-right: 1px solid #334155;
        }
        .sidebar .nav-item .nav-link { color: #94a3b8 !important; font-weight: 600; }
        .sidebar .nav-item.active .nav-link, .sidebar .nav-item .nav-link:hover { color: #10b981 !important; }
        .sidebar .nav-item.active { background-color: rgba(16, 185, 129, 0.05); border-right: 3px solid #10b981; }
        .sidebar-divider { border-top: 1px solid #334155; }

        /* ===== CARD BOOK STYLE ===== */
        .card-book {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-book:hover {
            transform: translateY(-8px);
            border-color: #10b981;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
        }

        .img-container {
            height: 250px;
            overflow: hidden;
            position: relative;
            background-color: #0f172a;
        }
        .img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .card-book:hover .img-container img { transform: scale(1.1); }

        .bookmark-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #10b981;
            color: white;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        /* ===== TEXT & BUTTONS ===== */
        .h3 { color: #10b981; font-weight: 800; }
        .text-dark-custom { color: #f8fafc !important; }
        
        .btn-primary { background-color: #10b981 !important; border: none !important; font-weight: 700; border-radius: 8px; }
        .btn-primary:hover { background-color: #059669 !important; transform: translateY(-1px); }
        
        .btn-outline-emerald {
            border: 1px solid #10b981;
            color: #10b981;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-outline-emerald:hover { background: #10b981; color: white; }

        .btn-logout {
            background-color: transparent;
            color: #ef4444 !important;
            border: 1px solid #ef4444;
            margin: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-logout:hover { background-color: #ef4444; color: white !important; }

        /* SweetAlert Dark */
        .swal2-popup { background-color: #1e293b !important; color: #f8fafc !important; border: 1px solid #334155; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon"><i class="fas fa-book-reader" style="color: #10b981;"></i></div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>
            <hr class="sidebar-divider my-0">

             <li class="nav-item {{ request()->routeIs('pageDashboard') ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('pageDashboard') }}">

                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>

                </a>

            </li>

            <li class="nav-item {{ request()->routeIs('buku.index') ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('buku.index') }}">

                    <i class="fas fa-fw fa-book"></i><span>Buku</span>

                </a>

            </li>

            <li class="nav-item {{ request()->routeIs('booking.index') ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('booking.index') }}">

                    <i class="fas fa-fw fa-bookmark"></i><span>Bookmark Saya</span>

                </a>

            </li>

            <li class="nav-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('peminjaman.index') }}">

                    <i class="fas fa-fw fa-history"></i><span>Peminjaman Saya</span>

                </a>

            </li>



            @if(in_array(auth()->user()->role_id, [1, 3]))

                <hr class="sidebar-divider">

                <div class="sidebar-heading">Manajemen Data</div>

                <li class="nav-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}">

                    <a class="nav-link" href="{{ route('kategori.index') }}">

                        <i class="fas fa-fw fa-tags"></i><span>Kategori</span>

                    </a>

                </li>

                <li class="nav-item {{ request()->routeIs('buku.list') ? 'active' : '' }}">

                    <a class="nav-link" href="{{ route('buku.list') }}">

                        <i class="fas fa-fw fa-boxes"></i><span>Manajemen Buku</span>

                    </a>

                </li>

                <li class="nav-item {{ request()->routeIs('peminjaman.petugas') ? 'active' : '' }}">

                    <a class="nav-link" href="{{ route('peminjaman.petugas') }}">

                        <i class="fas fa-fw fa-clipboard-check"></i><span>Konfirmasi Antrean</span>

                    </a>

                </li>

                

                @if(auth()->user()->role_id == 1)

                    <div class="sidebar-heading">Admin Panel</div>

                    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">

                        <a class="nav-link" href="{{ route('users.index') }}">

                            <i class="fas fa-fw fa-users"></i><span>Manajemen Users</span>

                        </a>

                    </li>

                    <li class="nav-item {{ Request::is('laporan-buku*') ? 'active' : '' }}">

                        <a class="nav-link" href="{{ route('laporan.index') }}">

                            <i class="fas fa-fw fa-comment-alt"></i><span>Laporan Buku</span>

                        </a>

                    </li>

                @endif

            @endif



            <hr class="sidebar-divider">

            <li class="nav-item">

                <form action="{{ route('logout') }}" method="POST" id="logout-form">

                    @csrf

                    <button type="submit" class="btn btn-danger btn-block text-left" style="border-radius:0; border:none;">

                        <i class="fas fa-sign-out-alt mr-2"></i> Logout

                    </button>

                </form>

            </li>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top"></nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0"><i class="fas fa-heart mr-2"></i>Koleksi Bookmark</h1>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-emerald px-3">
                            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        @forelse($bookings as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card card-book shadow-sm h-100">
                                <div class="img-container">
                                    <a href="{{ route('buku.show', $item->buku_id) }}">
                                        @if($item->buku->cover)
                                            <img src="/storage/{{ $item->buku->cover }}" alt="Cover">
                                        @else
                                            <img src="{{ asset('img/no-cover.png') }}" alt="No Cover">
                                        @endif
                                    </a>
                                    <div class="bookmark-badge">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                                
                                <div class="card-body text-center p-4 d-flex flex-column">
                                    <h6 class="font-weight-bold text-dark-custom mb-1">{{ $item->buku->judul }}</h6>
                                    <p class="text-muted small mb-4">{{ $item->buku->penulis }}</p>

                                    <div class="mt-auto">
                                        <a href="{{ route('buku.show', $item->buku_id) }}" class="btn btn-primary btn-block mb-3">
                                            Lihat Detail
                                        </a>
                                        <form action="{{ route('booking.destroy', $item->id) }}" method="POST" class="delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-link btn-sm text-danger btn-delete-bookmark p-0" style="text-decoration:none;">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus Bookmark
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-bookmark fa-4x text-gray-700 mb-4 d-block"></i>
                            <h5 class="text-muted">Belum ada buku yang kamu simpan.</h5>
                            <a href="{{ route('buku.index') }}" class="btn btn-primary mt-3">Jelajahi Buku</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.btn-delete-bookmark').on('click', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Bookmark?',
                    text: "Buku ini akan dihapus dari koleksi simpananmu.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'Ya, Hapus',
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