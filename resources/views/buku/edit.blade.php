<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku | Admin</title>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        /* ===== GLOBAL DARK THEME ===== */
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
        .btn-warning { 
            background-color: #f59e0b; 
            border: none; 
            color: #0f172a; 
            font-weight: 700; 
            transition: 0.3s;
        }
        .btn-warning:hover { 
            background-color: #fbbf24; 
            color: #0f172a; 
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
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
        }

        .img-preview { 
            max-width: 100%; 
            max-height: 250px; 
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        
        .video-preview { 
            width: 100%; 
            max-height: 250px; 
            border-radius: 8px; 
        }

        hr { border-top: 1px solid #334155; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-edit mr-2"></i>Edit Data Buku</h3>
        <a href="{{ route('buku.list') }}" class="btn btn-sm btn-outline-custom">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="form-card">
        @if ($errors->any())
            <div class="alert alert-danger border-0" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}" required placeholder="Masukkan judul buku">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Kategori Buku</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $buku->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" class="form-control" rows="4" placeholder="Tulis ringkasan cerita...">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $buku->tahun) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}" min="0">
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><i class="fas fa-image mr-1"></i> Cover Buku</label>
                    <input type="file" name="cover" class="form-control-file text-slate-400 mb-2" accept=".jpg,.jpeg,.png" onchange="previewImage(event)">
                    <div class="preview-box">
                        <img id="imageDisplay" class="img-preview" 
                             src="{{ $buku->cover ? asset('storage/' . $buku->cover) : '#' }}" 
                             style="{{ $buku->cover ? '' : 'display:none;' }}">
                        <p id="imgPlaceholder" class="text-muted small mb-0" style="{{ $buku->cover ? 'display:none;' : '' }}">
                            <i class="fas fa-cloud-upload-alt d-block fa-2x mb-2"></i>
                            Belum ada cover
                        </p>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label><i class="fas fa-video mr-1"></i> Video Promosi</label>
                    <input type="file" name="video" class="form-control-file text-slate-400 mb-2" accept="video/mp4,video/*" onchange="previewVideo(event)">
                    <div class="preview-box">
                        <video id="videoDisplay" class="video-preview" controls 
                               src="{{ $buku->video ? asset('storage/' . $buku->video) : '' }}"
                               style="{{ $buku->video ? '' : 'display:none;' }}"></video>
                        <p id="videoPlaceholder" class="text-muted small mb-0" style="{{ $buku->video ? 'display:none;' : '' }}">
                            <i class="fas fa-video-slash d-block fa-2x mb-2"></i>
                            Belum ada video promosi
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 border-top pt-4 text-right">
                <a href="{{ route('buku.list') }}" class="btn btn-outline-custom px-4 mr-2">Batal</a>
                <button type="submit" class="btn btn-warning px-5 shadow-sm">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
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
            display.style.display = 'inline-block';
            placeholder.style.display = 'none';
        }
    }

    function previewVideo(event) {
        const display = document.getElementById('videoDisplay');
        const placeholder = document.getElementById('videoPlaceholder');
        const file = event.target.files[0];
        if (file) {
            if (file.size > 3 * 1024 * 1024) {
                alert("Ukuran video maksimal 3MB!");
                event.target.value = "";
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