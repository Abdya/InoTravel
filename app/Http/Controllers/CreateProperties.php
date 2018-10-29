<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\CreateProp;
use App\Property;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CreateProperties extends Controller
{
    public function showProperties() {
        $features = Feature::get();
        $towns = Town::where('countryId', 3159)->orderBy('title')->get();

        return view('createProperty', [
           'features' => $features,
           'towns' =>$towns,
        ]);
    }

    public function createProperty (CreateProp $request) {
        $town = Town::find(Input::get('town'));
        $property = new Property(array(
            'title' => Input::get('title'),
            'beds' => Input::get('beds'),
            'address' => Input::get('address'),
            'townId' => $town->id,
            'regionId' => $town->regionId,
            'extraInformation' => Input::get('extraInformation'),
            'photo' => '',
            'ownerId' => \Auth::user()->id,
        ));
        $property->save();
        $property->features()->sync(Input::get('features'));
        $property->save();

        return Redirect::back();
    }
}
