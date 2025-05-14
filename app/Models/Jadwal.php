<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
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
    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
    public function contoh()
    {
        return $this->hasMany(Contoh::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
