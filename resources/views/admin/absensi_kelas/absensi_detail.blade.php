@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Absensi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Absensi</li>
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
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Mata Pelajaran</th>
                                <th>Waktu Absen</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal_kehadiran as $jk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jk->kehadiran->siswa->nama_lengkap }}</td>
                                    <td>{{ $jk->jadwal->mataPelajaran->nama_pelajaran }}</td>
                                    <td>{{ $jk->waktu_absen }}</td>
                                    <td>{{ $jk->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>

@endsection
