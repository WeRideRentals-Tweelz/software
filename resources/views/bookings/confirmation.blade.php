@extends('layouts.main')
@section('content')
	<div class="container" style="min-height: 670px;">
		<div class="row">
			<div class="alert alert-success" role="alert">
				<b>Well done !</b> You have successfully rent you scooter with Tweelz.com !
			</div>
			<h1>Thank you for renting with Tweelz.com !</h1>
			<p>We confirm you're reservation of a <B>{{ ucfirst($scooter->model) }}</B> for the <B>{{ date_format(date_create($pick_up_date),'d/m/Y') }}</B> to the <b>{{ date_format(date_create($drop_off_date),'d/m/Y') }}</b>.</p>
			<p>Please be sure to bring your ID and your driver's licence the day you come to pick-up with us.</p>
			<p>
				You will need to pick-up the scooter at this address : 
				<ul class="list-unstyled" style="margin-left: 50px;">
					<li>360 Botany Road</li>
					<li>Beaconsfield 2015</li>
					<li>NSW, Sydney</li>
				</ul>
			</p>
			<p>I you want to cancel your reservation or if there is any issue with your reservation, please contact us at any time at this number 0435820170 or by email at contact@tweelz.com</p>
			<p><a href="{{ url('/') }}" class="btn btn-primary">Return on home page</a></p>
		</div>
	</div>
@stop