<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hari_Libur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HariLiburController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Hari Libur',
            'hari_liburs' => Hari_Libur::orderBy('created_at', 'desc')->get()
        ];
        return view('admin.hari_libur.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Hari Libur'
        ];
        return view('admin.hari_libur.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
        ]);

        Hari_Libur::create([
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'keterangan' => $request->keterangan,
            'slug' => Str::slug($request->keterangan)
        ]);

        return redirect()->route('harilibur')->with('success', 'Hari Libur berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Hari Libur',
            'hari_libur' => Hari_Libur::where('slug', $slug)->firstOrFail(),
        ];
        return view('admin.hari_libur.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
        ]);

        Hari_Libur::where('id', $id)->update([
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'keterangan' => $request->keterangan,
            'slug' => Str::slug($request->keterangan)
        ]);

        return redirect()->route('harilibur')->with('success', 'Hari Libur berhasil diupdate!');
    }

    public function delete($id)
    {
        $hari_libur = Hari_Libur::where('id', $id)->firstOrFail();
        $hari_libur->delete();

        return redirect()->route('harilibur')->with('success', 'Hari Libur berhasil didelete');
    }
}
