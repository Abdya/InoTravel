<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Properties extends Controller
{
    public function list() {
        $startDate = Input::get('startDate');
        $endDate = Input::get('endDate');
        $where = Input::get('where');
        $guests = Input::get('guests');
        $properties = DB::select('    select *
      from inotravel.properties as p
      left join inotravel.bookings as b
        on p.Id = b.propertyId
     where (p.townId=@townId)
        and (@beds is null or p.beds >= @beds)
        and (b.id is null or b.status =1 or ((@start < b.startDate and @end < b.startDate) or (@start > b.endDate and @end > b.endDate)) ');


        return view('searchResults', ['properties'=>$properties]);
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
