@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('riwayatkelas') }}">Pilih Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#naik_tingkat">
            Naik Tingkat {{ $nama_kelas }}
        </button>
</div>

<div class="modal fade text-left" id="naik_tingkat" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Update Seluruh siswa kelas </h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>

            <form action="{{ route('riwayatkelas.updatekelas', request()->segment(3)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="email">Kelas <small class="text-muted">(Tidak Perlu Dipilih jika Lulus!)</small></label>
                    <div class="form-group">
                        <select name="kelas" id="kelas" class="form-select" >
                            <option value="" selected disabled>Pilih Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <label for="password">Tahun Ajaran <small class="text-muted">(Tidak Perlu Dipilih jika Lulus!)</small></label>
                    <div class="form-group">
                        <select name="tahun_ajaran" id="tahun_ajaran" class="form-select">
                            <option value="" selected disabled>Pilih Tahun Ajaran</option>
                            <option value="2025/2026" >2025/2026</option>
                            <option value="2026/2027">2026/2027</option>
                            <option value="2027/2028" >2027/2028</option>
                            <option value="2028/2029" >2028/2029</option>
                            <option value="2029/2030">2029/2030</option>
                            <option value="2030/2031">2030/2031</option>
                            <option value="2031/2032">2031/2032</option>
                            <option value="2032/2033">2032/2033</option>
                            <option value="2033/2034">2033/2034</option>
                            <option value="2034/2035">2034/2035</option>
                        </select>
                        @error('tahun_ajaran')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <label fstatus">Status: </label>
                    <div class="form-group">
                        <select name="status" id="status" class="form-select" required>
                            <option value="" selected disabled>Pilih Status</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Naik">Naik</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table Siswa Aktif
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Tgl Masuk</th>
                                <th>Tgl Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa_aktif as $sa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sa->siswa->nama_lengkap }}</td>
                                <td>{{ $sa->kelas->nama_kelas }}</td>
                                <td>{{ $sa->tahun_ajaran }}</td>
                                <td>{{ $sa->tgl_masuk }}</td>
                                <td>{{ $sa->tgl_keluar }}</td>
                                <td>
                                <div class="btn-group dropend me-1 mb-1">
                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $sa->status }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <h6 class="dropdown-header">Status</h6>
                                        @foreach (['Aktif','Lulus','Keluar'] as $status)
                                        <form action="{{ route('riwayatkelas.updateStatus', $sa->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ $status }}">

                                            <button type="submit" class="dropdown-item {{ $sa->status == $status ? 'disabled bg-primary text-white' : '' }}" onclick="return confirm('Anda Akan Merubah Status, Yakin dengan Perubahan?')">{{ $loop->iteration }}. {{ $status }}</button>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h5 class="card-title mt-3 mb-4">
                    Table Siswa Non Aktif
                </h5>

                <div class="table-responsive">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                                <th>Tgl Masuk</th>
                                <th>Tgl Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa_tidak_aktif as $sta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sta->siswa->nama_lengkap }}</td>
                                <td>{{ $sta->kelas->nama_kelas }}</td>
                                <td>{{ $sta->tahun_ajaran }}</td>
                                <td>{{ $sta->status }}</td>
                                <td>{{ $sta->tgl_masuk }}</td>
                                <td>{{ $sta->tgl_keluar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>

@endsection
