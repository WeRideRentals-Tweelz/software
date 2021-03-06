@extends('layouts.main')
@section('content')
<div class="container">
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<p class="panel-title">This is an updated version, to see the older version click here:
				<a href="{{ url('/past-update/bookings') }}" class="btn btn-warning">old version</a>
			</p>
		</div>
	</div>

	@if(!isset($page))
	<a href="{{ url('/on-hold') }}" class="btn btn-info">On Hold Bookings</a>
	@else
	<a href="{{ url('/bookings') }}" class="btn btn-success">Bookings</a>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading">
			@if(isset($page))
			<h1>On Hold Bookings</h1>
			@else
			<h1>Bookings</h1>
			@endif
		</div>
		<div class="panel-body">
			<table class="table table-stripped">
				<thead>
					<tr>
						<th>Booking Number</th>
						<th>Start Date</th>
						<th>Start Time</th>
						<th>End Date</th>
						<th>End Time</th>
						<th>Days Booked</th>
						<th>Driver</th>
						<th>Scooter</th>
						<th>Booking Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bookings as $booking)
						<tr class="{{ $booking->acknowledged ? 'alert alert-success' : '' }}">
							<td>{{ $booking->id }}</td>
							<td>{{ date_format(date_create($booking->pick_up_date), 'D d M Y') }}</td>
							@if($booking->pick_up_time == '')
							<td class="alert-info">
								NO START TIME
							</td>
							@else
							<td>
								{{ date_format(date_create($booking->pick_up_time), 'H:i A') }}
							</td>
							@endif
							<td>{{ date_format(date_create($booking->drop_off_date), 'D d M Y') }}</td>
							@if($booking->drop_off_time == '')
							<td class="alert-danger">
								
								NO END TIME
							</td>
							@else
							<td>
									{{ date_format(date_create($booking->drop_off_time),'H:i A') }}
							</td>
							@endif
							<td>{{ date_create($booking->drop_off_date)->diff(date_create($booking->pick_up_date))->d }}</td>
							
							@if($booking->user_id != 0 && $booking->user->driver->confirmed)
								<td><a href="{{ url('/user/'.$booking->user_id) }}">{{ $booking->user->surname }} {{ $booking->user->name }}</td>
							@elseif($booking->user_id !=0 && $booking->user->driver->confirmed == 0)
								<td class="alert alert-warning"><a href="{{ url('/user/'.$booking->user_id) }}">{{ $booking->user->surname }} {{ $booking->user->name }}</a> <br>Profile's not complete</td>
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
			<a href="{{ url('/pastbookings/') }}" class="btn btn-info pull-right">See Past Bookings</a>
		</div>
	</div>
</div>
@stop