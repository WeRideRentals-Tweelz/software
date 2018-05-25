<?php 
namespace App\Services;

use Illuminate\Http\UploadedFile;
use League\Csv\Reader;
use DateTime;
use App\Tolls;

class CSVServices 
{
	protected $csv;

	public function __construct(UploadedFile $file)
	{
		$reader = Reader::createFromPath($file);
        $csv = $reader->fetch();
        $this->csv = $csv;
	}

	public function getCSVFile()
	{
        return $this->csv;
	}

	public function getCSVFileSize()
	{
		$csvSize = 0;
        foreach ($this->csv as $row) {
            $csvSize++;
        }
        return $csvSize;
	}

	public function getCSVLastLine()
	{
		$csvSize = $this->getCSVFileSize($this->csv);
		return $lastLine = --$csvSize;
	}

	public function dateToDatabaseFormat($date){
		return date_format(DateTime::createFromFormat("d/m/Y", $date), 'Y-m-d');
	}

	protected function fetchToll($date,$time,$licence_plate){
		return $toll = Tolls::where('Date','=',$this->dateToDatabaseFormat($date))
				->where('Time','=',$time)
				->where('LicencePlate','=',$licence_plate)
				->first();
	}

	public function isTollExists($date,$time,$licence_plate){
		if($this->fetchToll($date,$time,$licence_plate) !== null){	
			return true;
		}
		return false;
	}
}