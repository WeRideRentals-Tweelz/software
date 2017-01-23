@extends('layouts.main')
@section('content')
	<div class="container" style="min-height: 670px;">
		<h1 style="text-align: center;">Our Scooters</h1>
		<div class="row">
			@foreach($scooters as $scooter)
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}" style="max-height: 150px;">
					<div class="caption">
						<h3 style="text-align: center">{{ ucfirst($scooter->model) }}</h3>
						<p style="text-align: center"><a href="{{ url('scooters/'.$scooter->id) }}" class="btn btn-info" role="button">More Information</a></p>
					</div>
				</div>				
			</div>
			@endforeach
		</div>
	</div>
@stop