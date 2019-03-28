<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Booking;
use App\Feature;
use App\Town;

class PropertyController extends Controller
{
    public function showUserProperties() {
        $user = Auth::user();
        $properties = Property::where('ownerId', $user->id)->with('town')->get();
        
        return response()->json([
            'status' => 200,
            'properties' => $properties
        ], 200);
    }

    public function showIncomingRequests() {
        $user = Auth::user();
        $incomingRequests = Booking::whereHas('property', function ($query) use ($user) {
            $query->where('ownerId', $user->id);
        })->where('status', 1)->with('property.town', 'user')->get();

        return response()->json([
            'status' => 200,
            'incomingRequests' => $incomingRequests
        ], 200);
    }

    public function rejectIncomingRequest() {
        $bookingId = request('bookingId');
        $booking = Booking::find($bookingId);
        $booking->status = 0;
        $booking->save();

        return response()->json([
            'status' => 201
        ], 201);
    }

    public function approveIncomingRequest() {
        $bookingId = request('bookingId');
        $booking = Booking::find($bookingId);
        $booking->status = 2;
        $booking->save();

        return response()->json([
            'status' => 201
        ], 201);
    }

    public function createProperty() {

    }

    public function editUserProperty() {
        
    }

    public function getFeatures() {
        $features = Feature::get();

        return response()->json([
            'status' => 200,
            'features' => $features
        ], 200);
    }

    public function getTowns() {
        $search = request('keyword');

        $towns = Town::where('countryId', 3159)->orderBy('title')->get();

        return response()->json([
            'status' => 200,
            'towns' => $towns
        ], 200);
    }
}
