@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kelas') }}">Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_kelas">Nama Kelas<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_kelas" placeholder="Masukan Tanggal mulai" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
                            @error('nama_kelas')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="walikelas">Walikelas<span class="text-danger">*</span></label>
                            <select name="walikelas" id="walikelas" class="form-select">
                                <option value="" selected disabled>Pilih Walikelas</option>
                                @foreach ($walikelas as $wk)
                                    <option value="{{ $wk->id }}" @if (old('walikelas', $kelas->id_user) == $wk->id) selected @endif >{{ $wk->nama_lengkap }} - {{ $wk->bidang }}</option>
                                @endforeach
                            </select>
                            @error('walikelas')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="keterangan">Keterangan<span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">{{ old('keterangan', $kelas->keterangan) }}</textarea>
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
