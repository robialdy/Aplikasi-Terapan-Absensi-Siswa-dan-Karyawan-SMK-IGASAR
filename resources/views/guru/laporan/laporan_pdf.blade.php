{{-- ------------- --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 22px;
        }
        .kop-surat p {
            margin: 2px 0;
            font-size: 14px;
        }
        .periode {
            text-align: right;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .text-start {
            text-sta
        }
        .tabel-absensi {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .tabel-absensi, .tabel-absensi th, .tabel-absensi td {
            border: 1px solid black;
        }
        .tabel-absensi th {
            background-color: #f0f0f0;
            padding: 8px 4px;
            font-size: 13px;
        }
        .tabel-absensi td {
            padding: 6px 4px;
            text-align: center;
            font-size: 13px;
        }
        th {
            background-color: #f0f0f0;
        }
        th, td {
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }
        .ttd {
            width: 100%;
        }
        .ttd td {
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

<table style="width: 100%;">
    <tr>
        <td style="width: 100px;">
            <img src="{{ public_path('assets/images/logo/logo.png') }}" alt="Logo Sekolah" style="width: 80px;">
        </td>
        <td style="text-align: left;">
            <h1 style="margin: 0; font-size: 20px;">SMK IGASAR PINDAD BANDUNG</h1>
            <p style="margin: 2px 0;">Jl. Cisaranten Kulon No.17, Cisaranten Kulon, Kec. Arcamanik, Kota Bandung, Jawa Barat 40293</p>
            <p style="margin: 0;">Telp. (021) 12345678990 | Email: info@smkigasarpindad.sch.id</p>
        </td>
    </tr>
</table>

<hr style="border: 1px solid #000; margin: 10px 0;">



<div style="text-align: center; margin-bottom: 15px;">
    <strong>Rekap Absensi</strong>
</div>
        <div style="text-align: start">
            Mata Pelajaran: {{ $mapel->nama_pelajaran }}
        </div>
        <div style="text-align: start">
            Jumlah Pertemuan: {{ $jumlahPertemuan }}
        </div>
        <div style="text-align: start">
            Kelas: {{ $kelas->nama_kelas }}
        </div>
        <div style="text-align: start; margin-bottom: 10px;">
            {{ $periode }}
        </div>

    <table class="tabel-absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Masuk</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alpa</th>
                    <th>Dispensasi</th>
                    <th>Jumlah</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d['nama_lengkap'] }}</td>
                    <td>{{ $d['nis'] }}</td>
                    <td>{{ $d['masuk'] }}</td>
                    <td>{{ $d['sakit'] }}</td>
                    <td>{{ $d['izin'] }}</td>
                    <td>{{ $d['alpa'] }}</td>
                    <td>{{ $d['dispensasi'] }}</td>
                    <td>{{ $d['jumlah'] }}</td>
                    <td>{{ $d['persentase'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <table class="ttd" border="0">
        <tr>
            <td width="50%">
                Mengetahui,<br>
                Kepala Sekolah<br><br><br><br>
                <u><strong>Rony Harimurti, S.Pd.,MM</strong></u><br>
                NIP. -
            </td>
            <td width="50%">
                <br>
                Guru Mata Pelajaran<br><br><br><br>
                <u><strong>{{ Auth::user()->nama_lengkap }}</strong></u><br>
                NIP. -
            </td>
        </tr>
    </table>

</body>
</html>

