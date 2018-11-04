<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ChangeUserData;
use App\Http\Requests\ChangeUserPassword;
use App\Http\Requests\editProp;
use App\Property;
use App\Booking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller
{

    public function showUserInfo() {
        $user = \Auth::user();
        return view('userProfile', ['user'=>$user]);
    }

    public function editUserData(ChangeUserData $request) {
        $user = \Auth::user();

        $user->firstName = Input::get('firstName');
        $user->lastName = Input::get('lastName');
        $user->email = Input::get('email');
        $user->save();

        return Redirect::back();
    }

    public function editUserPassword(ChangeUserPassword $request) {
        $user = \Auth::user();

        $old_password = Input::get('old_password');
        $user_password = $user->password;
        $password = Input::get('password');
        if (Hash::check($old_password, $user_password)) {
            $user->password = Hash::make($password);
            $user->save();
        }

        return Redirect::back();
    }

    public function showUserPropertyInfoForEdit($id) {
        $property = Property::find($id);
        $features = Feature::get();
        $towns = \App\Town::where('countryId', 3159)->orderBy('title')->get();
        $user = \Auth::user();

        return view('editUserProperties', [
            'property' => $property,
            'features' => $features,
            'towns' => $towns,
            'user' => $user,
        ]);
    }

    public function showUserPropertyInfo($id) {
        $property = Property::find($id);
        $features = Feature::get();
        $user = \Auth::user();
        $town = \App\Town::find($property->townId);

        return view('SingleUserProperty', [
            'property' => $property,
            'features' => $features,
            'user' => $user,
            'town' => $town,
        ]);
    }

    public function editProperty (editProp $request, $id) {
        $property = Property::find($id);
        $town = \App\Town::find(Input::get('town'));
        $property->title = Input::get('title');
        $property->beds = Input::get('beds');
        $property->address = Input::get('address');
        $property->townId = $town->id;
        $property->regionId = $town->regionId;
        $property->extraInformation = Input::get('extraInformation');
        $property->ownerId = Auth::user()->id;
        if ($request->file('photo') !== null) {
            $path = $request->file('photo')->store('roomPicture', 'public');
            $property->photo = Storage::disk('public')->url($path);
        }
        $property->save();
        $property->features()->sync(Input::get('features'));
        $property->save();

        return Redirect::to('/profile/properties/' . $property->id);
    }

    public function showRequestsAndProperties() {
        $user = Auth::user();
        $requests = Booking::with(['property' => function ($query) use ($user) {
            $query->where('ownerId', $user->id);
        }])->get();
        $properties = Property::where('ownerId', Auth::user()->id)->get();
        return view('myProperties', [
            'user' => $user,
            'requests' => $requests,
            'properties' => $properties,
        ]);
    }

    public function showRequestInfo() {
        $user = Auth::user();
        $bookings = Booking::get();
        return view('requests', [
            'bookings' => $bookings,
            'user' => $user,
        ]);
    }
    public function showUserForWelcome() {
        $user = Auth::user();
        return view('welcome', [ 'user' => $user]);
    }
}
