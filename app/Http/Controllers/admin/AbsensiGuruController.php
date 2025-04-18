<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Users;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEqualWithDelta;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Absensi Guru',
            'guru_kar' => Users::whereIn('role', ['Guru/Karyawan', 'Walikelas'])->get(),
        ];
        return view('admin.absensi_guru.index', $data);
    }

    public function tanggal($nig)
    {
        $users = Users::where('nig', $nig)->first();
        $data = [
            'title' => 'Absensi Guru',
            'tanggal' => Kehadiran::select('tanggal')->where('id_user', $users->id)->distinct()->orderBy('tanggal')->get()
        ];
        return view('admin.absensi_guru.tanggal', $data);
    }

    public function absensi($nig, $tanggal)
    {
        $user = Users::where('nig', $nig)->first();
        $data = [
            'title' => 'Absensi',
            'absensi' => Kehadiran::where('id_user', $user->id)->where('tanggal', $tanggal)->get(),
        ];
        return view('admin.absensi_guru.absensi', $data);
    }
}
