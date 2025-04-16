<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Status Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
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
