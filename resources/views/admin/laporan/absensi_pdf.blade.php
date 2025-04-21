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



    <div class="periode">
        <div style="text-align: start">

            {{ $kelas->nama_kelas }}
        </div>
        <div style="text-align: end">
            {{ $periode }}
        </div>
    </div>

    <table class="tabel-absensi">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    @if ($type == 'harian')
                    @else
                    <th>Jumlah Kehadiran</th>
                    @endif
                    <th>Masuk</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alpa</th>
                    <th>Dispensasi</th>
                    @if ($type == 'harian')
                    @else
                    <th>Presentase Kehadiran</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $userId => $item)
                <tr>
                    <td>{{ $item['nama_lengkap'] }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['nisn'] }}</td>
                    @if ($type == 'harian')
                    @else
                    <td>{{ $item['masuk'] + $item['sakit'] + $item['izin'] + $item['alpa'] + $item['dispensasi'] }}</td>
                    @endif
                    <td>{{ $item['masuk'] }}</td>
                    <td>{{ $item['sakit'] }}</td>
                    <td>{{ $item['izin'] }}</td>
                    <td>{{ $item['alpa'] }}</td>
                    <td>{{ $item['dispensasi'] }}</td>
                    @if ($type == 'harian')
                    @else
                    <td>{{ $item['masuk'] / ($item['masuk'] + $item['sakit'] + $item['izin'] + $item['alpa'] + $item['dispensasi']) * 100 }}%</td>
                    @endif
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
                Wali Kelas<br><br><br><br>
                <u><strong>{{ $walikelas->waliKelas->nama_lengkap }}</strong></u><br>
                NIP. -
            </td>
        </tr>
    </table>

</body>
</html>
