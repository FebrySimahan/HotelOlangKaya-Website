<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHall extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "transaksi_hall";
    protected $primaryKey = "id_transaksi_hall";

    protected $fillable = [
        'id_booking',
        'id_hall_package',
        'event_name',
        'attendee_number',
        'start_time',
        'end_time',
    ];

    public function bookings()
    {
        return $this->belongsTo(Bookings::class);
    }

    public function hallPackage()
    {
        return $this->belongsTo(HallPackage::class);
    }
}
