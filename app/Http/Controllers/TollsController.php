<?php

namespace App\Http\Controllers;

use DateTime;
use App\Tolls;
use App\Booking;
use App\Services\TollServices;
use App\Services\CSVServices;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use League\Csv\Reader;

class TollsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sort=null, $order=null, $limit=null)
    {   
        if($sort == "" || $order == "" || $limit == ""){
            $sort = "Date";
            $order = "desc";
            $limit = 5;
        }
        $tolls = Tolls::OrderBy($sort,$order)->take($limit)->get();
        return view('tolls.index')->with(compact('tolls','sort','order','limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tolls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //To be tested
        $this->checkCsvUploaded($request);

        $csvServices = new CSVServices($request->file('csv'));

        $csv = $csvServices->getCSVFile();
        $lastLine = $csvServices->getCSVLastLine();
        $count = 0;
                
        foreach ($csv as $header => $row) {
            if($count != 0 && $count < $lastLine){
                if(!$csvServices->isTollExist($row[0],$row[1],$row[2])){
                    Tolls::create([
                        'Date'          =>  $csvServices->dateToDatabaseFormat($row[0]),
                        'Time'          =>  $row[1],
                        'LicencePlate' =>  $row[2],
                        'Tag'           =>  $row[3],
                        'TagName'      =>  $row[4],
                        'Group'         =>  $row[5],
                        'On'            =>  $row[6],
                        'Lane'          =>  $row[7],
                        'VehicleType'  =>  $row[8],
                        'Amount'        =>  $row[9],
                    ]); 
                }
            }

        $count++;
        }
        return redirect('/tolls');
    }

    public function checkCsvUploaded(Request $request){
        if($request->file('csv') === null){
            // Add flash session here
            return redirect('/tolls');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tollsId = $request->input('toll');
        $tolls = [];
        foreach ($tollsId as $id) {
            $toll = Tolls::find($id);
            $tolls[] = $toll;
        }   
            
        return view('tolls.edit')->with(compact('tolls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->input('tollId') as $tollId)
        {
            $toll = Tolls::find($tollId);
            $toll->Date = $request->input('Date'.$toll->id);
            $toll->Time = $request->input('Time'.$toll->id); 
            $toll->LicencePlate = $request->input('LicencePlate'.$toll->id);
            $toll->Tag = $request->input('Tag'.$toll->id);
            $toll->TagName = $request->input('TagName'.$toll->id);
            $toll->Group = $request->input('Group'.$toll->id);
            $toll->On = $request->input('On'.$toll->id);
            $toll->Lane = $request->input('Lane'.$toll->id);
            $toll->VehicleType = $request->input('VehicleType'.$toll->id);
            $toll->Amount = $request->input('Amount'.$toll->id);
            $toll->save();
        }

        return redirect('/tolls');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tollsId = $request->input('toll');
        $tolls = [];
        foreach ($tollsId as $id) {
            $toll = Tolls::find($id);
            $toll->delete();
        }
        return redirect('/tolls');
    }
}
