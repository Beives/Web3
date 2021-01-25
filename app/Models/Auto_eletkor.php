<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auto;

class Auto_eletkor extends Model
{
    public $table = "auto_eletkor";
    use HasFactory;

    public function auto()
    {
        return $this->belongsTo(Auto::class, 'kor','id');
    }
}