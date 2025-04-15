
@extends('template.template-guru')

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.guru') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('guru.user') }}">Pengguna</a></li>
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
                <form action="{{ route('guru.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_lengkap">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukan Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                            @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nig">NIG<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nig" placeholder="Masukan NIG" name="nig" value="{{ old('nig') }}">
                            @error('nig')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="bidang">Bidang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bidang" placeholder="Masukan Bidang" name="bidang" value="{{ old('bidang') }}">
                            @error('bidang')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tahun_masuk">Tahun Masuk<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun_masuk" placeholder="Masukan Tahun Masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}">
                            @error('tahun_masuk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="no_hp">No Handphone<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="number" class="form-control" id="no_hp" placeholder="Masukan No Hp" name="no_hp" value="{{ old('no_hp') }}">
                            </div>
                            @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="kota_lahir">Kota Lahir<span class="text-danger">*</span></label>
                            <select name="kota_lahir" id="kota_lahir" class="form-control form-control-lg choices">
                                <option value="" selected disabled>Pilih Kota Lahir</option>
                                @foreach ($provincys as $provincy)
                                <optgroup label="{{ $provincy['provinsi'] }}">
                                    @foreach ($provincy['kota'] as $kota)
                                        <option value="{{ $kota }}"  @if (old('kota_lahir') == $kota) selected @endif>{{ $kota }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @error('kota_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tanggal_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="alamat_lengkap">Alamat Lengkap<span class="text-danger">*</span></label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" placeholder="Masukan Alamat Lengkap">{{ old('alamat_lengkap') }}</textarea>
                            @error('alamat_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="role">Role<span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-select">
                                <option value="" selected disabled>Pilih Role</option>
                                <option value="Guru/Karyawan" @if (old('role') == 'Guru/Karyawan') selected @endif>Guru/Karyawan</option>
                                <option value="Walikelas" @if (old('role') == 'Walikelas') selected @endif>Walikelas</option>
                            </select>
                            @error('role')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="image">Image<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" placeholder="Masukan Image" name="image" value="{{ old('image') }}">
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="Masukan password" name="password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="re-password">Re-Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="re-password" placeholder="Masukan password" name="password_confirmation">
                            @error('re-password')
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
