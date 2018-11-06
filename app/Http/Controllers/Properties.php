<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class Properties extends Controller
{
    public function list() {
        $townsForRes = \App\Town::where('countryId', 3159)->orderBy('title')->get();
        $startDate = Carbon::createFromFormat('d/m/Y', Input::get('startDate'))->toDateTimeString();
        $endDate = Carbon::createFromFormat('d/m/Y', Input::get('endDate'))->toDateTimeString();
        $town = Input::get('town');
        $guests = Input::get('guests');
        $propertyIds = DB::select('
              select p.id
              from properties as p
              left join bookings as b
                on p.id = b.propertyId
             where (p.townId = :townId)
                and (:beds1 is null or p.beds >= :beds2)
                and (b.id is null or b.status = 0 or ((:startDate1 < b.startDate and :endDate1 < b.startDate) or (:startDate2 > b.endDate and :endDate2 > b.endDate)))',
                    [
                        'townId' => $town,
                        'beds1' => $guests,
                        'beds2' => $guests,
                        'startDate1' => $startDate,
                        'startDate2' => $startDate,
                        'endDate1' => $endDate,
                        'endDate2' => $endDate,
                    ]);
        $properties = Property::find(array_map(function ($property){ return $property->id; }, $propertyIds));


        return view('searchResults', [
            'properties' => $properties,
            'user' => Auth::user(),
            'townsForRes' => $townsForRes,
            'startDate' => Input::get('startDate'),
            'endDate' => Input::get('endDate'),
            'currentTown' => $town,
            'guests' => $guests,
        ]);
    }

    public function singleProperty($id) {
        $property = Property::with('owner')->find($id);
        $user = Auth::user();
        return view('singleProperty', [
            'property' => $property,
            'user' => $user,
        ]);
    }
}
