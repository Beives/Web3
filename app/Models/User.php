<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_cars;

class User extends Model
{
    public $table = "users";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'nev'
    ];

    public function auto()
    {
        return $this->belongsTo(User_cars::class, 'user','id');
    }
}
