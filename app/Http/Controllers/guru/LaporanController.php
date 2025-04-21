<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $data  = [
            'title' => 'Laporan Mata Pelajaran',
            'mapel' => Jadwal::where('id_user', Auth::user()->id)->get(),
        ];
        return view('guru.laporan.index', $data);
    }

    public function kelas($id_mapel)
    {
        $data = [
            'title' => 'Pilih Kelas',
            'kelas' => Jadwal::where('id_mata_pelajaran', $id_mapel)->select('id_kelas')->distinct()->get(),
        ];
        return view('guru.laporan.kelas', $data);
    }

    public function laporan($id_mapel, $id_kelas)
    {
        $data = [
            'title' => 'Pilih Jenis Laporan',
            'mapel' => Mata_Pelajaran::where('id', $id_mapel)->first(),
        ];
        return view('guru.laporan.laporan', $data);
    }

    public function export(Request $request, $id_mapel, $id_kelas)
    {
        $filter = $request->only(['type', 'tanggal', 'bulan', 'tahun', 'start', 'end']);

        $query = DB::table('jadwal_kehadiran as ad')
            ->join('kehadiran as h', 'ad.id_kehadiran', '=', 'h.id')
            ->join('users as u', 'h.id_user', '=', 'u.id')
            ->join('riwayat_kelas as rk', 'rk.id_user', '=', 'u.id')
            ->join('kelas as k', 'rk.id_kelas', '=', 'k.id')
            ->join('jadwal as j', 'ad.id_jadwal', '=', 'j.id')
            ->select(
                'u.id as id_user',
                'u.nama_lengkap',
                'u.nis',
                'u.nisn',
                'ad.status'
            )
            ->where('j.id_mata_pelajaran', $id_mapel)
            ->where('k.id', $id_kelas); // filter berdasarkan kelas

        // Filter periode
        if ($filter['type'] == 'harian') {
            $query->whereDate('h.tanggal', $filter['tanggal']);
            $periode = 'Tanggal: ' . date('d-m-Y', strtotime($filter['tanggal']));
        } elseif ($filter['type'] == 'bulanan') {
            $query->whereMonth('h.tanggal', $filter['bulan'])
                ->whereYear('h.tanggal', $filter['tahun']);
            $periode = 'Bulan: ' . date('F Y', mktime(0, 0, 0, $filter['bulan'], 1, $filter['tahun']));
        } elseif ($filter['type'] == 'semester') {
            $query->whereBetween('h.tanggal', [$filter['start'], $filter['end']]);
            $periode = 'Periode: ' . date('d M Y', strtotime($filter['start'])) . ' - ' . date('d M Y', strtotime($filter['end']));
        } else {
            $periode = '-';
        }

        $data = $query->get();

        // Rekap data
        $rekap = [];
        foreach ($data as $row) {
            $id = $row->id_user;
            if (!isset($rekap[$id])) {
                $rekap[$id] = [
                    'nama_lengkap' => $row->nama_lengkap,
                    'nis' => $row->nis,
                    'nisn' => $row->nisn,
                    'masuk' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                    'alpa' => 0,
                    'dispensasi' => 0,
                ];
            }

            switch (strtolower($row->status)) {
                case 'masuk':
                    $rekap[$id]['masuk']++;
                    break;
                case 'sakit':
                    $rekap[$id]['sakit']++;
                    break;
                case 'izin':
                    $rekap[$id]['izin']++;
                    break;
                case 'alpa':
                    $rekap[$id]['alpa']++;
                    break;
                case 'dispensasi':
                    $rekap[$id]['dispensasi']++;
                    break;
            }
        }

        // Hitung persentase
        foreach ($rekap as &$r) {
            $total = $r['masuk'] + $r['sakit'] + $r['izin'] + $r['alpa'] + $r['dispensasi'];
            $r['jumlah'] = $total;
            $r['persentase'] = $total ? round(($r['masuk'] / $total) * 100, 2) . '%' : '0%';
        }

        if ($filter['type'] == 'harian') {
            $jumlahPertemuan = DB::table('jadwal_kehadiran as ad')
                ->join('kehadiran as h', 'ad.id_kehadiran', '=', 'h.id')
                ->join('jadwal as j', 'ad.id_jadwal', '=', 'j.id')
                ->where('j.id_mata_pelajaran', $id_mapel)
                ->where('j.id_kelas', $id_kelas)
                ->whereDate('h.tanggal', $filter['tanggal']) // batasi hanya hari itu
                ->select(DB::raw('DATE(h.tanggal) as tanggal'))
                ->get()
                ->pluck('tanggal')
                ->unique()
                ->count();
        } else {
            // Hitung jumlah pertemuan
            $jumlahPertemuan = DB::table('jadwal_kehadiran as ad')
                ->join('kehadiran as h', 'ad.id_kehadiran', '=', 'h.id')
                ->join('jadwal as j', 'ad.id_jadwal', '=', 'j.id')
                ->join('users as u', 'h.id_user', '=', 'u.id')
                ->join('riwayat_kelas as rk', 'rk.id_user', '=', 'u.id')
                ->join('kelas as k', 'rk.id_kelas', '=', 'k.id')
                ->where('j.id_mata_pelajaran', $id_mapel)
                ->where('k.id', $id_kelas)
                ->select(DB::raw('DATE(h.tanggal) as tanggal'))
                ->distinct()
                ->count('tanggal');
        }

        // Buat PDF
        $pdf = Pdf::loadView('guru.laporan.laporan_pdf', [
            'data' => $rekap,
            'periode' => $periode,
            'mapel' => Mata_Pelajaran::find($id_mapel),
            'kelas' => Kelas::find($id_kelas),
            'type' => $filter['type'],
            'jumlahPertemuan' => $jumlahPertemuan
        ]);

        return $pdf->download('laporan-absensi-mapel.pdf');
    }
}
