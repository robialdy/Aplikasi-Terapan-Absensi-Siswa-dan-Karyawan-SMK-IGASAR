<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('ttl');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->integer('tahun_masuk');
            $table->string('nig')->nullable();
            $table->text('alamat_lengkap');
            $table->string('bidang');
            $table->string('barcode')->nullable();
            $table->string('image');
            $table->enum('role', ['Admin','Siswa','Guru/Karyawan','Kurikulum','Walikelas']);
            $table->string('status');
            $table->string('password', 350);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
