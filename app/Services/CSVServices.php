<?php 
namespace App\Services;

use Illuminate\Http\UploadedFile;
use League\Csv\Reader;

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
}