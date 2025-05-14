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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('guru_id');
            $table->BigInteger('kelas_id');
            $table->BigInteger('pelajaran_id'); 
            $table->BigInteger('jamke');  
            $table->BigInteger('semester_id');
            $table->string('tipekelas')->nullable();
            $table->enum('hari',['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);
            $table->time('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
