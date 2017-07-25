@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Bookings</h1>
		</div>
		<div class="panel-body">
			<table class="table table-stripped">
				<thead>
					<tr>
						<th>Booking Number</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Days Booked</th>
						<th>Driver</th>
						<th>Scooter</th>
						<th>Booking Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bookings as $booking)
						<tr>
							<td>{{ $booking->id }}</td>
							<td>{{ date_format(date_create($booking->pick_up_date), 'D d M Y') }}</td>
							<td>{{ date_format(date_create($booking->drop_off_date), 'D d M Y') }}</td>
							<td>{{ date_create($booking->drop_off_date)->diff(date_create($booking->pick_up_date))->d }}</td>
							
							@if($booking->user_id != 0 && $booking->user->driver->confirmed)
								<td><a href="{{ url('/profile/'.$booking->user_id) }}">{{ $booking->user->name }}</td>
							@elseif($booking->user_id !=0 && $booking->user->driver->confirmed == 0)
								<td class="alert alert-warning"><a href="{{ url('/profile/'.$booking->user_id) }}">{{ $booking->user->name }}</a> <br>User's not Confirmed</td>
							@else
								<td class="alert alert-danger">No User</td>
							@endif

							@if($booking->scooter_id != 0)
								<td>{{ $booking->scooter->plate }} - {{ $booking->scooter->model }}</td>
							@else
								<td class="alert alert-danger">No Scooter</td>
							@endif

							<td>{{ $booking->status }}</td>
							<td><a href="{{ url('/bookings/'.$booking->id.'/edit') }}" class="btn btn-info">Details</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<a href="{{ url('/bookings/create') }}" class="btn btn-primary">Create Booking</a>
			<a href="{{ url('/pastBookings/') }}" class="btn btn-info pull-right">See Past Bookings</a>
		</div>
	</div>
</div>
@stop