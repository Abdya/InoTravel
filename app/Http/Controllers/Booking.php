<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guests;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Booking extends Controller
{
    public function bookingRequest($id, Guests $request) {
        if (Property::find($id) === null) {
            Redirect::route('/properties');
        }
        $bookingIds = DB::select('
        select p.id
        from properties as p
      left join bookings as b
        on p.id = b.propertyId
      where p.id=:id
        and (p.beds >= :beds1)
        and (b.id is null or b.status = 2 or ((:start1 < b.startDate and :end1 < b.startDate) or (:start2 > b.endDate and :end2 > b.endDate)))',
            [
                'id' => $id,
                'beds1' => Input::get('guests'),
                'start1' => Carbon::createFromFormat('d/m/Y', Input::get('startDate'))->toDateTimeString(),
                'start2' => Carbon::createFromFormat('d/m/Y', Input::get('startDate'))->toDateTimeString(),
                'end1' => Carbon::createFromFormat('d/m/Y', Input::get('endDate'))->toDateTimeString(),
                'end2' => Carbon::createFromFormat('d/m/Y', Input::get('endDate'))->toDateTimeString(),
            ]);
        if (count($bookingIds) > 0) {
            $booking = new \App\Booking(array(
                'startDate' => Carbon::createFromFormat('d/m/Y', Input::get('startDate'))->toDateTimeString(),
                'endDate' => Carbon::createFromFormat('d/m/Y', Input::get('endDate'))->toDateTimeString(),
                'quantityGuests' => Input::get('guests'),
                'sendDate' => Carbon::now()->toDateTimeString(),
                'guestId' => Auth::user()->id,
                'status' => 1,
                'propertyId' => $id,

            ));
            $booking->save();

            return Redirect::to('/properties/' . $id);
        }
        else {
            return Redirect::back()->withErrors(['error' => 'Данный срок уже занят!']);
        }

    }
}
