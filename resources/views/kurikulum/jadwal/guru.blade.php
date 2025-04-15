@extends('template.template-kurikulum')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.kurikulum') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kurikulum.jadwal') }}">Jadwal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Pilih Kelas
                </h5>
            </div>
            <div class="card-body">

                <div class="list-group">
                    @foreach ($kelas as $k)
                    <a href="{{ route('kurikulum.jadwal.two', ['nig' => request()->segment(3), 'id_kelas' => $k->id]) }}" class="list-group-item list-group-item-action">{{ $k->nama_kelas }}</a>
                    @endforeach
                </div>

            </div>
        </div>

    </section>

@endsection
