<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Users - Pinjaman Buku</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Membuat list pilihan di dalam select jadi gelap */
        select option {
            background-color: #1e293b;
            /* Warna gelap sesuai modal */
            color: #f8fafc;
            /* Warna teks putih/terang */
        }

        /* Memastikan dropdown (select) punya warna yang benar */
        select.form-control {
            background-color: #334155 !important;
            color: white !important;
        }

        /* ===== GLOBAL DARK THEME ===== */
        body,
        #page-top,
        #wrapper,
        #content-wrapper {
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

        .sidebar .nav-link {
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .sidebar .nav-item.active .nav-link {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: #10b981 !important;
        }

        .sidebar-brand {
            color: #10b981 !important;
        }

        /* ===== CARD & TABLE ===== */
        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
        }

        .card-header {
            background-color: #1e293b;
            border-bottom: 1px solid #334155;
            color: #10b981;
        }

        .table {
            color: #f8fafc;
        }

        .table thead th {
            background-color: #0f172a;
            color: #10b981;
            border: none;
        }

        .table td {
            border-top: 1px solid #334155;
            vertical-align: middle !important;
        }

        /* ===== BUTTONS & BADGES ===== */
        .btn-emerald {
            background-color: #10b981;
            color: white !important;
            border: none;
            font-weight: 700;
        }

        .btn-emerald:hover {
            background-color: #059669;
        }

        .badge-admin {
            background-color: #ef4444;
            color: white;
        }

        .badge-pegawai {
            background-color: #3b82f6;
            color: white;
        }

        .badge-user {
            background-color: #64748b;
            color: white;
        }

        /* ===== MODAL DARK STYLE ===== */
        .modal-content {
            background-color: #1e293b;
            color: #f8fafc;
            border: 1px solid #334155;
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: 1px solid #334155;
        }

        .modal-footer {
            border-top: 1px solid #334155;
        }

        .form-control {
            background-color: #334155;
            border: 1px solid #475569;
            color: white !important;
        }

        .close {
            color: white;
            opacity: 0.5;
        }

        .close:hover {
            color: white;
            opacity: 1;
        }

        .pagination .page-link {
            background-color: #1e293b;
            border-color: #334155;
            color: #10b981;
        }

        .pagination .page-item.active .page-link {
            background-color: #10b981;
            border-color: #10b981;
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
                <div class="pt-4"></div>
                <div class="container-fluid">
                    <div class="mb-4">
                        <h1 class="h3 mb-0 font-weight-bold text-white">Manajemen Users</h1>
                        <p class="text-muted">Kelola hak akses dan informasi pengguna aplikasi.</p>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users mr-2"></i>Daftar Pengguna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="font-weight-bold">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role_id == 1)
                                                <span class="badge badge-admin px-3 py-2">Admin</span>
                                                @elseif($user->role_id == 3)
                                                <span class="badge badge-pegawai px-3 py-2">Pegawai</span>
                                                @else
                                                <span class="badge badge-user px-3 py-2">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-warning btn-sm mr-2 shadow-sm" data-toggle="modal" data-target="#editUser{{ $user->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-toggle="modal" data-target="#deleteUser{{ $user->id }}" {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </div>

                                                <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content shadow-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold text-primary">Edit Profil User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close text-white">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <div class="modal-body text-left">
                                                                    <div class="form-group">
                                                                        <label class="small font-weight-bold text-muted">NAMA LENGKAP</label>
                                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="small font-weight-bold text-muted">ROLE AKSES</label>
                                                                        <select name="role_id" class="form-control">
                                                                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                                                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Pegawai</option>
                                                                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-emerald px-4">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content border-left-danger shadow-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold text-danger">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center py-4">
                                                                <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                                                                <p class="mb-0">Apakah Anda yakin ingin menghapus user <strong>{{ $user->name }}</strong>?</p>
                                                                <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Batal</button>
                                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger px-4 shadow-sm">Ya, Hapus User</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>