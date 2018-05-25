@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-5" style="margin-bottom: 50px">
			<form action="{{ url('/pastbookings')}}" method="POST">
				<div class='input-group date row' id='pastBookings'>
		            <input id="date"  type='text' name="date" class="form-control" placeholder="Month" value="{{ isset($date) ? $date : '' }}" required/>
		            <span class="input-group-addon">
		                <span class="glyphicon glyphicon-calendar"></span>
		            </span>
		        </div>
		        <button role="submit" class="form-control btn btn-primary" style="margin-top: 25px">Search</button>
			</form>
		</div>
	</div>
	@if(isset($bookings))
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
						<tr>
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
							<td>{{ date_format(date_create($booking->drop_off_date), 'D d M Y') }}</td>
							<td>{{ date_create($booking->drop_off_date)->diff(date_create($booking->pick_up_date))->d }}</td>
							
							@if($booking->user_id != 0 && $booking->user->driver->confirmed)
								<td><a href="{{ url('/user/'.$booking->user_id) }}">{{ $booking->user->name }}</td>
							@elseif($booking->user_id !=0 && $booking->user->driver->confirmed == 0)
								<td class="alert alert-warning"><a href="{{ url('/user/'.$booking->user_id) }}">{{ $booking->user->name }}</a> <br>User's not Confirmed</td>
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
			<a href="{{ url('/bookings') }}" class="btn btn-info pull-right">See Actual Bookings</a>
		</div>
	</div>
	@endif
</div>
@stop

@section('scripts')
<script type="text/javascript">
            $(function () {
                $('#pastBookings').datetimepicker({
                	format: 'YYYY-MM'
                });
            });
</script>
@stop