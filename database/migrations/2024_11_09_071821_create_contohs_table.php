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
        Schema::create('contohs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->BigInteger('kelas_id');
            $table->enum('jeniskelamin',['cowok','cewek']); 
            $table->string('tipekelas')->nullable();
            $table->bigInteger('nissiswa'); 
            $table->BigInteger('semester_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contohs');
    }
};
