@extends('template.template-admin')

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('kelas.create') }}" type="button" class="btn btn-primary">
        Tambah Kelas
    </a>
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
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama_kelas }}</td>
                                <td>{{ $k->waliKelas->nama_lengkap }}</td>
                                <td>{{ $k->keterangan }}</td>
                                <td>
                                    <a href="{{ route('kelas.edit', $k->id) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('kelas.delete', $k->id) }}" method="POST" onsubmit="return confirm('Kelas akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger border-0 bg-transparent">
                                            <i class="bi bi-trash-fill fs-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>

@endsection
