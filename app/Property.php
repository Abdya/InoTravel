<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function owner1()
    {
        return $this->belongsTo('App\User', 'owner');
    }
}
