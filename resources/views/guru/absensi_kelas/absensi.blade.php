@extends('template.template-guru')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Absensi Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.guru') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Absensi Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <form action="{{ route('absensikelas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_jadwal" value="{{ $id_jadwal }}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Absen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->siswa->nama_lengkap }}</td>
                                    <td>{{ $s->kelas->nama_kelas }}</td>
                                    <td>{{ date('Y-m-d') }}</td>
                                    <td>
                                        <input type="hidden" name="id_siswa[{{ $loop->index }}]" value="{{ $s->id_user }}">
                                        <input type="radio" name="status[{{ $loop->index }}]" value="Masuk"  id="Masuk{{ $loop->iteration }}" class="form-check-input" required>
                                        <label for="Masuk{{ $loop->iteration }}" class="me-2 fw-bold">MASUK</label>
                                        <input type="radio" name="status[{{ $loop->index }}]" value="Sakit" id="Sakit{{ $loop->iteration }}" class="form-check-input">
                                        <label for="Sakit{{ $loop->iteration }}" class="me-2 fw-bold">SAKIT</label>
                                        <input type="radio" name="status[{{ $loop->index }}]" value="Izin"
                                        id="Izin{{ $loop->iteration }}" class="form-check-input">
                                        <label for="Izin{{ $loop->iteration }}" class="me-2 fw-bold">IZIN</label>
                                        <input type="radio" name="status[{{ $loop->index }}]" value="Alpa"
                                        id="Alpa{{ $loop->iteration }}" class="form-check-input">
                                        <label for="Alpa{{ $loop->iteration }}" class="me-2 fw-bold">ALPA</label>
                                        <input type="radio" name="status[{{ $loop->index }}]" value="Dispensasi" id="Dispensasi{{ $loop->iteration }}" class="form-check-input">
                                        <label for="Dispensasi{{ $loop->iteration }}" class="fw-bold">DISPENSASI</label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </section>


@endsection
