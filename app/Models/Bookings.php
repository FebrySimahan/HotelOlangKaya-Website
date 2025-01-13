<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "bookings";
    protected $primaryKey = "id_booking";

    protected $fillable = [
        'id_user',
        'id_payment',
        'check_in_date',
        'check_out_date',
    ];

    public function transaksiHall()
    {
        return $this->hasOne(TransaksiHall::class);
    }
    
    public function transaksiKamar()
    {
        return $this->hasOne(TransaksiKamar::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
