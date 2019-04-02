<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Support\Str;
use App\Mail\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        $data = [
            'firstName' => request('firstName'),
            'lastName' => request('lastName'),
            'email' => request('email'),
            'password' => request('password')
        ];
        $validator = Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        User::create([
        'firstName' => request('firstName'),
        'lastName' => request('lastName'),
        'email' => request('email'),
        'password' => bcrypt(request('password'))
        ]);

        return response()->json(['status' => 201]);
    }

    public function login(){
        
        $user = User::whereEmail(request('username'))->first();

        if (!$user || !\Hash::check(request('password'), $user->password)) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('username'),
            'password' => request('password'),
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        $data = json_decode($response->getContent());

        return response()->json([
            'token' => $data->access_token,
            'user' => $user,
            'status' => 200
        ]);
    }

    public function logout() {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        
        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }

    public function passwordReset() {
        $email = request('email');
        $user = User::whereEmail($email)->first();

        if (!$user) {
            return response()->json(['status' => 201]);
        }

        $user->setRememberToken(Str::random(60));
        $user->save();

        Mail::to($user->email)->send(new PasswordReset($user));

        return response()->json(['status' => 201]);
    }

    public function passwordResetConfirm() {
        $token = request('token');
        $id = request('user_id');

        $user = User::find($id);

        if ($user->remember_token != $token){
            return response()->json(['status' => 420]);
        }

        $user->password = \Hash::make(request('pass'));
        $user->remember_token = null;
        $user->save();


        return response()->json(['status' => 201]);
    }

    public function getAuthUser() {
        $user = Auth::user();

        return response()->json([
            'authUser' => $user
        ], 200);
    }
    
}
