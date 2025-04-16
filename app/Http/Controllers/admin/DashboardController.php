<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dataMasuk = DB::table('Kehadiran')
            ->select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('COUNT(*) as total'))
            ->where('status', 'Masuk')
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $dataMasuk[$i] ?? 0;
        }

        $data = [
            'title' => 'Dashboard Admin',
            'chartData' => $chartData,
            'status' => [
                'masuk' => Jadwal_Kehadiran::where('status', 'Masuk')->count(),
                'sakit' => Jadwal_Kehadiran::where('status', 'Sakit')->count(),
                'izin' => Jadwal_Kehadiran::where('status', 'Izin')->count(),
                'dispensasi' => Jadwal_Kehadiran::where('status', 'Dispensasi')->count(),
                'alpa' => Jadwal_Kehadiran::where('status', 'Alpa')->count(),
            ],

        ];

        return view('admin.dashboard.index', $data);
    }
}
