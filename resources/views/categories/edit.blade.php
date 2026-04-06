<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== GLOBAL DARK THEME ===== */
        body {
            background-color: #0f172a; /* Slate 900 */
            color: #f8fafc;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* ===== CARD STYLE ===== */
        .card {
            background-color: #1e293b; /* Slate 800 */
            border: 1px solid #334155;
            border-radius: 16px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .card-header {
            background-color: rgba(16, 185, 129, 0.1);
            border-bottom: 1px solid #334155;
            color: #10b981; /* Emerald */
            font-weight: 800;
            text-align: center;
            padding: 20px;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 30px;
        }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        /* ===== INPUT STYLE ===== */
        .form-control {
            background-color: #0f172a !important;
            border: 1px solid #475569 !important;
            border-radius: 10px;
            color: #f8fafc !important;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        }

        /* ===== BUTTON STYLE ===== */
        .btn-emerald {
            background-color: #10b981;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-emerald:hover {
            background-color: #059669;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
            color: #ffffff;
        }

        .btn-outline-custom {
            background-color: transparent;
            border: 1px solid #334155;
            border-radius: 10px;
            color: #94a3b8;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            border-color: #475569;
            color: #f8fafc;
            background-color: rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <i class="fas fa-edit me-2"></i>Edit Kategori
    </div>

    <div class="card-body">
        <form action="{{ route('kategori.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required autofocus>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-custom flex-grow-1 flex-md-grow-0">
                    Batal
                </a>
                <button type="submit" class="btn btn-emerald px-4 flex-grow-1 flex-md-grow-0">
                    <i class="fas fa-save me-1"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>