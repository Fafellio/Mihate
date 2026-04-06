<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku | Admin</title>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        /* ===== GLOBAL DARK THEME (Slate & Emerald) ===== */
        body { 
            background-color: #0f172a; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }

        h3 { color: #10b981; font-weight: 800; } /* Emerald */
        label { font-weight: 600; color: #94a3b8; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }

        /* ===== CARD STYLE ===== */
        .form-card {
            background-color: #1e293b; /* Slate 800 */
            border-radius: 15px;
            padding: 30px;
            border: 1px solid #334155;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* ===== INPUT STYLE ===== */
        .form-control {
            background-color: #0f172a !important;
            border: 1px solid #475569 !important;
            color: #f8fafc !important;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.15);
        }

        select.form-control option {
            background-color: #1e293b;
            color: white;
        }

        /* ===== BUTTONS ===== */
        .btn-emerald { 
            background-color: #10b981; 
            border: none; 
            color: white; 
            font-weight: 700; 
            transition: 0.3s;
        }
        .btn-emerald:hover { 
            background-color: #059669; 
            color: white; 
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.3);
        }

        .btn-outline-custom {
            border: 1px solid #334155;
            color: #94a3b8;
            font-weight: 600;
        }
        .btn-outline-custom:hover {
            border-color: #10b981;
            color: #10b981;
        }

        /* ===== PREVIEW BOX ===== */
        .preview-box {
            margin-top: 10px;
            border: 2px dashed #334155;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            background: #0f172a;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .img-preview { 
            max-width: 100%; 
            max-height: 250px; 
            border-radius: 8px; 
            display: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        
        .video-preview { 
            width: 100%; 
            max-height: 250px; 
            border-radius: 8px; 
            display: none;
        }

        hr { border-top: 1px solid #334155; }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="fas fa-plus-circle mr-2"></i>Tambah Koleksi Buku</h3>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-custom">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="form-card">
            {{-- Alert --}}
            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-triangle mr-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul lengkap" required value="{{ old('judul') }}">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Penulis</label>
                        <input type="text" name="penulis" class="form-control" placeholder="Nama penulis" required value="{{ old('penulis') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit" value="{{ old('penerbit') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kategori Buku</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sinopsis</label>
                    <textarea name="sinopsis" class="form-control" rows="4" placeholder="Tuliskan ringkasan buku...">{{ old('sinopsis') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Tahun Terbit</label>
                        <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2024" value="{{ old('tahun') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Stok Tersedia</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" min="0">
                    </div>
                </div>

                <hr class="my-4">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><i class="fas fa-image mr-1"></i> Cover Buku</label>
                        <input type="file" name="cover" class="form-control-file text-slate-400 mb-2" accept=".jpg,.jpeg,.png" onchange="previewImage(event)">
                        <small class="text-muted d-block mb-2">Format: JPG/PNG (Maks 2MB)</small>
                        <div class="preview-box">
                            <img id="imageDisplay" class="img-preview" src="#">
                            <span id="imgPlaceholder" class="text-muted small">
                                <i class="fas fa-cloud-upload-alt d-block fa-2x mb-2"></i>
                                Belum ada file dipilih
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label><i class="fas fa-video mr-1"></i> Video Promosi</label>
                        <input type="file" name="video" id="videoInput" class="form-control-file text-slate-400 mb-2" accept="video/mp4,video/x-m4v,video/*" onchange="previewVideo(event)">
                        <small class="text-muted d-block mb-2">Format: MP4 (Maks 2MB)</small>
                        <div class="preview-box">
                            <video id="videoDisplay" class="video-preview" controls></video>
                            <span id="videoPlaceholder" class="text-muted small">
                                <i class="fas fa-video-slash d-block fa-2x mb-2"></i>
                                Belum ada file dipilih
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-top pt-4 text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-custom px-4 mr-2">Batal</a>
                    <button type="submit" class="btn btn-emerald px-5 shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Data Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const display = document.getElementById('imageDisplay');
            const placeholder = document.getElementById('imgPlaceholder');
            const file = event.target.files[0];

            if (file) {
                display.src = URL.createObjectURL(file);
                display.style.display = 'block';
                placeholder.style.display = 'none';
            }
        }

        function previewVideo(event) {
            const display = document.getElementById('videoDisplay');
            const placeholder = document.getElementById('videoPlaceholder');
            const file = event.target.files[0];

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("Gagal: Ukuran video melebihi 2MB!");
                    event.target.value = "";
                    display.style.display = 'none';
                    placeholder.style.display = 'block';
                    return;
                }

                display.src = URL.createObjectURL(file);
                display.style.display = 'block';
                placeholder.style.display = 'none';
                display.load();
            }
        }
    </script>

</body>
</html>