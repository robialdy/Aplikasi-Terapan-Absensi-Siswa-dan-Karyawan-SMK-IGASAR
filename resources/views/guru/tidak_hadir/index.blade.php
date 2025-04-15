@extends('template.template-guru')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Tidak Hadir</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
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
                <form action="{{ route('form.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="tgl_masuk">Tanggal<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_mulai" placeholder="Masukan Tanggal mulai" name="tgl_mulai" value="{{ date('Y-m-d') }}" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for="tidak_hadir">Status Tidak Hadir<span class="text-danger">*</span></label>
                            <select name="tidak_hadir" id="tidak_hadir" class="form-select">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                            </select>
                            @error('tidak_hadir')
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
