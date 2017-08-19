<?php 
namespace App\Services;

use DateTime;
use App\Booking;
use App\Scooter;
use App\Repairs;
use App\ScooterParts;

class ScooterServices{

	private $today;
	private $bookings;
	private $scooters;

	public function __construct()
	{
		$this->today = date('Y-m-d');
		$this->scooters();
	}

	/*
	*	Send a collection of bookings. 
	*	If null is given, it will returns all the bookings that are active during the current day. 
	*	If an instance of App\Booking is given, it returns all the bookings that happens at the same period of time than the booking given.  
	*	@params null or App\Booking
	*	@returns App\Booking\Collection 
	*/	
	protected function bookings($booking=null)
	{
		if($booking !== null){
			return $bookings = Booking::where('drop_off_date','>=',$booking->pick_up_date)->where('pick_up_date','<=',$booking->drop_off_date)->where('confirmation','=',1)->get();
		}
		return $bookings = Booking::where('drop_off_date','>=',$this->today)->where('pick_up_date','<=',$this->today)->where('confirmation','=',1)->get();
	}

	
	/*
	*	Gives an array with scooters available depending on today or a specific booking.
	*	@params null or App\Booking $booking
	*	@returns array
	*/
	public function availableScooters($booking=null)
	{
		$naScooters = $this->nonAvailableScooters($booking);
		$scooters = $this->scooters;

		$availableScooters = array_diff($scooters,$naScooters);

		$scooters = [];
		foreach ($availableScooters as $aScooter) 
		{
			$scooters[] = $aScooter;
		}

		return $scooters;
	}

	/*
	*	Gives an array with not available scooters depending today or for specific booking.
	* 	An array is given for more being able to be compared with other arrays.
	*	@params null or App\Booking $booking
	*	@returns array
	*/
	public function nonAvailableScooters($booking=null)
	{
		$naScooters = [];
		foreach ($this->bookings($booking) as $booking) 
		{
			$naScooters[] = $booking->scooter;
		}

		return $naScooters;
	}

		// Check if a specific scooter is available
		public function isAvailable(Scooter $scooter,$verbose=false)
		{
			$scootersAvailable = $this->availableScooters();
			foreach ($scootersAvailable as $scooterAvailable) {
				if($scooterAvailable->id == $scooter->id)
				{
					if($this->checksNeeded($scooter)){
						if($verbose)
						{
							return "Needs Kilometers Check";
						}
						return false;
					}

					if($verbose){
						return "Scooter Available";
					}
					return true;
				}
			}
			if($verbose){
				return "Scooter is booked";
			}
			return false;
		}

		public function scootersAvailable($booking = null)
		{
			$availableScooters = $this->availableScooters($booking);
			$scootersAvailable = [];
			foreach($availableScooters as $scooter){
				if($this->isAvailable($scooter)){
					$scootersAvailable[] = $scooter;
				}
			}
			return $scootersAvailable;
		}

		// Gives an array of all scooters existing in the database
		protected function scooters()
		{
			$aScooters = [];
			$scooters = Scooter::all();
			foreach ($scooters as $scooter) {
				$aScooters[] = $scooter;
			}
			$this->scooters = $aScooters;
		} 

		// Take the settings from user or use original one
		public function kmCheckSettings()
		{
			//Fetch an array that can be changed from the original
			$settings = null;
			if($settings === null)
			{
				return [300,1000,3000,6000,12000];
			}
		}

		// Gives the modulo between two figures
		public function howManyChecksNeeded(Scooter $scooter, $kmCheck)
		{
			if($kmCheck == 300 && $scooter->kilometers >= 300){
				return 1;
			}
			$times = $scooter->kilometers/$kmCheck;
			return intval(floor($times));
		}

		public function howManyChecksMade(Scooter $scooter, $kmCheck)
		{
			$repairs = Repairs::where('scooter_id','=',$scooter->id)->where('reason','=',$kmCheck.'km check')->get();
			if($repairs === null){
				return 0;
			}
			return count($repairs);
		}

		// Check how many km check the scooter needs to have due to his km.
		// If the numbers of km check if inferior, the scooter needs a new check.

		public function checksNeeded(Scooter $scooter,$verbose=false)
		{	
			$checks = $this->kmCheckSettings();
			$checksNeeded = [];
			foreach($checks as $check){
				if($this->howManyChecksNeeded($scooter,$check) > $this->howManyChecksMade($scooter,$check)){
					if($verbose){
						$checksNeeded[] = $check;
					} else {
						return true;
					}
				}
			}
			if($verbose){
				return $checksNeeded;
			} else {
				return false;
			}
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
			$checkNeeded = $this->kmCheckSettings();
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
}