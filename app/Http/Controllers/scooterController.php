<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scooter;

class scooterController extends Controller
{
    public function index()
    {
    	$scooters = Scooter::all();
    	return view('scooter.index')->with(compact('scooters'));
    }

    public function show($scooter_id)
    {
    	$scooter = Scooter::find($scooter_id);
    	return view('scooter.show')->with(compact('scooter'));
    }
}
