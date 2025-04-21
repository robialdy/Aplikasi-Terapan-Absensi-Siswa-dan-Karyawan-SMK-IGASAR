@extends('template.template-guru')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jenis Laporan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('guru.laporan') }}">Pilih Mapel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jenis Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-body">

                <form id="form-laporan" method="post" action="{{ route('guru.laporan.export', ['id_kelas' => request()->segment(4), 'id_mapel' => $mapel->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="type">Jenis Laporan</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="harian">Harian</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="semester">Semester</option>
                        </select>
                    </div>

                    {{-- HARiAN --}}
                    <div class="mb-3 d-none" id="harian-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>

                    {{-- BULANAN --}}
                    <div class="row d-none" id="bulanan-group">
                        <div class="col-md-6 mb-3">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tahun">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ date('Y') }}">
                        </div>
                    </div>

                    {{-- SEMESTER --}}
                    <div class="row d-none" id="semester-group">
                        <div class="col-md-6 mb-3">
                            <label for="start">Tanggal Mulai</label>
                            <input type="date" name="start" id="start" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end">Tanggal Selesai</label>
                            <input type="date" name="end" id="end" class="form-control">
                        </div>
                    </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger" onclick="submitForm('pdf')">Export PDF</button>
                </div>

                </form>


            </div>
        </div>

    </section>

    <script>
    const typeSelect = document.getElementById('type');
    const harianGroup = document.getElementById('harian-group');
    const bulananGroup = document.getElementById('bulanan-group');
    const semesterGroup = document.getElementById('semester-group');
    const form = document.getElementById('form-laporan');

    typeSelect.addEventListener('change', function () {
        harianGroup.classList.add('d-none');
        bulananGroup.classList.add('d-none');
        semesterGroup.classList.add('d-none');

        if (this.value === 'harian') {
            harianGroup.classList.remove('d-none');
        } else if (this.value === 'bulanan') {
            bulananGroup.classList.remove('d-none');
        } else if (this.value === 'semester') {
            semesterGroup.classList.remove('d-none');
        }
    });
</script>


@endsection
