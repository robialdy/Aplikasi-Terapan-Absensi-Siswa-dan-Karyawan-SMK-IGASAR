<?php

namespace App\Http\Controllers\guru;

use App\Models\Jadwal;
use App\Models\Jadwal_Kehadiran;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Riwayat_Kelas;
use Illuminate\Support\Facades\Auth;

class AbsensiKelasController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Absensi Kelas',
            'jadwal' => Jadwal::where('id_user', Auth::user()->id)->get()
        ];

        // update status jadwal agar kebuka lagi
        foreach ($data['jadwal'] as $j) {
            if (date('H:i:s') >= $j->jam_mulai && date('H:i:s') <= $j->jam_akhir) {
                Jadwal::where('id', $j->id)->update([
                    'status' => 'Aktif'
                ]);
            }
        };

        return view('guru.absensi_kelas.index', $data);
    }

    public function create($id_kelas, $id_jadwal)
    {
        $data = [
            'title' => 'Absensi Kelas',
            'siswa' => Riwayat_Kelas::where('id_kelas', $id_kelas)->where('status', 'Aktif')->get(),
            'id_jadwal' => $id_jadwal
        ];
        return view('guru.absensi_kelas.absensi', $data);
    }

    public function store(Request $request)
    {
        $status = $request->input('status');
        $id_siswa = $request->input('id_siswa');

        foreach($status as $index => $st) {
            // buat nyimpen id di jadwal_kehadiran
            $kehadiranSiswa = Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first();
            Jadwal_Kehadiran::create([
                'id_kehadiran' => $kehadiranSiswa->id,
                'id_jadwal' => $request->id_jadwal,
                'waktu_absen' => date('H:i:s'),
                'status' => $st
            ]);
        }
        Jadwal::where('id', $request->id_jadwal)->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('absensikelas')->with('success', 'Absensi Sukses!');
    }
}
