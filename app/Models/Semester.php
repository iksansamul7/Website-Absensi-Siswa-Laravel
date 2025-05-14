<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory; 
    protected $guarded = [];
    
    public function contoh(){
        return $this->hasMany(contoh::class);
    }
    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }
    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
}
