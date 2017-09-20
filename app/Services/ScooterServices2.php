<?php 
namespace App\Services;

use DateTime;
use App\Booking;
use App\Scooter;
use App\Repairs;
use App\ScooterParts;

class ScooterServices2{

	protected $kmChecks = [300,1000,3000,6000,12000];

	// 1 if a check is needed 
	// 1.1 function that retrieve how many checks the scooter should have made due to its kilometers.
	// 1.2 function that retrieve in the database how many checks the scooter really did
	// 1.3 function that compares 1.1.1 and 1.1.2 and gives an array of checks or null 
	// 1.4 function that takes the return of 1.1.3 to tell if a check is needed, if an array is send, gives true, if null is send, then send false.

	// 2 if the scooter is booked
	// 2.1 function that takes all the scooters
	// 2.2 function that takes all the bookings and check those who have dates that collides with a given booking.
	// 2.3 function that gives an array of scooters unavailable comparing to the dates of another booking
	// 2.4 function that gives an array of scooters unavailable comparing to the date and hour of today.
	// 2.5 function that checks if a scooter is booked, return boolean

	// 3 then gives an array of available scooters
	// 3.1 function that checks all those that needs a check
	// 3.2 function that removes the scooters that needs a check from the array of scooters
	// 3.3 function that checks all those that are booked
	// 3.4 function that removes the booked scooters from the scooters and returns an array of available scooters


	// 1.1 
	// @params Scooter scooter
	// @return array [check:number of checks should been made this far]
	public function kmChecksNeeded(Scooter $scooter)
	{
		$kmChecksNeeded = [];
		foreach($this->kmChecks as $check)
		{
			if($check == 300 and $scooter->kilometers >= 300){
				$kmChecksNeeded[$check] = 1;
			} else {
				$timesPerCheck = $scooter->kilometers/$check;
				$kmChecksNeeded[$check] = intval(floor($timesPerCheck)); 
			}
		}
		return $kmChecksNeeded;
	}

	// 1.2
	// @params Scooter $scooter
	// @return array [kmCheck:number of check made]
	private function kmChecksMade(Scooter $scooter)
	{
		$kmChecksMade = [];
		foreach ($this->kmChecks as $check) {
			$repairs = Repairs::where('scooter_id','=',$scooter->id)->where('reason','=',$check.'km check')->get();
			if($repairs === null){
				$kmChecksMade[$check] = 0;
			} else {
				$kmChecksMade[$check] = count($repairs);
			}
		}
		return $kmChecksMade;
	}

	//1.3
	// @params Scooter $scooter
	// @return array [300kmcheck,600kmcheck,...,xkmcheck]
	public function checksToDo(Scooter $scooter)
	{
		$kmChecksToDo = [];
		$kmChecksNeeded = $this->kmChecksNeeded($scooter);
		$kmChecksMade = $this->kmChecksMade($scooter);

		foreach ($this->kmChecks as $check) {
			if($kmChecksNeeded[$check] > $kmChecksMade[$check]){
				$kmChecksToDo[] = $check;
			}
		}
		return $kmChecksToDo;
	}

	//1.4
	// @params Scooter $scooter
	// @return boolean
	public function needsCheck(Scooter $scooter)
	{
		if(count($this->checksToDo($scooter)) == 0)
		{
			return false;
		} 
		return true;
	}

	//2.1 
	public function scooters()
	{
		$scooters = [];
		$allScooters = Scooter::all();
		foreach ($allScooters as $scooter) {
			$scooters[] = $scooter;
		}
		return $scooters;
	}

	//2.3
	// @param Booking $booking
	// @return array [Scooter]
	public function unavailableScootersForBooking(Booking $booking)
	{
		$bookings = Booking::where('drop_off_date','>',$booking->pick_up_date)
							->where('pick_up_date','<',$booking->drop_off_date)
							->where('confirmation','=',1)
							->get();

		$unavailableScooters = [];
		foreach ($bookings as $booking) {
			$unavailableScooters[] = $booking->scooter;
		}
		return $unavailableScooters;
	}

	//2.4
	// @param Booking $booking
	// @return array [Scooter]
	public function unavailableScootersForToday()
	{
		$today = date('Y-m-d H:i:s');
		$bookings = Booking::where('drop_off_date','>',$today)
							->where('pick_up_date','<',$today)
							->where('confirmation','=',1)
							->get();

		$unavailableScooters = [];
		foreach ($bookings as $booking) {
			$unavailableScooters[] = $booking->scooter;
		}
		return $unavailableScooters;
	}

