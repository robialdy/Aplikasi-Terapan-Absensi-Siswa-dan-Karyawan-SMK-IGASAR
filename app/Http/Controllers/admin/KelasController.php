<?php

namespace App\Http\Controllers\admin;

use App\Models\Kelas;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'kelas' => Kelas::orderBy('created_at', 'desc')->get()
        ];
        return view('admin.kelas.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kelas',
            'walikelas' => Users::where('role', 'Walikelas')->get()
        ];
        return view('admin.kelas.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas',
            'walikelas' => 'required',
            'keterangan' => 'required',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_user' => $request->walikelas,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => Kelas::where('id', $id)->firstOrFail(),
            'walikelas' => Users::where('role', 'Walikelas')->get()
        ];
        return view('admin.kelas.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => [
                'required',
                Rule::unique('kelas')->ignore($id)
            ],
            'walikelas' => 'required',
            'keterangan' => 'required',
        ]);

        Kelas::where('id', $id)->update([
            'nama_kelas' => $request->nama_kelas,
            'id_user' => $request->walikelas,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diupdate!');
    }

    public function delete($id)
    {
        $kelas = Kelas::where('id', $id)->firstOrFail();
        $kelas->delete();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil didelete!');
    }
}
