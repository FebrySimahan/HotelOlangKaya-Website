<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallPackage extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "hall_package";
    protected $primaryKey = "id_hall_package";

    protected $fillable = [
        'package_name',
        'price',
        'capacity',
        'facility',
        'description',
        'package_picture',
    ];

    public function transaksiHall()
    {
        return $this->hasMany(TransaksiHall::class);
    }
}
