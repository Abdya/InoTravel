<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class Properties extends Controller
{
    public function list() {
        $properties = Property::with('owner1')->get();
        return view('searchResults', ['properties'=>$properties]);
    }
}
