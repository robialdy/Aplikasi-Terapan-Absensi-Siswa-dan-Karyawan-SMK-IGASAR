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
                        <li class="breadcrumb-item"><a href="{{ route('harilibur') }}">Hari Libur</a></li>
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
                <form action="{{ route('harilibur.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="tgl_masuk">Tanggal Mulai<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_mulai" placeholder="Masukan Tanggal mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                            @error('tgl_mulai')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tgl_selesai">Tanggal Selesai<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_selesai" placeholder="Masukan Tanggal Selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                            @error('tgl_selesai')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="keterangan">Keterangan<span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </div>
                </form>
            </div>
        </div>


    </section>

@endsection
