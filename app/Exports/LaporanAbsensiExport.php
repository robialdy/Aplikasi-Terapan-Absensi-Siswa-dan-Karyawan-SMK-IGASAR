<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanAbsensiExport implements FromCollection
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = DB::table('kehadiran as h')
            ->join('users as u', 'h.id_user', '=', 'u.id')
            ->join('jadwal_kehadiran as jk', 'jk.id_kehadiran', '=', 'h.id')
            ->join('jadwal as j', 'jk.id_jadwal', '=', 'j.id')
            ->join('kelas as k', 'j.id_kelas', '=', 'k.id')
            ->join('mata_pelajaran as mp', 'j.id_mata_pelajaran', '=', 'mp.id')
            ->select(
                'u.nama_lengkap',
                'k.nama_kelas',
                'mp.nama_pelajaran',
                'h.tanggal',
                'h.datang_pukul as jam_masuk',
                'jk.waktu_absen as jam_keluar',
                'h.status as status_kehadiran'
            );

        // Filter sesuai request
        if ($this->filter['type'] == 'harian') {
            $query->whereDate('h.tanggal', $this->filter['tanggal']);
        } elseif ($this->filter['type'] == 'bulanan') {
            $query->whereMonth('h.tanggal', $this->filter['bulan'])
                ->whereYear('h.tanggal', $this->filter['tahun']);
        } elseif ($this->filter['type'] == 'semester') {
            $query->whereBetween('h.tanggal', [$this->filter['start'], $this->filter['end']]);
        }

        return $query->get();
    }
}
