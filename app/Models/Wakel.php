<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wakel extends Model
{
    use HasFactory; 
    protected $guarded = [];
    
    public function guru(){
        return $this->belongsTo(Guru::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
