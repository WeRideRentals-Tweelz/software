<?php

namespace App\Http\Controllers;

use DateTime;
use App\Scooter;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ScooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scooters = Scooter::all();
        return view('scooter.index')->with(compact('scooters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.scooter-details');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('scooterPicture')){
            if($request->file('scooterPicture')->isValid()){
                $file = $request->scooterPicture->storeAs('public',$request->plate.'-'.$request->model.'-'.$request->color.'.jpg');
            }
        }

        Scooter::create([
            'state'          => $request->input('state'),
            'plate'          => $request->input('plate') ,
            'model'          => $request->input('model') ,
            'year'           => $request->input('year') ,
            'color'          => $request->input('color') ,
            'kilometers'     => $request->input('kilometers') ,
            'category'       => $request->input('category') ,
            'last_check'     => $request->input('last_check'),
            'availability'   => 0
        ]);

        return redirect('/home/scooters');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scooter  $scooter_model
     * @return \Illuminate\Http\Response
     */
    public function show($scooter_model)
    {
        $scooter_model = str_replace('-',' ',$scooter_model);
        $scooter = Scooter::where('model',$scooter_model)->first();
        $scooter_color = Scooter::distinct()->select('color')->where('model',$scooter_model)->get();
        $color='';
        return view('scooter.show')->with(compact('scooter','scooter_color'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scooter  $scooter->scooter_model
     * @param  \App\Scooter  $scooter->color
     * @return \Illuminate\Http\Response
     */
    public function showcolor($scooter_model,$color)
    {
        $scooter_model = str_replace('-',' ',$scooter_model);
        $scooter = Scooter::where('model',$scooter_model)->first();
        $scooter_color = Scooter::distinct()->select('color')->where('model',$scooter_model)->get();
        return view('scooter.show')->with(compact('scooter','scooter_color','color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function edit(Scooter $scooter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $scooterId)
    {
        if($request->hasFile('scooterPicture')){
            if($request->file('scooterPicture')->isValid()){
                if(Storage::disk('local')->exists($request->plate.'-'.$request->model.'-'.$request->color.'.jpg'))
                {
                    Storage::delete($request->plate.'-'.$request->model.'-'.$request->color.'.jpg');
                }
                $file = $request->scooterPicture->storeAs('public',$request->plate.'-'.$request->model.'-'.$request->color.'.jpg');
            }
        }

        $scooter = Scooter::find($scooterId);

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
        return redirect('/home/scooters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function destroy($scooterId)
    {
        $scooter = Scooter::find($scooterId);
        $scooter->delete();

        return redirect('/home/scooters');
    }

    public function adminScooterIndex()
    {
        $scooters = Scooter::all();
        return view('admin.scooter-index')->with(compact('scooters'));
    }

    public function adminScooterInfo($scooter_id)
    {
            $scooter = Scooter::find($scooter_id);
            $bookings = Booking::where('scooter_id','=',$scooter->id)->get();
            //Arrow links
            if(Scooter::find($scooter_id + 1) !== null )
            {
                $next = $scooter_id + 1;
            }
            else
            {
                $next = $scooter_id;
            }
            $prev = $scooter_id - 1;
            
            return view('dashboard.scooter-details')->with(compact('scooter','bookings','next','prev'));
    }    
}