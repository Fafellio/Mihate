<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori | Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css">

    <style>
        /* Tambahkan ini di dalam <style> kamu agar pop-up SweetAlert ikutan Dark Mode */
        .swal2-popup {
            background-color: #1e293b !important;
            /* Slate 800 */
            color: #f8fafc !important;
            border: 1px solid #334155;
        }

        /* ===== GLOBAL DARK THEME ===== */
        body,
        #wrapper,
        #content-wrapper,
        #content {
            background-color: #0f172a !important;
            /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== SIDEBAR CUSTOM ===== */
        .sidebar {
            background-color: #1e293b !important;
            /* Slate 800 */
            background-image: none !important;
            border-right: 1px solid #334155;
        }

        .sidebar .nav-item .nav-link {
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .sidebar .nav-item.active .nav-link,
        .sidebar .nav-item .nav-link:hover {
            color: #10b981 !important;
            /* Emerald */
        }

        .sidebar .nav-item.active {
            background-color: rgba(16, 185, 129, 0.05);
            border-right: 3px solid #10b981;
        }

        .sidebar-divider {
            border-top: 1px solid #334155;
        }

        .sidebar-heading {
            color: #475569 !important;
        }

        /* ===== CARD & TABLE ===== */
        .card {
            background-color: #1e293b;
            /* Slate 800 */
            border: 1px solid #334155;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .h3 {
            color: #10b981;
            font-weight: 800;
        }

        .table {
            color: #f8fafc;
        }

        .table-bordered {
            border: 1px solid #334155;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #334155;
        }

        .table thead th {
            background-color: #0f172a;
            color: #10b981;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background-color: #10b981 !important;
            border: none !important;
            font-weight: 700;
        }

        .btn-primary:hover {
            background-color: #059669 !important;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.3);
        }

        .btn-warning {
            background-color: #f59e0b;
            border: none;
            color: #0f172a;
        }

        .btn-warning:hover {
            background-color: #fbbf24;
            color: #0f172a;
        }

        .btn-danger {
            background-color: #ef4444;
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* Logout button khusus */
        .btn-logout {
            background-color: transparent;
            color: #ef4444 !important;
            border: 1px solid #ef4444;
            transition: 0.3s;
            margin: 10px;
            border-radius: 8px;
        }

        .btn-logout:hover {
            background-color: #ef4444;
            color: white !important;
        }

        .text-muted {
            color: #64748b !important;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader text-emerald-500" style="color: #10b981;"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
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
                    <i class="fas fa-fw fa-comment-alt"></i>
                    <span>Laporan Buku</span>
                </a>
            </li>
            @endif
            <hr class="sidebar-divider">
            @endif

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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-emerald-500"><i class="fas fa-tags mr-2"></i>Kategori Buku</h1>
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm mr-1"></i> Tambah Kategori
                        </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="8%">No</th>
                                            <th>Nama Kategori</th>
                                            <th class="text-center" width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $index => $category)
                                        <tr>
                                            <td class="text-center font-weight-bold" style="color: #94a3b8;">{{ $index + 1 }}</td>
                                            <td class="font-weight-bold">{{ $category->name }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('kategori.edit', $category->id) }}"
                                                        class="btn btn-warning btn-sm mr-2" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                                Belum ada data kategori.
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Menangkap klik pada tombol dengan class btn-delete
            $('.btn-delete').on('click', function(e) {
                let form = $(this).closest('form'); // Ambil form terdekat dari tombol yang diklik

                Swal.fire({
                    title: 'Hapus Kategori?',
                    text: "Data ini akan hilang permanen lho!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', // Warna merah (Emerald-Red)
                    cancelButtonColor: '#475569', // Warna slate
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#1e293b', // Background Dark
                    color: '#f8fafc' // Warna Teks Putih
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Jika klik "Ya", form baru dikirim
                    }
                });
            });
        });
    </script>
</body>

</html>