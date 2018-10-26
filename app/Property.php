<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\User', 'ownerId');
    }

    public function town()
    {
        return $this->belongsTo('App\Town', 'townId');
    }

    public function region()
    {
        return $this->belongsTo('App\Region', 'regionId');
    }

    public function features()
    {
        return $this->belongsToMany('App\Feature', 'properties_features', 'featureId', 'propertyId');
    }
}
