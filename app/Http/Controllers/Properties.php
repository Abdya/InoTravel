<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Properties extends Controller
{
    public function list() {
        $where = Input::get('where');
        $properties = Property::with(['owner', 'town'])->get();
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
