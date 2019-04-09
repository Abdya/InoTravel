<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function changeUserData() {
        $data = [
            'firstName' => request('firstName'),
            'lastName' => request('lastName'),
            'email' => request('email')
        ];
        $validator = Validator::make($data, [
            'firstName' => 'required|string|min:2|max:60',
            'lastName' => 'required|string|min:2|max:60',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

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
        $data = [
            'oldPassword' => request('oldPassword'),
            'newPassword' => request('password'),
        ];
        $validator = Validator::make($data, [
            'oldPassword' => 'required|string|max:1024|min:6',
            'newPassword' => 'required|string|max:1024|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

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
            'statement' => Hash::check($oldPassword, $user->password)
        ], 400);
    }
}
