<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mata_Pelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama_pelajaran','keterangan','slug'];

    use SoftDeletes;
}
