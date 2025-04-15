@extends('template.template-siswa')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Diri</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.siswa') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3 text-center">
                    QR CODE
                </h5>
            </div>
            <div class="card-body">

                <div class="text-center">
                    <h4 class="mb-1">{{ Auth::user()->nama_lengkap }}</h4>
                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter">
                            <img src="{{ asset('assets/images/qrcode/' . Auth::user()->barcode) }}" alt="qrcode" width="250">
                    </button>
                </div>

                <h4 class="mt-3">Data Diri</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>TTL</th>
                                <th>No HP</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Tahun Masuk</th>
                                <th>Alamat Lengkap</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="{{ asset('assets/images/profile/'. Auth::user()->image) }}" alt="profile" width="100" style="object-fit: cover;"></td>
                                <td>{{ Auth::user()->nama_lengkap }}</td>
                                <td>{{ Auth::user()->nisn }}</td>
                                <td>{{ Auth::user()->nis }}</td>
                                <td>{{ Auth::user()->ttl }}</td>
                                <td>{{ Auth::user()->no_hp }}</td>
                                <td>{{ Auth::user()->nama_ayah }}</td>
                                <td>{{ Auth::user()->nama_ibu }}</td>
                                <td>{{ Auth::user()->tahun_masuk }}</td>
                                <td>{{ Auth::user()->alamat_lengkap }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('assets/images/qrcode/' . Auth::user()->barcode) }}" alt="qrcode" width="250">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Unduh</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection
