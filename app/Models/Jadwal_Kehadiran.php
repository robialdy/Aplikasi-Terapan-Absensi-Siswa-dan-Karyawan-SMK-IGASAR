<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal_Kehadiran extends Model
{
    protected $table = 'jadwal_kehadiran';

    protected $fillable = ['id_kehadiran','id_jadwal','waktu_absen','status'];

    use SoftDeletes;

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class, 'id_kehadiran');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

}
