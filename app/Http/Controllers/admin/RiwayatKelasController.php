<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Riwayat_Kelas;
use App\Models\Users;
use Illuminate\Http\Request;

class RiwayatKelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Riwayat Kelas',
            'kelas' => Kelas::get(),
        ];
        return view('admin.riwayat_kelas.index', $data);
    }

    public function riwayat($id_kelas)
    {
        $data = [
            'title' => 'Riwayat Kelas',
            'siswa_aktif' => Users::where('role', 'Siswa')->where('status', 'Aktif')->where('id_kelas', $id_kelas)->get(),
            'siswa_tidak_aktif' => Users::where('role', 'Siswa')->whereNot('status', 'Aktif')->where('id_kelas', $id_kelas)->get()
        ];

        return view('admin.riwayat_kelas.riwayat', $data);

    }
}
