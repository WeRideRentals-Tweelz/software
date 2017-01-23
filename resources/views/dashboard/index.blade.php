@extends('layouts.main')
@section('content')
	<div class="container" style="min-height: 670px">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Bookings</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-striped">
					<tr>
						<th>Booking number</th>
						<th>Pick-up date</th>
						<th>Drop-off date</th>
						<th>Scooter</th>
						<th>Plate</th>
						<th>Color</th>
						<th>Confirmed ?</th>
					</tr>
					@foreach($bookings as $booking)
					<tr>
						<td>{{ $booking->id }}</td>
						<td>{{ date_format(date_create($booking->pick_up_date),'F d M Y') }}</td>
						<td>{{ date_format(date_create($booking->drop_off_date),'F d M Y') }}</td>
						<td>{{ $booking->model }}</td>
						<td>{{ $booking->plate }}</td>
						<td>{{ $booking->color }}</td>
						<td></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		<div class="panel-default">
			<div class="panel-heading">
				<h2>Scooters</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-hover">
					<tr style="text-align: center">
						<th>Image</th>
						<th>Model</th>
						<th>Plate</th>
						<th>Year</th>
						<th>Color</th>
						<th>Km</th>
						<th>Last Check</th>
						<th>Available</th>
						<th>Details</th>
						<th colspan="2">Action</th>
					</tr>
					@foreach($scooters as $scooter)
					<tr>
						<td><img style="height: 40px; widtd: 60px;" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}"></td>
						<td>{{ $scooter->model }}</td>
						<td>{{ $scooter->state }} - {{ $scooter->plate }}</td>
						<td>{{ $scooter->year }}</td>
						<td>{{ $scooter->color }}</td>
						<td>{{ $scooter->kilometers }} km</td>
						<td>{{ date_format(date_create($scooter->last_check),'l d F Y') }}</td>
						<td>
							<a href="" class="btn btn-success btn-sm" role="button">Rent</a>
						</td>
						<td style="width: 200px; text-align: justify;">{{ $scooter->info }}</td>
						<td>
							<a style="margin-left: 20px" href="" class="btn btn-info btn-sm" role="button">Update</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" role="button">Delete</a>
						</td>
					</tr>				
					@endforeach
				</table>
				<a style="margin-top: 100px" href="" class="btn btn-primary" role="button"><span class="fa fa-plus"> Add a scooter</span></a>
			</div>
		</div>
	</div>
@stop