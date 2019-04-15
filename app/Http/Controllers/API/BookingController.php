<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Booking;

class BookingController extends Controller
{
    public function bookingRequest($id) {
        if (Property::find($id) === null) {
            return response()->json([
                'status' => 404
            ], 404);
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
                'beds1' => request('guests'),
                'start1' => Carbon::createFromTimestamp(request('startDate'))->toDateTimeString(),
                'start2' => Carbon::createFromTimestamp(request('startDate'))->toDateTimeString(),
                'end1' => Carbon::createFromTimestamp(request('endDate'))->toDateTimeString(),
                'end2' => Carbon::createFromTimestamp(request('endDate'))->toDateTimeString(),
            ]);
        if (count($bookingIds) > 0) {
            $booking = new \App\Booking(array(
                'startDate' => Carbon::createFromTimestamp(request('startDate'))->toDateTimeString(),
                'endDate' => Carbon::createFromTimestamp(request('endDate'))->toDateTimeString(),
                'quantityGuests' => request('guests'),
                'sendDate' => Carbon::now()->toDateTimeString(),
                'guestId' => Auth::user()->id,
                'status' => 1,
                'propertyId' => $id,

            ));
            $booking->save();

            return response()->json([
                'status' => 200,
                'msg' => 'Забронировано!'
            ], 200);
        }
        else {
            return response()->json([
                'status' => 422,
                'msg' => 'Данный срок уже занят!'
            ], 422);
        }

    }

    public function recallRequest() {
        $id = request('bookingId');
        Booking::where('id', $id)->delete();

        return response()->json([
            'status' => 201
        ], 201);
    }
}
