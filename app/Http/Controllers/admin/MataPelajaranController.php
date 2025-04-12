<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mata_Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Mata Pelajaran',
            'mata_pelajaran' => Mata_Pelajaran::orderBy('created_at')->get()
        ];
        return view('admin.mata_pelajaran.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah',
        ];
        return view('admin.mata_pelajaran.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'keterangan' => 'required'
        ]);

        Mata_Pelajaran::create([
            'nama_pelajaran' => $request->nama_pelajaran,
            'slug' => Str::slug($request->nama_pelajaran),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('matapelajaran')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit',
            'mp' => Mata_Pelajaran::where('slug', $slug)->firstOrFail()
        ];
        return view('admin.mata_pelajaran.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'keterangan' => 'required'
        ]);

        Mata_Pelajaran::where('id', $id)->update([
            'nama_pelajaran' => $request->nama_pelajaran,
            'slug' => Str::slug($request->nama_pelajaran),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('matapelajaran')->with('success', 'Mata Pelajaran berhasil diupdate!');
    }

    public function delete($id)
    {
        $mata_pelajaran = Mata_Pelajaran::where('id', $id)->firstOrFail();
        $mata_pelajaran->delete();

        return redirect()->route('matapelajaran')->with('success', 'Mata Pelajaran berhasil didelete!');
    }
}
