@extends('template.template-admin')

@section('title', '')

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Admin</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
            <div class="row mt-3">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">

                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                    <h6 class="text-muted font-semibold">Jumlah Siswa Aktif</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumSiswa }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                    <h6 class="text-muted font-semibold">Jumlah Kelas</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumKelas }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">

                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                    <h6 class="text-muted font-semibold">Jumlah Hari Libur</h6>
                                    <h6 class="font-extrabold mb-0">20</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-center">Jumlah Kehadiran {{ date('Y-m-d') }}</h6>
                                    <h6 class="font-extrabold mb-0 text-center">{{ $jumKehadiran }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah Hadir / Bulan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kehadiran / Pelajaran (All Time)</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitors-profile"></div>
                        </div>
                    </div>
                </div>
            </div>

    </section>




    {{-- chart --}}
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var optionsProfileVisit = {
        annotations: {
            position: "back",
        },
        dataLabels: {
            enabled: false,
        },
        chart: {
            type: "bar",
            height: 300,
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {},
        series: [
            {
                name: "Jumlah Masuk",
                data: @json($chartData),
            },
        ],
        colors: "#435ebe",
        xaxis: {
            categories: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            ],
        },
    };

    var chartProfileVisit = new ApexCharts(
        document.querySelector("#chart-profile-visit"),
        optionsProfileVisit
    );
    chartProfileVisit.render();

        let optionsVisitorsProfile = {
        series: [{{ $status['masuk'] }},{{ $status['alpa'] }},{{ $status['sakit'] }},{{ $status['izin'] }},{{ $status['dispensasi'] }}],
        labels: ["Masuk", "Alpa", "Sakit", "Izin", "Dispensasi"],
        colors: ["#435ebe", "#55c6e8", "#FFB74D", "#F57C00", "#D32F2F"],

        chart: {
            type: "donut",
            width: "100%",
            height: "350px",
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            pie: {
            donut: {
                size: "30%",
            },
            },
        },
        }
        var chartVisitorsProfile = new ApexCharts(
        document.getElementById("chart-visitors-profile"),
        optionsVisitorsProfile
        )
        chartVisitorsProfile.render()
    </script>

@endsection
