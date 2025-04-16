<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
            'title' => 'Lapaoran'
        ];
        return view('admin.laporan.index', $data);
    }
    public function exportExcel(Request $request)
    {
        $filter = $request->only(['type', 'tanggal', 'bulan', 'tahun', 'start', 'end']);
        return Excel::download(new LaporanAbsensiExport($filter), 'laporan-absensi.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->only(['type', 'tanggal', 'bulan', 'tahun', 'start', 'end']);

        $query = DB::table('kehadiran as h')
            ->join('users as u', 'h.id_user', '=', 'u.id')
            ->join('jadwal_kehadiran as jk', 'jk.id_kehadiran', '=', 'h.id')
            ->join('jadwal as j', 'jk.id_jadwal', '=', 'j.id')
            ->join('kelas as k', 'j.id_kelas', '=', 'k.id')
            ->join('mata_pelajaran as mp', 'j.id_mata_pelajaran', '=', 'mp.id')
            ->select(
                'u.nama_lengkap',
                'k.nama_kelas',
                'mp.nama_pelajaran',
                'h.tanggal',
                'h.datang_pukul as jam_masuk',
                'jk.waktu_absen as jam_keluar',
                'h.status as status_kehadiran'
            );

        if ($filter['type'] == 'harian') {
            $query->whereDate('h.tanggal', $filter['tanggal']);
        } elseif ($filter['type'] == 'bulanan') {
            $query->whereMonth('h.tanggal', $filter['bulan'])
                ->whereYear('h.tanggal', $filter['tahun']);
        } elseif ($filter['type'] == 'semester') {
            $query->whereBetween('h.tanggal', [$filter['start'], $filter['end']]);
        }

        $data = $query->get();
        $pdf = Pdf::loadView('admin.laporan.absensi_pdf', compact('data'));

        return $pdf->download('laporan-absensi.pdf');
    }
}
