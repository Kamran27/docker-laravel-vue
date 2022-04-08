<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    // Alle Users anzeigen
    public function index() {
        return UserResource::collection(User::all());
        //return User::all();
    }
}
