<?php
namespace App\Services;

use DateTime;
use App\Booking;
use App\User;
use App\Drivers;
use App\Scooter;
use App\Services\ScooterServices2;
use App\Services\DateTransformationService;
use App\Services\DocumentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class UserServices
{
	public function checkDate($date)
	{
        $dateService = new DateTransformationService();

		if($date !== null && $date !== ''){
			return $dateService->formatForStorage($date);
		}
		return '';
	}

	public function createDriverFromUser(Request $request, $userId){
		$driver = Drivers::create([
            'user_id'           => $userId,
            'date_of_birth'     => $this->checkDate($request->input('date_of_birth')),
            'address'           => $request->input('address'),
            'city'              => $request->input('city'),
            'state'             => $request->input('state'),
            'postcode'          => $request->input('postcode'),
            'drivers_licence'   => $request->input('drivers_licence'),
            'licence_state'     => $request->input('licence_state'),
            'expiry_date'       => $this->checkDate($request->input('expiry_date')),
            'confirmed'         => 0
        ]); 
	}

	public function updateUserBookingStatus(User $user, $status){
		$bookings = $user->bookings;
        foreach ($bookings as $booking) {
            $booking->status = $status;
            $booking->save();
        }
	}

    public function activeUsers(){
        $today = date('Y-m-d H:i:s');
        $scooterService = new ScooterServices2();
        $scooters = Scooter::all();
        $activeUsers = [];
        foreach ($scooters as $scooter) {
            if($scooterService->isBooked($scooter)){
                $bookings = $scooter->bookings;
                foreach ($bookings as $booking) {
                   
                    if($booking->drop_off_date > $today && $booking->pick_up_date < $today && $booking->confirmation === 1){
                        $activeUsers[] = $booking->user->id;
                    }
                }
            }
        }
        return $activeUsers;
    }

    public function isUserActive(User $user){
        $activeUsers = $this->activeUsers();
        return in_array($user->id, $activeUsers);
    }

    public function getDriverInfo(){
        $user = $this->getUserFromAuth();
        return $driver = $user->driver;
    }

    public function getUserFromAuth(){
        return $user = Auth::user();
    }

    public function isUserSigned(User $user){
        if($user->signed){
            return true;
        }
        return false;
    }

    public function getUserDocuments(User $user){
        $documentService = new DocumentServices();
        if(!$this->isUserSigned($user)){
          return $document = $documentService->getTermsAndConditions();
        }
        return $document = null;
    }

    public function storeAvatar(Request $request){
        if($request->hasFile('userPicture')){
            if($request->file('userPicture')->isValid()){
                if(Storage::disk('local')->exists($request->input('name').'.jpg'))
                {
                    Storage::delete($request->input('name').'.jpg');
                }
                $file = $request->userPicture->storeAs('public',$request->input('name').'.jpg');
            }
        }
    }
}