<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guests;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class Booking extends Controller
{
    public function bookingRequest($id, Guests $request) {
        if (Property::find($id) === null) {
            Redirect::route('/properties');
        }
        $booking = new \App\Booking(array(
            'startDate' => Carbon::createFromFormat('Y/m/d', Input::get('startDate_submit'))->toDateTimeString(),
            'endDate' => Carbon::createFromFormat('Y/m/d', Input::get('endDate_submit'))->toDateTimeString(),
            'quantityGuests' => Input::get('guests'),
            'sendDate' => Carbon::now()->toDateTimeString(),
            'guestId' => Auth::user()->id,
            'status' => 1,
            'propertyId' => $id,
        ));
        $booking->save();

        return Redirect::to('/properties/' . $id);
    }
}
