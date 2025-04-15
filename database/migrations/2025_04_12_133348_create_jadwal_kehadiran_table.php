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
        Schema::create('jadwal_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kehadiran')->nullable()->constrained('kehadiran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_jadwal')->constrained('jadwal')->onDelete('cascade')->onUpdate('cascade');
            $table->time('waktu_absen')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kehadiran');
    }
};
