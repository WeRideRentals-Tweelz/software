@extends('layouts.main')
@section('content')
<div class="container">
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
					<th>Driver</th>
					<th>Driver's phone</th>
					<th>Scooter</th>
					<th>Plate</th>
					<th>Color</th>
					<th>Accessories</th>
					<th>Status</th>
				</tr>
				@foreach($bookings as $booking)
				<tr>
					<td>{{ $booking->id }}</td>
					<td>{{ date_format(date_create($booking->pick_up_date),'F d M Y') }}</td>
					<td>{{ date_format(date_create($booking->drop_off_date),'F d M Y') }}</td>
					<td><a href="{{ url('/home/drivers/'.$booking->driver_id) }}">{{ $booking->firstname }} {{ $booking->surname }}</a></td>
					<td>0{{ $booking->phone }}</td>
					<td>{{ $booking->model }}</td>
					<td>{{ $booking->plate }}</td>
					<td>{{ $booking->color }}</td>
					<td>{{ $booking->accessory_name }}</td>
					<td>{{ $booking->status }}</td>
					<td></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@stop