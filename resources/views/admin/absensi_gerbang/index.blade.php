<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  {{-- choicehs --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    {{-- alert --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    {{-- datatable --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="{{ route('dashboard.admin') }}"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="#">
                <img src="{{ asset('assets/images/logo/logo.png') }}">
            </a>
        </div>
    </nav>


<div class="container">
    <div class="d-flex gap-4">
        <div class="card mt-5 col-5 align-self-start">
            <div class="card-header">
                <h4 class="card-title">Absensi Gerbang</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('absensigerbang.store') }}" id="scanForm">
                    @csrf
                    <input type="hidden" name="id_user" id="id_user">

                    <input type="text" id="scanInput"
                    autofocus
                    onkeydown="handleScan(event)"
                    style="opacity:0; position:absolute; z-index:-1;" tabindex="-1">
                </form>
                <form action="{{ route('absensigerbang.store') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <select name="id_user" id="id_siswa" class="form-control form-control-lg choices" required>
                        <option value="" selected disabled>Pilih Nama Anda</option>
                        @foreach ($siswa as $s)
                            <option value="{{ $s->id_user }}">{{ $s->siswa->nama_lengkap }} - {{ $s->kelas->nama_kelas }}</option>
                        @endforeach
                        {{-- guru karyawan sama walikelas --}}
                        @foreach ($guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama_lengkap }} - {{ $g->role }}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5 col-6">
            <div class="card-header">
                <h4 class="card-title">History</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jam</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->siswa->nama_lengkap }}</td>
                                <td>{{ $k->datang_pukul }}</td>
                                <td>{{ $k->tanggal }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Fokuskan input setiap kali halaman selesai dimuat
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('scanInput').focus();
    });

    // Saat user klik di mana pun, tetap kembalikan fokus ke input
    document.addEventListener('click', () => {
        document.getElementById('scanInput').focus();
    });

    // Opsional: saat user tekan tombol apa pun, tetap fokus
    document.addEventListener('keydown', () => {
        document.getElementById('scanInput').focus();
    });
</script>


<script>
    function handleScan(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            let raw = e.target.value.trim();

            // 1. Temukan posisi karakter `{` (awal JSON)
            const jsonStart = raw.indexOf('{');
            if (jsonStart === -1) {
                alert("Data scan tidak valid (tidak ada JSON)");
                return;
            }

            // 2. Ambil substring mulai dari karakter `{`
            const jsonText = raw.substring(jsonStart);

            try {
                const data = JSON.parse(jsonText);

                // 3. Ambil id dari JSON, bisa id atau id_user
                const userId = data.id_user ?? data.id;

                if (userId) {
                    document.getElementById('id_user').value = userId;
                    document.getElementById('scanForm').submit();
                } else {
                    alert("ID user tidak ditemukan di dalam JSON");
                }
            } catch (err) {
                alert("Gagal membaca JSON hasil scan");
                console.error("Data raw:", raw);
                console.error("Potongan JSON:", jsonText);
            }

            e.target.value = ''; // Kosongkan input setelah scan
        }
    }
</script>


</div>



    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
        {{-- choicehes --}}
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>
        {{-- datatable --}}
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
        {{-- sweetalert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

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
