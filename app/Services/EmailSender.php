<?php 
namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailSender {
	
	private $userEmail;
	private $contactEmail = "contact@weriderentals.com";

	public function __construct($email)
	{
		$this->userEmail = $email;
	}

	public function confirmation($booking)
	{
		$email = $this->userEmail;
		$contact = $this->contactEmail;
		$name = $booking->user->name;
		$phone = $booking->user->phone;

		Mail::send('emails.confirmation', ['name' => $name, 'pickUp' => $booking->pick_up_date, 'dropOff' => $booking->drop_off_date], function($message) use ($email) {
		            $message->to($email)->subject('We Ride Rentals - Your booking confirmation');
		});

		Mail::send('emails.new-booking', ['name' => $name, 'phone' => $phone, 'email' => $email, 'pickUp' => $booking->pick_up_date, 'dropOff' => $booking->drop_off_date], function($message) use ($contact,$name) {
		            $message->to($contact)->subject('New Booking - '.$name);
		});
	}

	public function sendDocument($document,$request)
	{	
		$documentName = $document->name;
		$documentContent = $document->content;
		$name = $request->input('signedName');
		$signature = $request->input('electronicSign');
		$contactEmail = $this->contactEmail;

		Mail::send('emails.document', ['documentName' => $documentName, 'documentContent' => $documentContent , 'name' => $name, 'signature' => $signature], function($message) use ($contactEmail, $name, $documentName){
			$message->to($this->contactEmail)->subject($name.' signed '.$documentName.'.');
		});
	}
}