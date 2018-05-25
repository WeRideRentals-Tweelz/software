<?php
namespace App\Services;

use App\Documents;
use Illuminate\Http\Request;

class DocumentServices {

	public function getTermsAndConditions(){
		return $document = Documents::find(1);
	}

	public function getRentalAgreement(){
		return $document = Documents::find(2);
	}

}