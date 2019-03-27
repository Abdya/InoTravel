<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Booking;

class PropertyController extends Controller
{
    public function showUserPropertiesAndRequests() {
        $user = Auth::user();
        $incomeRequests = Booking::whereHas('property', function ($query) use ($user) {
            $query->where('ownerId', $user->id);
        })->where('status', 1)->with('property.town', 'user')->get();
        $properties = Property::where('ownerId', $user->id)->with('town')->get();
        
        return response()->json([
            'status' => 200,
            'incomeRequests' => $incomeRequests,
            'properties' => $properties
        ], 200);
    }

    public function editUserProperty() {
        
    }

    public function rejectRequest() {

    }

    public function acceptRequest() {

    }

    public function createProperty() {

    }

    
}
