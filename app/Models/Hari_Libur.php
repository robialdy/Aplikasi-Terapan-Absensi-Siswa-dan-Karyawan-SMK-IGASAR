<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hari_Libur extends Model
{
    protected $table = 'hari_libur';

    protected $fillable = ['tgl_mulai','tgl_selesai','keterangan'];

    use SoftDeletes;
}
