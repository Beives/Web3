<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auto;
use App\Models\User;

class User_cars extends Model
{
    public $table = "user_cars";
    use HasFactory;

    protected $fillable = [
        'auto',
        'user'
    ];

    public function auto()
    {
        return $this->hasMany(Auto::class, 'id','auto');
    }

    public function user()
    {
        return $this->hasMany(Auto::class, 'id','user');
    }
}
