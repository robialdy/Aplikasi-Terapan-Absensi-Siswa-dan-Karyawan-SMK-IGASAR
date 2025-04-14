<?php

namespace App\Http\Controllers\admin;

use App\Models\Kelas;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Riwayat_Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengguna Siswa',
            'siswa' => Users::where('role', 'Siswa')->orderBy('created_at', 'desc')->get()
        ];
        return view('admin.siswa.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna Siswa',
            'provincys' => $this->_getCity(),
            'kelas' => Kelas::get()
        ];
        return view('admin.siswa.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tahun_masuk' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'no_hp' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_lengkap' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'password' => 'required|min:8|confirmed',
            // 'kelas' => 'required',
            'tgl_masuk' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        $picture_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('assets/images/profile'), $picture_name);

        $siswa = Users::create([
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'tahun_masuk' => $request->tahun_masuk,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'no_hp' => $request->no_hp,
            'ttl' => $request->kota_lahir . ', ' . $request->tanggal_lahir,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'alamat_lengkap' => $request->alamat_lengkap,
            'image' => $picture_name,
            'password' => Hash::make($request->password),
            'role' => 'Siswa',
            'status' => 'Aktif',
            'bidang' => 'Pelajar'
        ]);

        Riwayat_Kelas::create([
            'id_user' => $siswa->id,
            'id_kelas' => $request->kelas,
            'tgl_masuk' => $request->tgl_masuk,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => 'Aktif',
        ]);

        $this->generateQrCode($siswa);

        return redirect()->route('siswa')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Pengguna Siswa',
            'provincys' => $this->_getCity(),
            'siswa' => Users::where('slug', $slug)->firstOrFail()
        ];
        return view('admin.siswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tahun_masuk' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'no_hp' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_lengkap' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'password' => 'nullable|min:8|confirmed'
        ]);

        // ambil data default
        $siswa = Users::where('id', $id)->firstOrFail();

        // cek gambar di update ga
        if ($request->hasFile('image')) {
            $picture_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images/profile'), $picture_name);
        } else {
            $picture_name = $siswa->image;
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'tahun_masuk' => $request->tahun_masuk,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'no_hp' => $request->no_hp,
            'ttl' => $request->kota_lahir . ', ' . $request->tanggal_lahir,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'alamat_lengkap' => $request->alamat_lengkap,
            'image' => $picture_name,
        ];

        // cek pass di ganti ga
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        Users::where('id', $id)->update($data);

        return redirect()->route('siswa')->with('success', 'Siswa berhasil diupdate!');
    }

    public function delete($id)
    {
        $siswa = Users::where('id', $id)->firstOrFail();
        $siswa->delete();

        return redirect()->route('siswa')->with('success', 'Siswa berhasil didelete!');
    }

    private function _getCity()
    {
        $fileJson = storage_path('app/public/city.json');
        $dataCity = json_decode(file_get_contents($fileJson), true);

        return $dataCity;
    }

    private function generateQrCode($siswa)
    {
        // data siswa
        $data = [
            'id' => $siswa->id,
        ];
        $qrData = json_encode($data);

        $qrCode = QrCode::format('svg')->size(200)->generate($qrData);

        $qrfileName = time() . '.svg';
        $qrCodePath = public_path('assets/images/qrcode/' . $qrfileName);
        file_put_contents($qrCodePath, $qrCode);

        $siswa->update(['barcode' => $qrfileName]);
    }
}
