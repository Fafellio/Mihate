<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard - E-Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* ===== GLOBAL & LAYOUT (DARK MODE) ===== */
        body, #page-top, #wrapper, #content-wrapper, #content, .container-fluid {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
        }

        /* ===== SIDEBAR SLIM DARK ===== */
        .sidebar {
            width: 240px !important;
            min-width: 240px !important;
            background-color: #1e293b !important; /* Slate 800 */
            background-image: none !important;
            border-right: 1px solid #334155;
        }

        #content-wrapper { width: 100%; min-height: 100vh; display: flex; flex-direction: column; }

        .sidebar .nav-link { color: #94a3b8 !important; font-weight: 500; }
        .sidebar .nav-link:hover { color: #10b981 !important; }
        
        .sidebar .nav-item.active .nav-link {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 100%) !important;
            color: #10b981 !important;
            border-left: 4px solid #10b981;
        }

        .sidebar-brand { color: #f8fafc !important; }
        .sidebar-heading { color: #475569 !important; }

        /* ===== DASHBOARD BANNER ===== */
        .welcome-banner {
            background: linear-gradient(160deg, #10b981, #064e3b);
            border-radius: 20px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::after {
            content: "";
            position: absolute;
            width: 100%; height: 100%; top:0; left:0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        /* ===== CARD STYLE (Match Login/Register) ===== */
        .card {
            background-color: #1e293b !important;
            border: 1px solid #334155 !important;
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid #334155 !important;
            color: #10b981 !important;
        }

        .card-book {
            transition: all 0.3s ease;
        }

        .card-book:hover {
            transform: translateY(-8px);
            border-color: #10b981 !important;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
        }

        .book-img-container {
            height: 250px;
            overflow: hidden;
            background-color: #0f172a;
        }

        .book-img-container img { width: 100%; height: 100%; object-fit: cover; }

        /* ===== TEXT & STATS ===== */
        .text-dark { color: #f8fafc !important; }
        .text-muted { color: #94a3b8 !important; }
        .border-left-primary { border-left: 4px solid #10b981 !important; }
        .border-left-success { border-left: 4px solid #34d399 !important; }
        .border-left-warning { border-left: 4px solid #fbbf24 !important; }

        .table { color: #f8fafc; }
        .table border-bottom { border-color: #334155 !important; }

        .footer { background-color: #0f172a !important; color: #475569; border-top: 1px solid #334155; }

        .btn-logout-custom {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 10px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-logout-custom:hover { background-color: #b91c1c; color: white; }
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
                <div class="container-fluid pt-4">
                    @if(auth()->user()->role_id == 1)
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 font-weight-bold text-white">Admin Analytics</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card border-left-primary shadow-sm h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Buku</div>
                                        <div class="h4 mb-0 font-weight-bold text-white">{{ $stats['total_buku'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card border-left-success shadow-sm h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Peminjam</div>
                                        <div class="h4 mb-0 font-weight-bold text-white">{{ $stats['total_user'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card border-left-warning shadow-sm h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Antrean Pending</div>
                                        <div class="h4 mb-0 font-weight-bold text-white">{{ $stats['antrean'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header py-3 font-weight-bold">Grafik Peminjaman Mingguan</div>
                                    <div class="card-body">
                                        <div style="min-height: 300px;"><canvas id="myAreaChart"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header py-3 font-weight-bold">Antrean Terbaru</div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-sm m-0">
                                                <tbody class="small">
                                                    @forelse($antrean_terbaru as $a)
                                                    <tr>
                                                        <td class="pl-3 py-3 border-bottom border-dark">
                                                            <span class="font-weight-bold text-white">{{ $a->user->name }}</span><br>
                                                            <span class="text-muted">{{ Str::limit($a->buku->judul, 30) }}</span>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr><td class="text-center py-4 text-muted">Belum ada antrean</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="welcome-banner shadow-sm">
                            <div style="z-index: 1;">
                                <h2 class="font-weight-bold">Halo, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0 opacity-75">Cari dan pinjam buku favoritmu dengan mudah.</p>
                            </div>
                            <i class="fas fa-book-open fa-4x opacity-25 d-none d-md-block" style="z-index: 1;"></i>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-weight-bold mb-0 text-white">🔥 Eksplor Buku Terbaru</h5>
                            <a href="{{ route('buku.index') }}" class="btn btn-sm text-success font-weight-bold">Lihat Semua</a>
                        </div>

                        <div class="row">
                            @foreach($bukus as $b)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                                <div class="card card-book shadow-sm h-100">
                                    <div class="book-img-container">
                                        <a href="{{ route('buku.show', $b->id) }}">
                                            <img src="/storage/{{ $b->cover }}" onerror="this.src='https://via.placeholder.com/200x300?text=No+Cover'">
                                        </a>
                                        <span class="badge badge-success position-absolute shadow" style="top:10px; right:10px; font-size: 10px; background-color: #10b981;">
                                            {{ $b->kategori->nama_kategori ?? 'Umum' }}
                                        </span>
                                    </div>
                                    <div class="card-body p-3">
                                        <h6 class="font-weight-bold text-white text-truncate mb-1">{{ $b->judul }}</h6>
                                        <p class="text-muted small mb-0">{{ $b->penulis }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <footer class="sticky-footer footer mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <strong>Fafellio Gienola</strong>, 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labelGrafik = <?php echo json_encode($grafik['labels'] ?? []); ?>;
        const dataGrafik = <?php echo json_encode($grafik['data'] ?? []); ?>;
        const ctx = document.getElementById('myAreaChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labelGrafik,
                    datasets: [{
                        label: 'Peminjaman',
                        data: dataGrafik,
                        fill: true,
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: '#10b981',
                        tension: 0.4,
                        pointBackgroundColor: '#10b981',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { 
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#334155' },
                            ticks: { color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>