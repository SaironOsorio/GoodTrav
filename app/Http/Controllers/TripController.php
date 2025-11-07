<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
    public function show(Trip $trip)
    {
        return view('tripdetail', compact('trip'));
    }
}