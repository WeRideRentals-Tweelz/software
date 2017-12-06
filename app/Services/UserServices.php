<?php
namespace App\Services;

use DateTime;
use App\User;
use App\Driver;

class UserServices
{
	public function checkDate($date)
	{
		if($date !== null && $date !== ''){
			return date_format(date_create($date),'Y-m-d');
		}
		return '';
	}
}