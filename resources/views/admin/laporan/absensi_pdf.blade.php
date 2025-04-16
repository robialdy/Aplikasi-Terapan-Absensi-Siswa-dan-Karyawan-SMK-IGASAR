<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
    </style>
</head>
<body>
    <h2>Laporan Absensi</h2>
    <table width="100%">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nama_kelas }}</td>
                <td>{{ $item->nama_pelajaran }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar }}</td>
                <td>{{ $item->status_kehadiran }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
