<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class ApiController extends Controller
{
    public function index(Request $request)  // Note: 'user' should be lowercase
    {
        $user = User::all();
        return new UserResource($user);
    }
}
