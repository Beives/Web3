<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Szervizkonyv;
use App\Models\Auto_eletkor;
use App\Models\User_cars;

class Auto extends Model
{
    public $table = "auto";
    use HasFactory;

    protected $fillable = [
        'marka',
        'tipus',
        'kor'
    ];

    public function szervizkonyv()
    {
        return $this->belongsTo(Szervizkonyv::class, 'auto','id');
    }
    public function user_cars()
    {
        return $this->belongsTo(User_cars::class, 'auto', 'id');
    }
    public function auto_eletkors()
    {
        return $this->hasMany(Auto_eletkor::class, 'id','kor');
    }
    
}