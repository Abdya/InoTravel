<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function imageStore(Request $request)
    {
       if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
          $path = Storage::disk('public')->url('images/'.$name);
        }

       return response()->json([
           'success' => 'You have successfully uploaded an image',
           'path' => $path
        ], 200);
     }

    public function createProperty() {
        $town = Town::find(request('townId'));
        $property = new Property(array(
            'title' => request('title'),
            'beds' => request('beds'),
            'address' => request('address'),
            'townId' => $town->id,
            'regionId' => $town->regionId,
            'extraInformation' => request('extraInformation'),
            'ownerId' => \Auth::user()->id,
            'photo' => request('photo')
        ));
        $property->save();
        $property->features()->sync(request('features'));
        $property->save();

        return response()->json([
            'status' => 201,
            'propertyId' => $property->id
        ], 201);
    }

    public function showProperty($id) {
        $property = Property::with('owner')->find($id);
        $user = \Auth::user();
        $town = Town::find($property->townId);
        
        return response()->json([
            'property' => $property,
            'town' => $town,
            'user' => $user,
            'status' => 200
        ], 200);
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
