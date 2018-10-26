<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Property;
use App\User;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function showUserInfo() {
        $user = \Auth::user();
        return view('userProfile', ['user'=>$user]);
    }

    public function showUserPropertyInfo($id) {
        $property = Property::find($id);
        $features = Feature::get();
        $towns = \App\Town::where('countryId', 3159)->orderBy('title')->get();
        $user = \Auth::user();

        return view('editUserProperties', [
            'property' => $property,
            'features' => $features,
            'towns' => $towns,
            'user' => $user,
        ]);
    }

    public function showRequestInfo() {
        $bookings = Booking::get();
        return view('requests', [
            'bookings' => $bookings,
        ]);
    }
}
