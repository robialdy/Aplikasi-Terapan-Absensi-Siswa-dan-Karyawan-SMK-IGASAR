@extends('template.template-admin')

@section('title', $title)

@section('content')

 <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengguna Siswa</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengguna Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('siswa.create') }}" type="button" class="btn btn-primary">
        Tambah Pengguna Siswa
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
                                <th>Profile</th>
                                <th>Nama Lengkap</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>TTL</th>
                                <th>No Hp</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Tahun Masuk</th>
                                <th>Alamat Lengkap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('assets/images/profile/' . $s->image) }}" alt="img" width="100" style="object-fit: cover;"></td>
                                <td>{{ $s->nama_lengkap }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->ttl }}</td>
                                <td>{{ $s->no_hp }}</td>
                                <td>{{ $s->nama_ayah }}</td>
                                <td>{{ $s->nama_ibu }}</td>
                                <td>{{ $s->tahun_masuk }}</td>
                                <td>{{ $s->alamat_lengkap }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $s->slug) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('siswa.delete', $s->id) }}" method="POST" onsubmit="return confirm('Siswa akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
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
