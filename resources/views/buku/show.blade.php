<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail Buku - {{ $buku->judul }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">

    <style>
        /* ===== GLOBAL DARK THEME (Sesuai List) ===== */
        body, #page-top, #wrapper, #content-wrapper, #content {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== CARD STYLE ===== */
        .card-main {
            background-color: #1e293b !important; /* Slate 800 */
            border: 1px solid #334155 !important;
            border-radius: 15px;
        }

        .text-emerald { color: #10b981 !important; }
        .text-slate-400 { color: #94a3b8 !important; }

        /* ===== COVER & VIDEO ===== */
        .book-cover-wrapper {
            max-width: 250px; 
            margin: 0 auto;
        }

        .img-book {
            border-radius: 10px;
            border: 1px solid #475569;
            max-height: 350px; 
            width: 100%;
            object-fit: cover;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        .video-wrapper {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #334155;
            background: #000;
            margin-bottom: 25px;
            max-width: 250px;
        }

        /* ===== RATING BINTANG ===== */
        .rating-box {
            background-color: #0f172a;
            border: 1px solid #334155;
            padding: 10px;
            border-radius: 10px;
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-input input { display: none; }
        .rating-input label {
            cursor: pointer;
            font-size: 24px;
            color: #334155;
            margin-right: 5px;
            transition: 0.2s;
        }

        .rating-input input:checked~label,
        .rating-input label:hover,
        .rating-input label:hover~label {
            color: #facc15;
        }

        /* ===== COMMENT BOX ===== */
        .comment-box {
            background-color: #0f172a;
            border-radius: 12px;
            border: 1px solid #334155;
        }

        .review-card {
            background-color: #1e293b !important;
            border: 1px solid #334155 !important;
        }

        .form-control-dark {
            background-color: #0f172a !important;
            border: 1px solid #475569 !important;
            color: white !important;
        }

        /* ===== BUTTONS ===== */
        .btn-emerald {
            background-color: #10b981;
            color: white;
            border: none;
            font-weight: 700;
        }
        .btn-emerald:hover { background-color: #059669; color: white; box-shadow: 0 0 15px rgba(16, 185, 129, 0.4); }

        .btn-outline-custom {
            border: 1px solid #334155;
            color: #94a3b8;
            transition: 0.3s;
        }
        .btn-outline-custom:hover { border-color: #10b981; color: #10b981; }
    </style>
</head>

<body id="page-top">
    <div class="container py-5">
        <div class="card card-main p-4 p-md-5 shadow-lg">
            <div class="row align-items-start">
                
                <div class="col-md-4 col-lg-3 text-center mb-4 mb-md-0">
                    <div class="book-cover-wrapper">
                        @php
                            $pathCover = 'img/no-cover.png';
                            if ($buku->cover) {
                                $cleanPath = str_replace('cover_buku/', '', $buku->cover);
                                $pathCover = 'storage/cover_buku/' . $cleanPath;
                            }
                        @endphp

                        <img src="{{ asset($pathCover) }}" class="img-book mb-3 shadow" alt="Cover" onerror="this.src='{{ asset('img/no-cover.png') }}'">
                        
                        <div class="rating-box">
                            <h5 class="text-warning font-weight-bold mb-0">
                                <i class="fas fa-star"></i> {{ number_format($buku->rata_rata_rating, 1) }}
                            </h5>
                            <small class="text-slate-400">{{ $buku->ulasans->count() }} Ulasan</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <h2 class="font-weight-bold text-white mb-1">{{ $buku->judul }}</h2>
                    
                    <div class="d-flex align-items-center mb-4">
                        <p class="text-slate-400 mb-0 mr-3">Oleh: <span class="text-emerald font-weight-bold">{{ $buku->penulis }}</span></p>
                        @if($buku->category)
                            <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981;">
                                <i class="fas fa-tag mr-1"></i> {{ $buku->category->nama_kategori ?? $buku->category->name }}
                            </span>
                        @endif          
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3">
                            <p class="mb-1 text-slate-400 small uppercase">Penerbit</p>
                            <p class="text-white font-weight-bold mb-0">{{ $buku->penerbit ?? '-' }} ({{ $buku->tahun ?? '-' }})</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1 text-slate-400 small uppercase">Status Stok</p>
                            @if($buku->stok > 0)
                                <span class="badge badge-pill py-2 px-3" style="background-color: #10b981; color: white;">{{ $buku->stok }} Buku Tersedia</span>
                            @else
                                <span class="badge badge-danger badge-pill py-2 px-3">Stok Habis</span>
                            @endif
                        </div>
                    </div>

                    <h5 class="text-emerald font-weight-bold">Sinopsis</h5>
                    <p class="text-slate-400 text-justify mb-4" style="line-height: 1.8;">
                        {{ $buku->sinopsis ?? 'Sinopsis belum tersedia.' }}
                    </p>

                    @if($buku->video)
                        <h5 class="text-emerald mb-3"><i class="fas fa-video mr-2"></i>Video Promosi</h5>
                        <div class="video-wrapper mx-auto mx-md-0">
                            <video width="100%" style="max-height: 350px; object-fit: cover; display: block;" controls controlsList="nodownload">
                                <source src="{{ asset('storage/' . $buku->video) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif

                    <div class="comment-box p-3 mb-4">
                        @if($buku->stok > 0)
                            <div class="d-flex flex-wrap align-items-center">
                                <form action="{{ route('buku.pinjam', $buku->id) }}" method="POST" class="form-inline mr-2 mb-2">
                                    @csrf
                                    <select name="durasi" class="form-control-dark form-control form-control-sm mr-2" required>
                                        @for ($i = 1; $i <= 7; $i++) 
                                            <option value="{{ $i }}">{{ $i }} Hari Pinjam</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-emerald btn-sm py-2 px-3">
                                        <i class="fas fa-book-reader mr-1"></i> Pinjam
                                    </button>
                                </form>

                                <form action="{{ route('booking.store', $buku->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm py-2 px-3 font-weight-bold shadow-sm">
                                        <i class="fas fa-bookmark mr-1"></i> Bookmark
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-secondary py-2 px-3 mb-0 small" style="background: #0f172a; border: 1px solid #334155; color: #94a3b8;">
                                <i class="fas fa-info-circle mr-2"></i>Maaf, stok sedang tidak tersedia.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap mt-4">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-custom mr-2 mb-2">
                            <i class="fas fa-history mr-1"></i> Peminjaman Saya
                        </a>
                        <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-custom mr-2 mb-2">
                            <i class="fas fa-calendar-check mr-1"></i> Booking Saya
                        </a>
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-sm btn-outline-custom mb-2">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <hr style="border-top: 1px solid #334155;" class="my-5">

            <div class="row">
                <div class="col-12">
                    <h4 class="text-emerald mb-4"><i class="fas fa-comments mr-2"></i>Ulasan & Komentar</h4>

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="comment-box p-4 mb-5">
                        <form action="{{ route('ulasan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-white">Beri Rating:</label>
                                <div class="rating-input">
                                    <input type="radio" id="star5" name="rating" value="5" required/><label for="star5" class="fas fa-star"></label>
                                    <input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="fas fa-star"></label>
                                    <input type="radio" id="star3" name="rating" value="3"/><label for="star3" class="fas fa-star"></label>
                                    <input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="fas fa-star"></label>
                                    <input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="fas fa-star"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="ulasan" class="form-control-dark form-control" rows="3" placeholder="Tulis pendapatmu..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-emerald px-4">Kirim Ulasan</button>
                        </form>
                    </div>

                    <div class="review-list">
                        @forelse($buku->ulasans()->orderBy('created_at', 'desc')->get() as $u)
                            <div class="card mb-3 review-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="font-weight-bold mb-1 text-emerald">{{ $u->user->name }}</h6>
                                            <div class="text-warning mb-2" style="font-size: 14px;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa{{ $i <= $u->rating ? 's' : 'r' }} fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-slate-400">{{ $u->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-white mb-0 small">{{ $u->ulasan }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-slate-400 italic">Belum ada ulasan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Cek apakah ada session 'success' dari controller
    @if(session('success'))
        Swal.fire({
            icon: 'success',               // Ikon centang hijau
            title: 'Pesanan Terkirim!',    // Judul pop-up
            text: "{{ session('success') }}", // Mengambil kalimat dari controller kamu
            background: '#1e293b',         // Warna Slate 800 (sesuai tema kamu)
            color: '#f8fafc',              // Warna teks putih tulang
            confirmButtonColor: '#10b981', // Warna tombol Emerald
            iconColor: '#10b981'           // Warna ikon Emerald
        });
    @endif

    // 2. Tambahan: Cek jika ada session 'error' (misal stok tiba-tiba habis)
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Waduh...',
            text: "{{ session('error') }}",
            background: '#1e293b',
            color: '#f8fafc',
            confirmButtonColor: '#ef4444'
        });
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Menangkap session 'success' (Bisa dari Pinjam, Booking, atau Ulasan)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}", // Ini akan otomatis ganti teks sesuai pesan dari Controller
            background: '#1e293b',
            color: '#f8fafc',
            confirmButtonColor: '#10b981',
            iconColor: '#10b981'
        });
    @endif

    // Menangkap session 'error' (Misal: Gagal booking karena sudah penuh)
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Waduh...',
            text: "{{ session('error') }}",
            background: '#1e293b',
            color: '#f8fafc',
            confirmButtonColor: '#ef4444'
        });
    @endif
</script>
</body>

</html>