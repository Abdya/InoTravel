<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property', 'propertyId');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'guestId');
    }


    public function town()
    {
        return $this->belongsTo('App\Town', 'townId');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'ownerId');
    }

    public function bookingId()
    {
        return $this->belongsTo('App\Booking', 'id');
    }

    protected $fillable = [
        'startDate',
        'endDate',
        'quantityGuests',
        'sendDate',
        'guestId',
        'status',
        'propertyId',
    ];
}
