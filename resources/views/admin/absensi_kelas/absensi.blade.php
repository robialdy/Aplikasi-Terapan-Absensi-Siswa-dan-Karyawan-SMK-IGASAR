@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Absensi Kelas {{ $kelas->nama_kelas }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Absensi Kelas {{ $kelas->nama_kelas }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">

        <div class="list-group">
            @foreach ($siswa_kelas as $sk)
            <a href="{{ route('absensikelas.absensisiswa.admin', ['id_kelas' => $sk->id_kelas, 'id_user' => $sk->id_user]) }}" class="list-group-item list-group-item-action">{{ $sk->siswa->nama_lengkap}}</a>
            @endforeach
        </div>

    </section>

@endsection
