@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('matapelajaran') }}">Mata Pelajaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('matapelajaran.update', $mp->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_pelajaran">Nama Pelajaran (Nama-Kelas: B.Indo-12)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_pelajaran" placeholder="Masukan Nama Pelajaran" name="nama_pelajaran" value="{{ old('nama_pelajaran', $mp->nama_pelajaran) }}">
                            @error('nama_pelajaran')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="keterangan">Keterangan<span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" placeholder="Masukan Keterangan" class="form-control">{{ old('keterangan', $mp->keterangan) }}</textarea>
                            @error('keterangan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    </section>

@endsection
