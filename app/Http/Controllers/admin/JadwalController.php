<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Users;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Jadwal',
            'guru_walikelas' => Users::whereIn('role', ['Guru/Karyawan', 'Walikelas'])->get(),
        ];
        return view('admin.jadwal.index', $data);
    }

    public function guru($nig)
    {
        $data = [
            'title' => 'Pilih Kelas',
            'kelas' => Kelas::get()
        ];
        return view('admin.jadwal.guru', $data);
    }

    public function view_table($nig, $id_kelas)
    {
        $guru = Users::where('role', 'Guru/Karyawan')->where('nig', $nig)->firstOrFail();
        $kelas = Kelas::where('id', $id_kelas)->firstOrFail();

        $data = [
            'title' => 'Table Jadwal',
            'jadwals' => Jadwal::where('id_kelas', $id_kelas)->orderBy('jam_mulai', 'desc')->get(),
            'mapel' => Mata_Pelajaran::get(),
            'jam_terpakai' => Jadwal::where('id_kelas', $id_kelas)->selectRaw("CONCAT(jam_mulai, '-', jam_akhir) as jam")->pluck('jam')->toArray(),

            'id_guru' => $guru->id,
            'nama_guru' => $guru->nama_lengkap,
            'nig' => $guru->nig,

            'nama_kelas' => $kelas->nama_kelas
        ];
        return view('admin.jadwal.table', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'jam' => 'required',
        ]);

        $jam = explode('-', $request->jam);
        $jam_mulai = $jam[0];
        $jam_akhir = $jam[1];

        Jadwal::create([
            'id_user' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->mapel,
            'jam_mulai' => $jam_mulai,
            'jam_akhir' => $jam_akhir,
            'status' => 'Menunggu Jam'
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil dibuat!');
    }

    public function edit($nig, $id_kelas, $id_jadwal)
    {
        $guru = Users::where('role', 'Guru/Karyawan')->where('nig', $nig)->firstOrFail();
        $kelas = Kelas::where('id', $id_kelas)->firstOrFail();

        $data = [
            'title' => 'Edit Jadwal',
            'jadwals' => Jadwal::where('id_kelas', $id_kelas)->orderBy('jam_mulai', 'desc')->get(),
            'mapel' => Mata_Pelajaran::get(),
            'jam_terpakai' => Jadwal::where('id_kelas', $id_kelas)->selectRaw("CONCAT(jam_mulai, '-', jam_akhir) as jam")->pluck('jam')->toArray(),

            'id_guru' => $guru->id,
            'nama_guru' => $guru->nama_lengkap,
            'nig' => $guru->nig,

            'nama_kelas' => $kelas->nama_kelas,
            'jadwalEdit' => Jadwal::where('id', $id_jadwal)->firstOrFail(),
        ];
        return view('admin.jadwal.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::where('id', $id)->firstOrFail();
        $request->validate([
            'mapel' => 'required',
            'jam' => 'required',
        ]);

        $jam = explode('-', $request->jam);
        $jam_mulai = $jam[0];
        $jam_akhir = $jam[1];

        Jadwal::where('id', $id)->update([
            'id_mata_pelajaran' => $request->mapel,
            'jam_mulai' => $jam_mulai,
            'jam_akhir' => $jam_akhir,
        ]);

        return redirect()->route('jadwal.two', ['nig' => $jadwal->guru->nig, 'id_kelas' => $jadwal->id_kelas])->with('success', 'Jadwal berhasil diupdate!');
    }

    public function delete($id)
    {
        $jadwal = Jadwal::where('id', $id)->firstOrFail();
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil didelete!');
    }
}
