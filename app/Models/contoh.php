<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contoh extends Model
{
    use HasFactory; 
    protected $guarded = [];
    
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
