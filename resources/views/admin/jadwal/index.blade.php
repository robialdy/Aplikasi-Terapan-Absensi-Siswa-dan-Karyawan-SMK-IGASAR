@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jadwal</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Pilih Guru
                </h5>
            </div>
            <div class="card-body">

                <div class="list-group">
                    @foreach ($guru_walikelas as $gw)
                    <a href="{{ route('jadwal.first', $gw->nig) }}" class="list-group-item list-group-item-action">{{ $gw->nama_lengkap }}</a>
                    @endforeach
                </div>

            </div>
        </div>

    </section>

@endsection
