<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';

    protected $fillable = ['id_user','datang_pukul','tanggal','status'];

    use SoftDeletes;

    public function siswa()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }
}
