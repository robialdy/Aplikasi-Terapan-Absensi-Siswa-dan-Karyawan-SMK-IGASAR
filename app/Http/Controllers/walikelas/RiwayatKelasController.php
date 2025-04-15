<?php

namespace App\Http\Controllers\walikelas;

use App\Models\Kelas;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Riwayat_Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatKelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Riwayat Kelas',
            'kelas' => Kelas::where('id_user', Auth::user()->id)->get(),
        ];
        return view('walikelas.riwayat_kelas.index', $data);
    }

    public function riwayat($id_kelas)
    {
        $kelas = Kelas::where('id', $id_kelas)->first();
        $data = [
            'title' => 'Riwayat Kelas',
            'siswa_aktif' => Riwayat_Kelas::where('status', 'Aktif')->where('id_kelas', $id_kelas)->get(),
            'siswa_tidak_aktif' => Riwayat_Kelas::whereNotIn('status', ['Aktif', 'Lulus'])->where('id_kelas', $id_kelas)->get(),
            'kelas' => Kelas::get(),
            'nama_kelas' => $kelas->nama_kelas
        ];

        return view('walikelas.riwayat_kelas.riwayat', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        Riwayat_Kelas::where('id', $id)->update([
            'status' => $request->status,
            'tgl_keluar' => date('Y-m-d')
        ]);

        return redirect()->back()->with('success', 'Status Riwayat Kelas berhasil diupdate!');
    }

    public function updateKelas(Request $request, $id_kelas)
    {
        if ($request->status == 'Naik') {
            $request->validate([
                'kelas' => 'required',
                'tahun_ajaran' => 'required',
            ]);
            $daftarSiswaKelas = Riwayat_Kelas::where('id_kelas', $id_kelas)->where('status', 'Aktif')->get();

            foreach ($daftarSiswaKelas as $dfk) {
                Riwayat_Kelas::create([
                    'id_user' => $dfk->id_user,
                    'id_kelas' => $request->kelas,
                    'tgl_masuk' => $dfk->tgl_masuk,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'status' => 'Aktif',
                ]);
            }
        }

        Riwayat_Kelas::where('id_kelas', $id_kelas)->where('status', 'Aktif')->update([
            'status' => $request->status,
            'tgl_keluar' => date('Y-m-d')
        ]);

        return redirect()->route('walikelas.riwayatkelas.riwayat', $id_kelas)->with('success', 'Kelas berhasil diupdate!');
    }
}
