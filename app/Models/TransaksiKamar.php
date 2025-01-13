<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKamar extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "transaksi_kamar";
    protected $primaryKey = "id_transaksi_kamar";

    protected $fillable = [
        'id_booking',
        'id_room',
        'extra_bed',
        'jumlah_kamar',
    ];

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function bookings()
    {
        return $this->belongsTo(Bookings::class);
    }
}
