<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>



  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/compiled/css/auth.css') }}">

  {{-- choicehs --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth" style="background-image: url('{{ asset('assets/images/logo/igasar.jpg') }}'); background-size: cover; background-position: center;">

        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="card shadow-lg rounded-4">
                        <div class="card-body p-5">
                            <div class="auth-logo d-flex align-items-center gap-3 mb-4">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 55px;">
                                <h4 class="mb-0">ABSENSI SMK IGAPIN BANDUNG</h4>
                            </div>

                            <h2 class="auth-title mb-4">Register</h2>

                            <form action="{{ route('auth.register.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="tahun_masuk">Tahun Masuk<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun_masuk" placeholder="Masukan Tahun Masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}">
                            @error('tahun_masuk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nis">NIS<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nis" placeholder="Masukan NIS" name="nis" value="{{ old('nis') }}">
                            @error('nis')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nisn">NISN<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nisn" placeholder="Masukan NISN" name="nisn" value="{{ old('nisn') }}">
                            @error('nisn')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
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
                            <label for="kelas">Kelas<span class="text-danger">*</span></label>
                                <select name="kelas" id="kelas" class="form-select">
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"  @if (old('kelas') == $k->id_kelas) selected @endif>{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            @error('kelas')
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

                        <div class="form-group col-6">
                            <label for="nama_ayah">Nama Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ayah" placeholder="Masukan Nama Ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                            @error('nama_ayah')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="nama_ibu">Nama Ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ibu" placeholder="Masukan Nama Ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                            @error('nama_ibu')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tgl_masuk">Tanggal Masuk Sekolah<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_masuk" placeholder="Masukan Tanggal Lahir" name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                            @error('tgl_masuk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="tahun_ajaran">Tahun Ajaran<span class="text-danger">*</span></label>
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-select">
                                    <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                    <option value="2025/2026" @if (old('tahun_ajaran') == '2025/2026') @endif>2025/2026</option>
                                    <option value="2026/2027"@if (old('tahun_ajaran') == '2026/2027') @endif>2026/2027</option>
                                    <option value="2027/2028" @if (old('tahun_ajaran') == '2027/2028') @endif>2027/2028</option>
                                    <option value="2028/2029" @if (old('tahun_ajaran') == '2028/2029') @endif>2028/2029</option>
                                    <option value="2029/2030"@if (old('tahun_ajaran') == '2029/2030') @endif>2029/2030</option>
                                    <option value="2030/2031"@if (old('tahun_ajaran') == '2030/2031') @endif>2030/2031</option>
                                    <option value="2031/2032"@if (old('tahun_ajaran') == '2031/2032') @endif>2031/2032</option>
                                    <option value="2032/2033"@if (old('tahun_ajaran') == '2032/2033') @endif>2032/2033</option>
                                    <option value="2033/2034"@if (old('tahun_ajaran') == '2033/2034') @endif>2033/2034</option>
                                    <option value="2034/2035"@if (old('tahun_ajaran') == '2034/2035') @endif>2034/2035</option>
                                </select>
                            @error('tahun_ajaran')
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

                        <div class="form-group col-12">
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

                            <div class="text-center mt-4 fs-6">
                                <p class="text-muted">Sudah punya akun?
                                    <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Login sekarang</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

            {{-- choicehes --}}
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>
</body>



</html>
