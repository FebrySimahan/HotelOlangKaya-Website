<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "room_type";
    protected $primaryKey = "id_room_type";

    protected $fillable = [
        'name_type',
        'price',
        'number_of_room',
        'maximum_people',
        'description',
        'facility',
        'room_picture',
    ];

    public function transaksiKamar()
    {
        return $this->hasMany(TransaksiKamar::class);
    }
}
