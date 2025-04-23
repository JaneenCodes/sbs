<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'status',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointments::class);
    }
    

}
