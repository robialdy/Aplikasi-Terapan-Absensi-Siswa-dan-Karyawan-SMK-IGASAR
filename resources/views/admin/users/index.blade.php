@extends('template.template-admin')

@section('title', $title)

@section('content')

 <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengguna</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('user.create') }}" type="button" class="btn btn-primary">
        Tambah Pengguna
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
                                <th>NIG</th>
                                <th>No Hp</th>
                                <th>Bidang</th>
                                <th>Tahun Masuk</th>
                                <th>TTL</th>
                                <th>Alamat Lengkap</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('assets/images/profile/' . $user->image) }}" alt="img" width="100" style="object-fit: cover;"></td>
                                <td>{{ $user->nama_lengkap }}</td>
                                <td>{{ $user->nig }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>{{ $user->bidang }}</td>
                                <td>{{ $user->tahun_masuk }}</td>
                                <td>{{ $user->ttl }}</td>
                                <td>{{ $user->alamat_lengkap }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->slug) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('User akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
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
