<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Pinjaman Buku</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            /* Warna background gelap yang nyaman di mata */
            background-color: #0f172a; 
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* CARD */
        .card {
            border-radius: 24px;
            border: 1px solid #1e293b;
            background-color: #1e293b; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        /* LEFT PANEL */
        .login-left {
            background: linear-gradient(160deg, #059669, #064e3b);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Pola dekoratif halus */
        .login-left::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        .login-left-content {
            text-align: center;
            z-index: 1;
        }

        .login-left h2 {
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 1.5rem;
        }

        .login-left i {
            font-size: 100px;
            margin-top: 20px;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));
        }

        /* RIGHT PANEL (FORM AREA) */
        .p-5 {
            background-color: #1e293b;
        }

        h1.h4 {
            color: #f8fafc; /* Putih keabu-abuan */
            font-weight: 700;
        }

        /* FORM INPUT */
        .form-control {
            background-color: #334155; 
            border: 1px solid #475569;
            border-radius: 12px;
            color: #f8fafc;
            height: 48px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #334155;
            border-color: #10b981;
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.2);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        /* BUTTON */
        .btn-primary {
            background-color: #10b981;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            height: 48px;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
        }

        /* HORIZONTAL LINE */
        hr {
            border-top: 1px solid #334155;
        }

        /* LINK */
        a.small {
            color: #10b981;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 600;
        }

        a.small:hover {
            color: #34d399;
            text-decoration: underline;
        }

        .container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* WRAPPER UNTUK TOGGLE PASSWORD */
.password-field {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #94a3b8; /* Senada dengan placeholder */
    z-index: 10;
    transition: color 0.3s;
}

.toggle-password:hover {
    color: #10b981; /* Berubah hijau saat dihover */
}

/* Pastikan teks tidak tertutup ikon */
.form-control-password {
    padding-right: 45px !important;
}
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card my-5">
                <div class="card-body p-0">
                    <div class="row">

                        <div class="col-lg-6 d-none d-lg-flex login-left">
                            <div class="login-left-content">
                                <h2>Bergabunglah</h2>
                                <i class="fas fa-book-open"></i>
                                <p class="mt-3 opacity-75">Mulai petualangan literasimu di sini.</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 mb-4">Buat Akun Baru</h1>
                                </div>

                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" name="name"
                                               class="form-control"
                                               placeholder="Nama Lengkap" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email"
                                               class="form-control"
                                               placeholder="Alamat Email" required>
                                    </div>

                                    <div class="form-row mb-3">
    <div class="col-sm-6 mb-3 mb-sm-0 password-field">
        <input type="password" name="password" id="password"
               class="form-control form-control-password"
               placeholder="Password" required>
        <i class="fas fa-eye toggle-password" onclick="togglePass('password', this)"></i>
    </div>
    <div class="col-sm-6 password-field">
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="form-control form-control-password"
               placeholder="Ulangi Password" required>
        <i class="fas fa-eye toggle-password" onclick="togglePass('password_confirmation', this)"></i>
    </div>
</div>

                                    <button type="submit" class="btn btn-primary btn-block">
                                        Daftar Sekarang
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        Sudah punya akun? Masuk di sini
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
function togglePass(id, el) {
    const passwordInput = document.getElementById(id);
    
    // Toggle tipe input
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        el.classList.remove('fa-eye');
        el.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        el.classList.remove('fa-eye-slash');
        el.classList.add('fa-eye');
    }
}
</script>
</body>
</html>