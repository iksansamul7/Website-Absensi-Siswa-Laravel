<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory; 
    protected $guarded = [];

    public function wakel(){
        return $this->hasMany(Wakel::class);
    }
    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }
    public function presensi(){
        return $this->hasMany(Presensi::class);
    }

}

