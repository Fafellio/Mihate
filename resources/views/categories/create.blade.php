<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #10b981; /* Emerald */
            font-weight: 800;
            letter-spacing: -0.025em;
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
        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            background-color: #0f172a;
            border: 1px solid #475569;
            border-radius: 10px;
            color: #f8fafc;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box; 
        }

        input::placeholder {
            color: #475569;
        }

        input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* ===== BUTTON STYLE ===== */
        button {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            background-color: #10b981;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #059669;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        /* ===== BACK LINK ===== */
        .back {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back i {
            margin-right: 8px;
        }

        .back:hover {
            color: #10b981;
        }
    </style>
</head>
<body>

<div class="card shadow">
    <h2><i class="fas fa-plus-circle mr-2"></i>Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" id="name" name="name" placeholder="Contoh: Teknologi, Fiksi..." required autofocus>
        </div>
        
        <button type="submit">
            <i class="fas fa-save mr-1"></i> Simpan Kategori
        </button>
    </form>

    <a href="{{ route('kategori.index') }}" class="back">
        <i class="fas fa-arrow-left"></i> Kembali ke List
    </a>
</div>

</body>
</html>