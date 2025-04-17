<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Exports\LaporanAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'kelas' => Kelas::get(),
        ];
        return view('admin.laporan.index', $data);
    }

    public function laporan($id_kelas)
    {
        $data = [
            'title' => 'Jenis Laporan',
            'kelas' => Kelas::where('id', $id_kelas)->firstOrFail(),
        ];
        return view('admin.laporan.laporan', $data);
    }

    public function exportPdf(Request $request, $id_kelas)
    {
        $filter = $request->only(['type', 'tanggal', 'bulan', 'tahun', 'start', 'end']);

        $query = DB::table('kehadiran as h')
            ->join('users as u', 'h.id_user', '=', 'u.id')
            ->join('riwayat_kelas as rk', 'rk.id_user', '=', 'u.id')
            ->join('kelas as k', 'rk.id_kelas', '=', 'k.id')
            ->select(
                'u.nama_lengkap',
                'u.nis',
                'u.nisn',
                'h.status',
                'h.id_user'
            )
            ->where('k.id', $id_kelas);
        // filter periode
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

        //presentase
        foreach ($rekap as &$r) {
            $total = $r['masuk'] + $r['sakit'] + $r['izin'] + $r['alpa'] + $r['dispensasi'];
            $r['jumlah'] = $total;
            $r['persentase'] = $total ? round(($r['masuk'] / $total) * 100, 2) . '%' : '0%';
        }

        // $data = [
        //     'data' => $rekap,
        //     'periode' => $periode
        // ];

        // dd($data);


        $pdf = Pdf::loadView('admin.laporan.absensi_pdf', [
            'data' => $rekap,
            'periode' => $periode,
            'kelas' => Kelas::where('id', $id_kelas)->first(),
            'walikelas' => Kelas::where('id', $id_kelas)->first(),
            'type' => $filter['type']
        ]);

        return $pdf->download('laporan-absensi.pdf');
    }
}