	// 2.5
	// @param Scooter $scooter
	// @param $unavailableScooters from 2.3 or 2.4
	public function isBooked(Scooter $scooter,Booking $booking=null)
	{
		if($booking === null)
		{
			return in_array($scooter, $this->unavailableScootersForToday());
		}
		return in_array($scooter, $this->unavailableScootersForBooking($booking));
	}

	//3
	public function availableScooters(Booking $booking=null)
	{
		$availableScooters = [];
		
		foreach($this->scooters() as $scooter){
			if(!$this->needsCheck($scooter)){
				if($booking !== null){
					if(!$this->isBooked($scooter,$booking)){
						$availableScooters[] = $scooter; 
					}
				} else {
					if(!$this->isBooked($scooter)){
						$availableScooters[] = $scooter; 
					}
				}
			}
		}
		return $availableScooters;
	} 

	public function scooterStatus(Scooter $scooter)
	{
		if($this->needsCheck($scooter)){
			return 'Needs check';
		}
		if($this->isBooked($scooter)){
			return 'Booked';
		}
		return 'Available';
	}

	public function ScooterParts()
	{
		$scooterParts = ScooterParts::all();
		$parts = [];
		foreach ($scooterParts as $scooterPart) {
			$parts[] = $scooterPart;
		}
		return $parts;
	}

	public function partIntervention($check){
		
		$interventions = $this->interventions();
		return $interventions[$check];
	}

	public function interventions()
	{
		$checkNeeded = $this->kmChecks;
		$scooterParts = $this->scooterParts();

		// Replace this by a function that gives the 5 different arrays in one
		$firstCheck = ['I','I','I','C','R','I','I','I','I','I','I','I','I','R','','I','I','A','I','I','','','I','I','I','I','I','I','I','I',''];

		$secondCheck = ['','','','','Replacement every 1000km','I','I','I','I','I','I','I','','','','I','I','I','','','','','I','','','','','','','','',''];

		$thirdCheck = ['C','C','','','Replacement every 1000km','','','','','','','','I','','','','','','I','I','','','','','I','I','A','C','Replacement every 2000km','I','I',''];

		$fourthCheck = ['C','C','I','C','Replacement every 1000km','','','','','','','','R','Replacement every 5000km','L','','','','','','I','C','','I','','','','','Replacement every 2000km','C','',''];

		$fifthCheck = ['R','R','R','C','Replacement every 1000km','','','','','','','','','Replacement every 5000km','','','','','','','R','','','','','','','','Replacement every 2000km','','',''];

		$interventionsArrays = [$this->fullTextIntervention($firstCheck),$this->fullTextIntervention($secondCheck),$this->fullTextIntervention($thirdCheck),$this->fullTextIntervention($fourthCheck),$this->fullTextIntervention($fifthCheck)];

		$part = [];
		$interventions = [];
		for($i=0; $i < count($checkNeeded); $i++){
			for($j=0; $j < count($scooterParts); $j++){
				$part[$scooterParts[$j]->name] = $interventionsArrays[$i][$j];
			}
			$interventions[$checkNeeded[$i]] = $part;
		}

		return $interventions;
	}

	public function fullTextIntervention(Array $interventionArray)
	{
		for ($i=0; $i < count($interventionArray); $i++) { 
			switch($interventionArray[$i]){
				case 'I':
					$interventionArray[$i] = 'Inspection, cleaning and adjustment';
				break;
				
				case 'R':
					$interventionArray[$i] = 'Replacement';
				break;

				case 'C':
					$interventionArray[$i] = 'Cleaning (replace if necessary)';
				break;

				case 'L':
					$interventionArray[$i] = 'Lubrication';
				break;

				case 'A':
					$interventionArray[$i] = 'Adjustment';
				break;

				default:
					$interventionArray[$i] = $interventionArray[$i];
				break;
			}
		}

		return $interventionArray;
	}

	public function getRepairs(Scooter $scooter)
	{
		$repairs = Repairs::where('scooter_id','=',$scooter->id)->get();
		return $repairs;
	}

	public function addRepair($request,$scooterId)
	{
		$repair = Repairs::create([
			'scooter_id'	=> $scooterId,
			'date'			=> $request->input('repairDate'),
			'kilometers'	=> $request->input('kilometers'),
			'reason'		=> $request->input('reason'),
			'part'			=> $request->input('part')
		]);
	}

	public function removeRepair($repairId)
	{
		$repair = Repairs::find($repairId);
		$repair->delete();
	}
}