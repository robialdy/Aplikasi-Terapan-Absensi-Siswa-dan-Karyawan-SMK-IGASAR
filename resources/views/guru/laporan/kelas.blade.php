@extends('template.template-guru')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('guru.laporan') }}">Pilih Mapel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pilih Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Pilih Mata Pelajaran
                </h5>
            </div>
            <div class="card-body">

                <div class="list-group">
                    @foreach ($kelas as $k)
                    <a href="{{ route('guru.laporan.mapel', ['id_kelas' => $k->id_kelas, 'id_mapel' => request()->segment(3)]) }}" class="list-group-item list-group-item-action">{{ $k->kelas->nama_kelas }}</a>
                    @endforeach
                </div>

            </div>
        </div>

    </section>

@endsection
