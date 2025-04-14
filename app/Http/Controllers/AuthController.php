<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Riwayat_Kelas;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn_nig' => 'required',
            'password' => 'required'
        ]);


        if ($user = Users::where('nisn', $request->nisn_nig)->first()) {
            $user = Users::where('nisn', $request->nisn_nig)->first();
        } else {
            $user = Users::where('nig', $request->nisn_nig)->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->role == 'Admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role == 'Kurikulum') {
                return redirect()->route('dashboard.kurikulum');
            } elseif ($user->role == 'Walikelas') {
                return redirect()->route('dashboard.walikelas');
            } elseif ($user->role == 'Guru/Karyawan') {
                return redirect()->route('dashboard.guru');
            } elseif ($user->role == 'Siswa') {
                return redirect()->route('dashboard.siswa');
            } else {
                echo 'role tidak ditemukan';
            }
        } else {
            return back()->with('error', 'Incorrect username/password!');
        }
    }

    public function register()
    {
        $data = [
            'provincys' => $this->_getCity(),
            'kelas' => Kelas::get(),
        ];
        return view('auth.register', $data);
    }

    public function registerStore(Request $request)
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

        return redirect()->route('login')->with('success', 'Registrasi silahkan login, Gunakan NISN Untuk Siswa!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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
