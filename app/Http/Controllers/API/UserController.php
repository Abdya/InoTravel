<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeUserData() {
        $firstName = request('firstName');
        $lastName = request('lastName');
        $email = request('email');

        $user = \Auth::user();

        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->email = $email;
        $user->save();

        return response()->json([
            'status' => 201
        ], 201);
    }

    public function changeUserPass() {
        $user = \Auth::user();

        $oldPassword = request('oldPassword');
        $newPassword = request('password');

        if (\Hash::check($oldPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return response()->json([
                'status' => 201
            ], 201);
        }

        return response()->json([
            'status' => 400,
            'user' => $user,
            'statement' => Hash::check($oldPassword, $user->password)
        ], 400);
    }
}
