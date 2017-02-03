<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scooter;
use DateTime;

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

    public function last4()
    {
        $scooters = Scooter::limit(4)->get();
        return view('home')->with(compact('scooters'));
    }

    public function adminInfo($scooter_id)
    {

            $scooter = Scooter::find($scooter_id);
            return view('dashboard.scooter-details')->with(compact('scooter'));
    }

    public function update(Request $request, $scooter_id)
    {
        $scooter = Scooter::find($scooter_id);

        $scooter->state         =   $request->input('state');
        $scooter->plate         =   $request->input('plate'); 
        $scooter->model         =   $request->input('model');
        $scooter->year          =   $request->input('year');
        $scooter->color         =   $request->input('color');
        $scooter->kilometers    =   $request->input('kilometers');
        $scooter->category      =   $request->input('category');
        $scooter->last_check    =   $request->input('last_check');
        $scooter->info          =   $request->input('info');
        $scooter->updated_at    =   new DateTime;

        $scooter->save();
        return back();
    }
}
