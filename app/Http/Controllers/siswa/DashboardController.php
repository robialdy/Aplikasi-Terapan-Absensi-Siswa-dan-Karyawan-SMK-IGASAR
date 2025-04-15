<?php

namespace App\Http\Controllers\siswa;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Siswa',
            'total_hadir' => Kehadiran::where('id_user', Auth::user()->id)->where('status', 'Masuk')->count(),
            'total_sakit' => Kehadiran::where('id_user', Auth::user()->id)->where('status', 'Sakit')->count(),
            'total_izin' => Kehadiran::where('id_user', Auth::user()->id)->where('status', 'Izin')->count(),
            'total_alpa' => Kehadiran::where('id_user', Auth::user()->id)->where('status', 'Alpa')->count(),
            'total_dispen' => Kehadiran::where('id_user', Auth::user()->id)->where('status', 'Dispensasi')->count(),
        ];
        return view('siswa.dashboard.index', $data);
    }
}
