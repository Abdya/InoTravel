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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function deleteProperty($id) {
        $prop = Property::find($id);
        $prop->delete();
        Booking::where('propertyId', $id)->delete();

        return response()->json([
            'status' => 201
        ], 201);
    }

    public function showProperty($id) {
        $property = Property::with('owner')->find($id);
        $user = Auth::user();
        $town = Town::find($property->townId);
        $features = $property->features;

        return response()->json([
            'property' => $property,
            'town' => $town,
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function editProperty() {
        $property = Property::find(request('propertyId'));
        $town = \App\Town::find(request('townId'));
        $property->title = request('title');
        $property->beds = request('beds');
        $property->address = request('address');
        $property->townId = $town->id;
        $property->regionId = $town->regionId;
        $property->extraInformation = request('extraInformation');
        $property->ownerId = Auth::user()->id;
        $property->photo = request('photo');
        
        $property->save();
        $property->features()->sync(request('features'));
        $property->save();

        return response()->json([
            'status' => 201,
            'propertyId' => $property->id
        ], 200);
    }

    public function getFeatures() {
        $features = Feature::get();

        return response()->json([
            'status' => 200,
            'features' => $features
        ], 200);
    }

    public function getTowns() {
        $towns = Town::where('countryId', 3159)->orderBy('title')->get();

        return response()->json([
            'status' => 200,
            'towns' => $towns
        ], 200);
    }

    public function searchProperties() {
        $startDate = Carbon::createFromTimestamp(request('startDate'))->toDateTimeString();
        $endDate =  Carbon::createFromTimestamp(request('endDate'))->toDateTimeString();
        $townId = request('townId');
        $town = Town::find($townId);
        $guests = request('guests');
        $propertyIds = collect(DB::select('
              select p.id
              from properties as p
              left join bookings as b
                on p.id = b.propertyId
             where (p.townId = :townId)
                and (:beds1 is null or p.beds >= :beds2)
                and (b.id is null or b.status = 0 or ((:startDate1 < b.startDate and :endDate1 < b.startDate) or (:startDate2 > b.endDate and :endDate2 > b.endDate)))',
                    [
                        'townId' => $townId,
                        'beds1' => $guests,
                        'beds2' => $guests,
                        'startDate1' => $startDate,
                        'startDate2' => $startDate,
                        'endDate1' => $endDate,
                        'endDate2' => $endDate,
                    ]))
            ->pluck('id')
            ->all();

        $properties = Property::with('owner')
            ->whereIn('id', $propertyIds)
            ->get();


        return response()->json([
            'properties' => $properties,
            'date1' => $startDate,
            'date2' => $endDate,
            'town' => $town,
            'status' => 200
        ], 200);
    }

    public function getTownsWherePropertyExist() {
        $townIDs = Property::pluck('townId')->unique()->all();
        $towns = Town::whereIn('id', $townIDs)->orderBy('title', 'asc')->get();

        return response()->json([
            'towns' => $towns,
            'status' => 200
        ], 200);
    }

    public function getUserRequestHistory() {
        $user = Auth::user();
        $submittedRequests = Booking::join('properties', 'properties.id', '=', 'bookings.propertyId')
            ->where('guestId', $user->id)
            ->with('owner')
            ->with('town')
            ->get();
        $receivedRequests = Booking::join('properties', 'properties.id', '=', 'bookings.propertyId')
            ->where('properties.ownerId', $user->id)
            ->with('town')
            ->with('user')
            ->get();
        
        return response()->json([
            'user' => $user,
            'submittedRequests' => $submittedRequests,
            'receivedRequests' => $receivedRequests,
            'status' => 200
        ], 200);
    }
}
