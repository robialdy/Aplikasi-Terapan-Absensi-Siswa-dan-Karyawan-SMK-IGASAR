<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_Kehadiran;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Riwayat_Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiKelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Absensi Kelas',
            'kelas' => Kelas::get(),
        ];
        return view('admin.absensi_kelas.index', $data);
    }

    public function absensi($id_kelas)
    {
        $kelas = Kelas::where('id', $id_kelas)->first();


        $data = [
            'title' => 'Absensi',
            'kelas' => $kelas,
            'siswa_kelas' => Riwayat_Kelas::where('id_kelas', $id_kelas)->where('status', 'Aktif')->get(),
        ];
        return view('admin.absensi_kelas.absensi', $data);
    }

    public function absensi_siswa($id_kelas, $id_user)
    {
        $data = [
            'title' => 'Absensi Siswa',
            'kehadiran' => Kehadiran::where('id_user', $id_user)->get(),
        ];
        return view('admin.absensi_kelas.absensi_siswa', $data);
    }

    public function detail($id_kehadiran)
    {
        $data = [
            'title' => 'Detail Absensi',
            'jadwal_kehadiran' => Jadwal_Kehadiran::where('id_kehadiran', $id_kehadiran)->get(),
        ];
        return view('admin.absensi_kelas.absensi_detail', $data);
    }
}
