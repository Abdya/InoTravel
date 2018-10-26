<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class Properties extends Controller
{
    public function list() {
        $properties = Property::with('owner')->get();
        return view('searchResults', ['properties'=>$properties]);
    }

    public function singleProperty($id) {
        $property = Property::with('owner')->find($id);
        return view('singleProperty', ['property'=>$property]);
    }
}
