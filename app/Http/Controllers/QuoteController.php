<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Services\QuoteServices;
use App\Services\checkUser;
use App\Services\DateTransformationService;
use App\Services\EmailSender;
use App\Http\Requests\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    public function store(QuoteRequest $request)
    {
    	$quoteService = new QuoteServices();
    	$dateService = new DateTransformationService();
    	$quoteService->checkQuoteDates($request->input('pickUp'), $request->input('dropOff'));

    	$quote = Quote::create([
    		'name'		=>	$request->input('name'),
    		'surname'	=>	$request->input('surname'),
    		'phone'		=>	$request->input('phone'),
    		'email'		=>	$request->input('email'),
    		'start' 	=>	$dateService->formatForStorage($request->input('pickUp')),
    		'end'		=>  $dateService->formatForStorage($request->input('dropOff')),
    	]);
    	
    	$checkUser = new CheckUser();
    	$path = $checkUser->pathToRedirectIfUserExists($request->input('email'),$quote);
    	return $path->with(compact('quote'));
    }

    public function confirmation($quoteId){
    	$quoteService = new QuoteServices();

    	$quote = Quote::find($quoteId);

        $emailService = new EmailSender($quote->email);
        $emailService->confirmation($quote);

        return $quoteService->confirmQuote($quote);
    }
}
