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
}
