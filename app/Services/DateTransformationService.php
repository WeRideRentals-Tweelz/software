<?php
namespace App\Services;

use DateTime;

class DateTransformationService {

	private $AustralianTime = '+11 hour';


	public function formatForStorage($date){
		return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
	}

	public function formatForUser($date){
		return date('d/m/Y', strtotime($date));
	}

	public function setTimeForAustralia($data_type=null,$date = null){
		switch ($data_type) {
			case 'date':
				$data = 'Y-m-d';
				break;
			case 'time':
				$data = 'H:i:s';
				break;
			case 'time-date':
				$data = 'Y-m-d H:i:s';
				break;
			
			default:
				$data = 'Y-m-d H:i:s';
				break;
		}
		return date($data,strtotime($date.$this->AustralianTime));
	}

}