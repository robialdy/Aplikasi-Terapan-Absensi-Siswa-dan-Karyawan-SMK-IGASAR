<?php

namespace App\Http\Controllers\admin;

use App\Models\Users;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Riwayat_Kelas;
use App\Http\Controllers\Controller;

class AbsensiGerbangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Absensi Gerbang',
            'siswa' => Riwayat_Kelas::where('status', 'Aktif')->get(),
            'kehadiran' => Kehadiran::orderBy('created_at', 'desc')->get(),
            'guru' => Users::whereIn('role', ['Guru/Karyawan', 'Walikelas'])->get(),
        ];
        return view('admin.absensi_gerbang.index', $data);
    }

    public function store(Request $request)
    {
        $id_user = json_decode($request->id_user);
        Kehadiran::create([
            'id_user' => $request->id_user,
            'datang_pukul' => date('H:i:s'),
            'tanggal' => date('Y-m-d'),
            'status' => 'Masuk',
        ]);

        return redirect()->back()->with('success', 'Absensi Sukses!');
    }
}
