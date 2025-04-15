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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                                <th>Status Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $j->kelas->nama_kelas }}</td>
                                <td>{{ $j->mataPelajaran->nama_pelajaran }}</td>
                                <td>{{ $j->jam_mulai }}</td>
                                <td>{{ $j->jam_akhir }}</td>
                            @if (date('H:i:s') >= $j->jam_mulai && date('H:i:s') <= $j->jam_akhir && $j->status != 'Selesai')
                                <td>
                                    <a href="{{ route('absensikelas.create', ['id_kelas' => $j->id_kelas, 'id_jadwal' => $j->id]) }}" class="btn btn-primary"><i class="bi bi-list-check"></i></a>
                                </td>
                            @else
                                <td>
                                <a href="#" class="btn btn-primary disabled">
                                        <i class="bi bi-list-check"></i>
                                </a>
                                </td>
                            @endif
                            <td>{{ $j->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </section>


@endsection
