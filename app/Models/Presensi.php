<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory; 
    protected $guarded = [];
    
    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function pelajaran(){
        return $this->belongsTo(Pelajaran::class);
    }
    public function contoh(){
        return $this->belongsTo(contoh::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
