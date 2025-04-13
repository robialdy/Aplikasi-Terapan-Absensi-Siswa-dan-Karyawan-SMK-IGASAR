<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>



  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/compiled/css/auth.css') }}">
  {{-- alert --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo d-flex align-items-center gap-2">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 55px;">
                <h4 class="mb-0">ABSENSI SMK IGAPIN BDG</h4>
            </div>

            <h1 class="auth-title">Log in.</h1>

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="NISN/NIG" name="nisn_nig">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('nisn')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if (session('error'))
                <div class="text-center">
                    <small class="text-danger">{{ session('error') }}</small>
                </div>
                @endif
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Belum Punya Akun? <a href="{{ route('auth.register') }}" class="font-bold">Daftar Sekarang</a>.</p>
            </div>
        </div>
    </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right" class="h-100">
                <img
                    src="{{ asset('assets/images/logo/igasar.jpg') }}"
                    alt="bg"
                    class="img-fluid w-100 h-100 object-fit-cover" style="object-position: 40% center">
            </div>
        </div>
</div>

    </div>

    {{-- sweetalert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
        <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    </script>
    @if (session('success'))
    <script>
    Toast.fire({
        icon: 'success',
        title: '{{ session("success") }}'
    })
    </script>
    @endif
</body>

</html>
