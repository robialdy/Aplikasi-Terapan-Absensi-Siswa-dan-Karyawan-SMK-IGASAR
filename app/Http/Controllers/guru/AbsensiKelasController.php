<?php

namespace App\Http\Controllers\guru;

use App\Models\Hari_Libur;
use App\Models\Users;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Riwayat_Kelas;
use App\Models\Jadwal_Kehadiran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiKelasController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Absensi Kelas',
            'jadwal' => Jadwal::where('id_user', Auth::user()->id)->get(),
            'libur' => Hari_Libur::where('tgl_mulai', '<=', date('Y-m-d'))->where('tgl_selesai', '>=', date('Y-m-d'))->first(),
        ];


        foreach ($data['jadwal'] as $j) {
            $sudahAbsenHariIni = \App\Models\Jadwal_Kehadiran::where('id_jadwal', $j->id)
                ->whereDate('created_at', Carbon::today())
                ->exists();

            if (
                !$sudahAbsenHariIni &&
                date('H:i:s') >= $j->jam_mulai &&
                date('H:i:s') <= $j->jam_akhir
            ) {
                Jadwal::where('id', $j->id)->update([
                    'status' => 'Aktif'
                ]);
            } else {
                // Optional: kalau jadwal sudah lewat dan belum absen, bisa reset ke Nonaktif
                // Jadwal::where('id', $j->id)->update(['status' => 'Nonaktif']);
            }
        }


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

        // ABSEN SISWA
        foreach($status as $index => $st) {
            // buat nyimpen id di jadwal_kehadiran
            $kehadiranSiswa = Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first();
            if (!$kehadiranSiswa) {
                $kehadiranSiswa = null;
            }

            // update tidak hadir
            if ($st == 'Sakit' || $st == 'Izin' || $st == 'Alpa') {
                if (Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first()) {
                    $kehadiran_user = Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first();
                    $kehadiran = $kehadiran_user->id;
                } else {
                    $kehadiran = Kehadiran::create([
                        'id_user' => $id_siswa[$index],
                        'tanggal' => date('Y-m-d'),
                        'status' => $st
                    ]);
                    $kehadiran = $kehadiran->id;
                }
            }

            // di null in
            if($st != 'Masuk' && $st != 'Dispensasi' ) {
                $kehadiranSiswa = $kehadiran;
            } elseif ($st == 'Dispensasi') {
                if (Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first()) {
                    $kehadiran_user = Kehadiran::where('id_user', $id_siswa[$index])->where('tanggal', date('Y-m-d'))->first();
                    $kehadiranSiswa = $kehadiran_user->id;
                } else {
                    $kehadiran = Kehadiran::create([
                        'id_user' => $id_siswa[$index],
                        'tanggal' => date('Y-m-d'),
                        'status' => 'Izin'
                    ]);
                    $kehadiranSiswa = $kehadiran->id;
                }
            } else {
                if (!$kehadiranSiswa) {
                    $kehadiran = Kehadiran::create([
                        'id_user' => $id_siswa[$index],
                        'tanggal' => date('Y-m-d'),
                        'datang_pukul' => date('H:i:s'),
                        'status' => 'Masuk'
                    ]);
                    $kehadiranSiswa = $kehadiran->id;
                } else {
                    $kehadiranSiswa = $kehadiranSiswa->id;
                }
            }

            Jadwal_Kehadiran::create([
                'id_kehadiran' => $kehadiranSiswa,
                'id_jadwal' => $request->id_jadwal,
                'waktu_absen' => date('H:i:s'),
                'status' => $st
            ]);
        }
        // ABSEN GURU, KARYAWAN, WALIKELAS
        // $kehadiranGKW = Kehadiran::where('id_user', Auth::user()->id)->where('tanggal', date('Y-m-d'))->first();

        // Jadwal_Kehadiran::create([
        //     'id_kehadiran' => $kehadiranGKW->id,
        //     'id_jadwal' => $request->id_jadwal,
        //     'waktu_absen' => date('H:i:s'),
        //     'status' => 'Masuk'
        // ]);

        Jadwal::where('id', $request->id_jadwal)->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('absensikelas')->with('success', 'Absensi Sukses!');
    }

    public function form_tidak_hadir()
    {
        $data = [
            'title' => 'Form Tidak Hadir',
        ];
        return view('guru.tidak_hadir.index', $data);
    }

    public function form_submit(Request $request)
    {
        $request->validate([
            'tidak_hadir' => 'required',
        ]);

        Kehadiran::create([
            'id_user' => Auth::user()->id,
            'tanggal' => Date('Y-m-d'),
            'status' => $request->tidak_hadir,
        ]);

        return redirect()->back()->with('success', 'Absensi Sukses!');
    }
}
