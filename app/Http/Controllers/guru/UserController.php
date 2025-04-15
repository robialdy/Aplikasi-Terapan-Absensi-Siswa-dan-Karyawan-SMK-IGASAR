<?php

namespace App\Http\Controllers\guru;

use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'users' => Users::whereIn('role', ['Admin', 'Guru/Karyawan'])->orderBy('created_at', 'desc')->get()
        ];
        return view('guru.guru.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'provincys' => $this->_getCity(),
        ];
        return view('guru.guru.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'bidang' => 'required',
            'tahun_masuk' => 'required',
            'no_hp' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_lengkap' => 'required',
            'role' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'password' => 'required|min:8|confirmed'
        ]);

        $picture_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('assets/images/profile'), $picture_name);


        $user = Users::create([
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'bidang' => $request->bidang,
            'nig' => $request->nig,
            'tahun_masuk' => $request->tahun_masuk,
            'no_hp' => $request->no_hp,
            'ttl' => $request->kota_lahir . ', ' . $request->tanggal_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'role' => $request->role,
            'image' => $picture_name,
            'status' => 'Active',
            'password' => Hash::make($request->password)
        ]);

        if ($request->role == 'Guru/Karyawan') {
            $this->generateQrCode($user);
        }

        return redirect()->route('guru.user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit User',
            'user' => Users::where('slug', $slug)->firstOrFail(),
            'provincys' => $this->_getCity(),
        ];
        return view('guru.guru.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nig' => 'required',
            'bidang' => 'required',
            'tahun_masuk' => 'required',
            'no_hp' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_lengkap' => 'required',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'password' => 'nullable|min:8|confirmed'
        ]);

        // ambil data default
        $user = Users::where('id', $id)->firstOrFail();

        // cek gambar di update ga
        if ($request->hasFile('image')) {
            $picture_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images/profile'), $picture_name);
        } else {
            $picture_name = $user->image;
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'bidang' => $request->bidang,
            'nig' => $request->nig,
            'tahun_masuk' => $request->tahun_masuk,
            'no_hp' => $request->no_hp,
            'ttl' => $request->kota_lahir . ', ' . $request->tanggal_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'role' => $request->role,
            'image' => $picture_name,
        ];
        // cek pass di isi ga
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        Users::where('id', $id)->update($data);

        return redirect()->route('guru.user')->with('success', 'User berhasil diupdate!');
    }

    public function delete($id)
    {
        $user = Users::where('id', $id)->firstOrFail();
        $user->delete();

        return redirect()->route('guru.user')->with('success', 'User berhasil didelete!');
    }

    private function _getCity()
    {
        $fileJson = storage_path('app/public/city.json');
        $dataCity = json_decode(file_get_contents($fileJson), true);

        return $dataCity;
    }

    private function generateQrCode($user)
    {
        // data siswa
        $data = [
            'id' => $user->id,
        ];
        $qrData = json_encode($data);

        $qrCode = QrCode::format('svg')->size(200)->generate($qrData);

        $qrfileName = time() . '.svg';
        $qrCodePath = public_path('assets/images/qrcode/' . $qrfileName);
        file_put_contents($qrCodePath, $qrCode);

        $user->update(['barcode' => $qrfileName]);
    }
}
