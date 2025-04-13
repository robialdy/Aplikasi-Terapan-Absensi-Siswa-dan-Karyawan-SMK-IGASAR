
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
                        <li class="breadcrumb-item"><a href="{{ route('siswa') }}">Pengguna Siswa</a></li>
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
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_lengkap">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukan Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}">
                            @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tahun_masuk">Tahun Masuk<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun_masuk" placeholder="Masukan Tahun Masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}">
                            @error('tahun_masuk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nis">NIS<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nis" placeholder="Masukan NIS" name="nis" value="{{ old('nis', $siswa->nis) }}">
                            @error('nis')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nisn">NISN<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nisn" placeholder="Masukan NISN" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                            @error('nisn')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="no_hp">No Handphone<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="number" class="form-control" id="no_hp" placeholder="Masukan No Hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
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
                                        <option value="{{ $kota }}"  @if (old('kota_lahir', explode(',', $siswa->ttl)[0]) == $kota) selected @endif>{{ $kota }}</option>
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
                            <input type="date" class="form-control" id="tanggal_lahir" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', trim(explode(',', $siswa->ttl)[1])) }}">
                            @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nama_ayah">Nama Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ayah" placeholder="Masukan Nama Ayah" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}">
                            @error('nama_ayah')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nama_ibu">Nama Ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ibu" placeholder="Masukan Nama Ibu" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}">
                            @error('nama_ibu')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="alamat_lengkap">Alamat Lengkap<span class="text-danger">*</span></label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" placeholder="Masukan Alamat Lengkap">{{ old('alamat_lengkap', $siswa->alamat_lengkap) }}</textarea>
                            @error('alamat_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" placeholder="Masukan Image" name="image" value="{{ old('image') }}">
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukan password" name="password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="re-password">Re-Password</label>
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
