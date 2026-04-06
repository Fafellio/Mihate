<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Pinjaman Buku</title>

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
    body {
        background-color: #0f172a; 
        font-family: 'Nunito', sans-serif;
        display: flex;
        align-items: center;
        height: 100vh;
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
        color: #f8fafc;
        font-weight: 700;
    }

    /* FORM INPUT */
    .form-control {
        background-color: #334155; 
        border: 1px solid #475569;
        border-radius: 12px;
        color: #f8fafc;
        height: 50px;
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

    /* TOGGLE EYE CSS */
    .password-field {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #94a3b8;
        z-index: 10;
    }

    .toggle-password:hover {
        color: #10b981;
    }

    /* BUTTON */
    .btn-primary {
        background-color: #10b981;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        height: 50px;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
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

    /* Custom Style untuk SweetAlert Dark */
    .swal2-popup {
        background-color: #1e293b !important;
        color: #f8fafc !important;
        border-radius: 20px !important;
    }
    .swal2-title, .swal2-html-container {
        color: #f8fafc !important;
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
                                <h2>Pinjaman Buku</h2>
                                <i class="fas fa-book"></i>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 mb-4">Login</h1>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email"
                                               name="email"
                                               class="form-control"
                                               placeholder="Email"
                                               value="{{ old('email') }}"
                                               required autofocus>
                                    </div>

                                    <div class="form-group password-field">
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="form-control"
                                               placeholder="Password"
                                               required>
                                        <i class="fas fa-eye toggle-password" onclick="togglePass()"></i>
                                    </div>

                                    <button type="submit"
                                            class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </form>

                                <div class="text-center mt-3">
                                    <a class="small" href="{{ route('register') }}">
                                        Belum punya akun? Buat Akun Baru
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

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Fungsi Toggle Password
function togglePass() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.querySelector(".toggle-password");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

// Logika Pop-up Error Laravel
@if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: 'Email atau password salah!',
        confirmButtonColor: '#10b981',
        background: '#1e293b',
        color: '#f8fafc'
    });
@endif

// Logika Pop-up Success (Jika ada session success)
@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        confirmButtonColor: '#10b981'
    });
@endif
</script>

</body>
</html>