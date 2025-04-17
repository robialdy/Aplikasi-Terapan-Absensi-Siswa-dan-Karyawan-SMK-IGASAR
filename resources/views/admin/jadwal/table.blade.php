@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jadwal</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal') }}">Guru</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal.first', $nig) }}">Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Jadwal Kelas {{ $nama_kelas }} </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Guru Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->guru->nama_lengkap }}</td>
                            <td>{{ $jadwal->mataPelajaran->nama_pelajaran }}</td>
                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_akhir }}</td>
                            <td>
                                @if (request()->segment(3) == $jadwal->guru->nig)
                                <a href="{{ route('jadwal.edit', ['nig' => $jadwal->guru->nig, 'id_kelas' => $jadwal->id_kelas, 'id_jadwal' => $jadwal->id]) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                    <i class="bi bi-pencil-square fs-4"></i>
                                </a>
                                <form action="{{ route('jadwal.delete', $jadwal->id) }}" method="POST" onsubmit="return confirm('Jadwal akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 text-danger border-0 bg-transparent">
                                        <i class="bi bi-trash-fill fs-4"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<h3>Tambah Jadwal</h3>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Form
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_guru" value="{{ $id_guru }}">
                    <input type="hidden" name="id_kelas" value="{{ request()->segment(4) }}">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guru_pengajar">Guru Pengajar<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="guru_pengajar" name="guru_pengajar" value="{{ $nama_guru }}" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for="guru_pengajar">Kelas<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="guru_pengajar" name="guru_pengajar" value="{{ $nama_kelas }}" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for="mapel">Mata Pelajaran<span class="text-danger">*</span></label>
                            <select name="mapel" id="mapel" class="form-select">
                                <option value="" selected disabled>Pilih Mapel</option>
                                @foreach ($mapel as $k)
                                    <option value="{{ $k->id }}" @if (old('mapel') == $k->id )  @endif>{{ $k->nama_pelajaran }}</option>
                                @endforeach
                            </select>
                            @error('mapel')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                            @php
                                $jamOptions = [
                                    '07:30:00-08:10:00',
                                    '08:10:00-09:50:00',
                                    '08:50:00-09:30:00',
                                    '09:30:00-10:10:00',
                                    // '10:10:00-10:30:00',
                                    '10:30:00-11:10:00',
                                    '11:10:00-11:50:00',
                                    '11:50:00-12:10:00',
                                    // '12:10:00-12:50:00',
                                    '12:50:00-13:30:00',
                                    '13:30:00-14:10:00',
                                    '14:10:00-14:50:00',
                                    '14:50:00-15:30:00',
                                ];
                            @endphp

                        <div class="form-group col-6">
                            <label for="jam">Jam<span class="text-danger">*</span></label>
                            <select name="jam" id="jam" class="form-select">
                                <option value="" selected disabled>Pilih Jam</option>
                                @foreach ($jamOptions as $jam)
                                    <option value="{{ $jam }}" {{ in_array($jam, $jam_terpakai) ? 'disabled' : '' }}>
                                        {{ $jam }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mapel')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection
