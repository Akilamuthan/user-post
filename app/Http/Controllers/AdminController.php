<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index($user)
    {
     
        return view('adminwebpage'); // Make sure this view exists
    }
    public function updateSettings(){
        return back()->with("message","successfully");
    }
}

