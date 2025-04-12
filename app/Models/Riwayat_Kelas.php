<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riwayat_Kelas extends Model
{
    protected $table = 'riwayat_kelas';

    protected $fillable = ['id_user','id_kelas','tahun_ajaran','status','tgl_masuk','tgl_keluar'];

    use SoftDeletes;

    public function siswa()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
