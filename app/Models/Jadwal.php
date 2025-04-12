<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = ['id_user','id_mata_pelajaran','id_kelas','jam_mulai','jam_akhir'];

    use SoftDeletes;

    public function guru()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'id_mata_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
