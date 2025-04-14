<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Riwayat_Kelas;
use Illuminate\Http\Request;

class AbsensiGerbangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Absensi Gerbang',
            'siswa' => Riwayat_Kelas::where('status', 'Aktif')->get(),
            'kehadiran' => Kehadiran::orderBy('created_at', 'desc')->get()
        ];
        return view('admin.absensi_gerbang.index', $data);
    }

    public function store(Request $request)
    {
        Kehadiran::create([
            'id_user' => $request->id_siswa,
            'datang_pukul' => date('H:i:s'),
            'tanggal' => date('Y-m-d')
        ]);

        return redirect()->back()->with('success', 'Absensi Sukses!');
    }
}
