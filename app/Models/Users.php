<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable = ['nama_lengkap','nis','nisn','ttl','nama_ayah','nama_ibu','tahun_masuk','nig','alamat_lengkap','bidang','barcode','image','role','status','password'];

    use SoftDeletes;
}
