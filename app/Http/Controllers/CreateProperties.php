<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\CreateProp;
use App\Http\Requests\ImageUp;
use App\Property;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CreateProperties extends Controller
{
    public function showProperties() {
        $features = Feature::get();
        $user = Auth::user();
        $towns = Town::where('countryId', 3159)->orderBy('title')->get();

        return view('createProperty', [
            'features' => $features,
            'towns' => $towns,
            'user' => $user,
        ]);
    }


    public function createProperty (CreateProp $request) {
        $town = Town::find(Input::get('town'));
        $path = $request->file('photo')->store('roomPicture', 'public');
        $property = new Property(array(
            'title' => Input::get('title'),
            'beds' => Input::get('beds'),
            'address' => Input::get('address'),
            'townId' => $town->id,
            'regionId' => $town->regionId,
            'extraInformation' => Input::get('extraInformation'),
            'ownerId' => \Auth::user()->id,
            'photo' => Storage::disk('public')->url($path),
        ));
        $property->save();
        $property->features()->sync(Input::get('features'));
        $property->save();

        return Redirect::to('/profile/properties/' . $property->id);
    }
}
