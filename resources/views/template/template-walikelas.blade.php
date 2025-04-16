<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>


  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  {{-- extension --}}
  {{-- datatable --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
  {{-- alert --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
{{-- choicehs --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">

</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
        <div class="logo flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" style="width: 40px; height: 40px; object-fit: cover;">
            <a href="{{ route('dashboard.siswa') }}" class="fs-5 fw-bold">ABSENSI IGAPIN</a>
        </div>

            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ request()->is('walikelas') ? 'active' : '' }}">
                <a href="{{ route('dashboard.walikelas') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('walikelas/riwayat-kelas*') ? 'active' : '' }}">
                <a href="{{ route('walikelas.riwayatkelas') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Siswa</span>
                </a>
            </li>

        </ul>
    </div>
</div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ Auth()->user()->nama_lengkap }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ Auth()->user()->role }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('assets/images/logo/default-image.jpg') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ Auth()->user()->nama_lengkap }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href=""><i class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('auth.logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-link ms-2"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

<div class="page-heading">
    @yield('content')
</div>

            </div>
            <footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2025 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="#">Muhammad Fachri Robialdy | XII PPLG</a></p>
        </div>
    </div>
</footer>
        </div>
    </div>
    {{-- SPA --}}
    {{-- <script src="https://unpkg.com/@hotwired/turbo"></script>
        <script>
        document.addEventListener("turbo:load", function() {
            // inisiaisi kembali
            $('#table1').DataTable();
            $('#table3').DataTable();
        });
        </script>
    </script> --}}


    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    {{-- extensi --}}
    {{-- datatable --}}
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    {{-- sweetalert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- choicehes --}}
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>

    {{-- notifikasi --}}
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
