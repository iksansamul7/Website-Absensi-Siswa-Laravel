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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('jadwal_id'); 
            $table->BigInteger('contoh_id');
            $table->BigInteger('kelas_id'); 
            $table->BigInteger('semester_id');
            $table->BigInteger('pelajaran_id'); 
            $table->string('tipekelas')->nullable();
            $table->BigInteger('pertemuan');
            $table->enum('present', ['hadir', 'alpha', 'izin', 'sakit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
