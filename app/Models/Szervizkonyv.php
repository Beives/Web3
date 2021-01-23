<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auto;

class Szervizkonyv extends Model
{
    public $table = "szervizkonyv";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'garancialis',
        'szerviz_kezdete',
        'szerviz_vege',
        'auto'
    ];
    public function autos()
    {
        return $this->hasMany(Auto::class, 'id', 'auto');
    }
    
}
