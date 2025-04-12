<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['id_user','nama_kelas','keterangan'];

    use SoftDeletes;

    public function waliKelas()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }
}
