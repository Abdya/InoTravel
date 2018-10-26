<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function showUserInfo() {
        $user = User::find(user()->id);
        return view('searchResults', ['properties'=>$properties]);
    }
}
