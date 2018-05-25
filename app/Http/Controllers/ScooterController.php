<?php

namespace App\Http\Controllers;

use DateTime;
use App\Scooter;
use App\Booking;
use App\Repairs;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Services\ScooterServices;
use App\Services\ScooterServices2;

class ScooterController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index','show','showcolor');
    }

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
        $scooterService = new ScooterServices2();
        return view('admin.scooter-details')->with(compact('scooterService'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scooterService = new ScooterServices2();
        $scooterService->storeScooterImage($request);

        Scooter::create([
            'state'                 => $request->input('state'),
            'plate'                 => $request->input('plate') ,
            'model'                 => $request->input('model') ,
            'year'                  => $request->input('year') ,
            'color'                 => $request->input('color') ,
            'kilometers'            => $request->input('kilometers') ,
            'category'              => $request->input('category') ,
            'last_check'            => $request->input('last_check'),
            'last_kilometers_check' => $request->input('kilometers'),
            'availability'          => 0
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
        $scooterService = new ScooterServices2();
        $scooterService->storeScooterImage($request);

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
        $scooterService = new ScooterServices2();
        
        return view('admin.scooter-index')->with(compact('scooters','scooterService'));
    }

    public function adminScooterInfo($scooter_id)
    {
        $scooterService = new ScooterServices2();
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
        
        return view('admin.scooter-details')->with(compact('scooter','bookings','scooterService','next','prev'));
    }  
    
    public function kmCheckSheet($scooterId,$check)
    {
        $scooter = Scooter::find($scooterId);
        $scooterService = new ScooterServices2();
        $actionsNeeded = $scooterService->partIntervention($check);

        return view('admin.scooter-kmSheet')->with(compact('scooter','actionsNeeded','check'));
    }

    public function checkKilometers($scooterId,$check)
    {
        $scooter = Scooter::find($scooterId);
        $scooter->last_check = date('Y-m-d');
        $scooter->save();

        Repairs::create([
            'scooter_id'        => $scooterId,
            'date'              => date('Y-m-d'),
            'kilometers'        => $scooter->kilometers,
            'reason'            => $check.'km check',
            'part'              => '',
            'status'            => '1'
        ]);

        return redirect(url('/home/scooters/'.$scooterId));
    }  

    public function addRepair(Request $request, $scooterId){
        $scooterService = new ScooterServices2();
        $scooterService->addRepair($request,$scooterId);

        return redirect()->back();
    }

    public function removeRepair($repairId){
        $scooterService = new ScooterServices2();
        $scooterService->removeRepair($repairId);

        return redirect()->back();
    }
}