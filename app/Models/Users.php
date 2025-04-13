<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['nama_lengkap','nis','nisn','ttl','nama_ayah','nama_ibu','tahun_masuk','nig','alamat_lengkap','bidang','barcode','image','role','status','password','slug','no_hp','status'];

    use SoftDeletes;
}
