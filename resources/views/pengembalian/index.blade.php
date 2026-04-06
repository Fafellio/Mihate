<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - Daftar Pengembalian</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0f172a;
        }

        .sidebar {
            background-color: #1e293b !important;
            min-height: 100vh;
        }

        #content-wrapper {
            background-color: #0f172a !important;
        }

        .topbar {
            background-color: #1e293b !important;
            border: none !important;
        }

        .card {
            background-color: #1e293b !important;
            border: none;
            color: white;
        }

        .card-header {
            background-color: #334155 !important;
            border-bottom: 1px solid #475569 !important;
        }

        .table {
            color: #e2e8f0 !important;
        }

        .table-bordered {
            border: 1px solid #475569 !important;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #475569 !important;
        }

        .bg-light {
            background-color: #334155 !important;
            color: white !important;
        }

        .btn-logout-custom {
            color: #cbd5e1;
            background: transparent;
            border: none;
            padding: 10px 15px;
            width: 100%;
            text-align: left;
            transition: 0.3s;
        }

        .btn-logout-custom:hover {
            color: #fff;
            background: #ef4444;
            border-radius: 5px;
        }

        .sticky-footer {
            background-color: #1e293b !important;
            color: #94a3b8 !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon"><i class="fas fa-book-reader"></i></div>
                <div class="sidebar-brand-text mx-3">E-Library</div>
            </a>
            <hr class="sidebar-divider my-0" style="border-top: 1px solid #334155;">

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

            <hr class="sidebar-divider" style="border-top: 1px solid #334155;">

            @if(in_array(auth()->user()->role_id, [1, 3]))
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
            <li class="nav-item {{ request()->routeIs('pengembalian.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengembalian.index') }}">
                    <i class="fas fa-fw fa-undo-alt"></i><span>Daftar Pengembalian</span>
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
            <hr class="sidebar-divider" style="border-top: 1px solid #334155;">
            @endif

            <li class="nav-item">
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
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h1 class="h4 mb-0 text-white font-weight-bold ml-3">Manajemen Pengembalian Buku</h1>
                </nav>

                <div class="container-fluid">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #10b981; color: white;">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-history mr-2"></i>Riwayat Buku Kembali
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Peminjam</th>
                                            <th>Judul Buku</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pengembalian as $item)
                                        <tr>
                                            <td class="font-weight-bold">{{ $item->user->name ?? 'User Tidak Ditemukan' }}</td>
                                            <td>{{ $item->buku->judul ?? 'Buku Terhapus' }}</td>
                                            {{-- Baris yang benar sesuai Model Anda --}}
                                            <td>{{ $item->tgl_pinjam ? \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') : '-' }}</td>
                                            <td>{{ $item->tgl_kembali ? \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') : '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success px-3 py-2 shadow-sm" style="background-color: #10b981;">
                                                    <i class="fas fa-check-circle mr-1"></i> {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-5">
                                                <i class="fas fa-info-circle fa-2x mb-3"></i><br>
                                                Belum ada riwayat pengembalian buku.
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

            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; E-Library 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare