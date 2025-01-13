<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "admin";
    protected $primaryKey = "id_admin";

    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_password',
        'admin_telp',
        'admin_picture',
    ];
}
