@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Track Absensi Guru</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('absensiguru') }}">Pilih guru</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pilih Tanggal</li>
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
                    @foreach ($tanggal as $t)
                    <a href="{{ route('absensiguru.absensi', ['nig' => request()->segment(3), 'tanggal' => $t->tanggal]) }}" class="list-group-item list-group-item-action">{{ $t->tanggal }}</a>
                    @endforeach
                </div>

            </div>
        </div>

    </section>

@endsection
