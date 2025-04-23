<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'booking_id',
        'name',
        'contact',
        'address',
        'borrowed_at',
        'returned_at',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
