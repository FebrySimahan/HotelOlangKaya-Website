<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "rooms";
    protected $primaryKey = "id_room";

    protected $fillable = [
        'id_room_type',
        'room_number',
        'status',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function transaksiKamar()
    {
        return $this->hasMany(TransaksiKamar::class);
    }
}
