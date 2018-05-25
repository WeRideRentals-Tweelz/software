<?php 
namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Mail;

class EmailSender {
	
	private $user;
	private $contactEmail = "contact@weriderentals.com";

	public function __construct($email)
	{
		$this->user = User::where('email','=',$email)->first();
	}

	public function confirmation($quote)
	{
		$email = $this->user->email;
		$contact = $this->contactEmail;
		$name = $this->user->name;
		$phone = $this->user->phone;

		Mail::send('emails.confirmation', ['name' => $name, 'pickUp' => $quote->start, 'dropOff' => $quote->end], function($message) use ($email) {
		            $message->to($email)->subject('We Ride Rentals - Your booking confirmation');
		});

		Mail::send('emails.new-booking', ['name' => $name, 'phone' => $phone, 'email' => $email, 'pickUp' => $quote->start, 'dropOff' => $quote->end], function($message) use ($contact,$name) {
		            $message->to($contact)->subject('New Booking - '.$name);
		});
	}

	public function sendDocument($document)
	{	
		$documentName = $document->name;
		$documentContent = $document->content;
		$name = $this->user->name;
		$signature = $this->user->name.' '.$this->user->surname;
		$contactEmail = $this->contactEmail;

		Mail::send('emails.document', ['documentName' => $documentName, 'documentContent' => $documentContent , 'name' => $name, 'signature' => $signature], function($message) use ($contactEmail, $name, $documentName){
			$message->to($this->contactEmail)->subject($name.' signed '.$documentName.'.');
		});
	}
}