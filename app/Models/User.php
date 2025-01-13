<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable 
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "users";
    protected $primaryKey = "id_user";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'telepon',
        'user_picture',
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}
