<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "payment";
    protected $primaryKey = "id_payment";

    protected $fillable = [
        'id_booking',
        'payment_method',
        'payment_date',
        'payment_status',
        'total_price',
    ];

    public function bookings()
    {
        return $this->belongsTo(Bookings::class);
    }
}
