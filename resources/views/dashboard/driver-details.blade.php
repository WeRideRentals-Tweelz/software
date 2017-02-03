@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-sm-5 col-sm-offset-1">
		<h1>Tweelz Driver's Profile</h1>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Details</h2>
			</div>
			<div class="panel-body">
				<form action="{{ url('/home/drivers/'.$driver->id.'/update') }}" method="post">
				{{ csrf_field() }}
					<div class="col-sm-3">
							<img src="{{ asset('images/drivers/'.$driver->id.'.jpg') }}" style="box-shadow: 2px 2px 2px 2px silver; width: 175px;height: 250px;">	
					</div>
					<div class="col-sm-9">
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="firstname">Firstname</label>
								<input type="text" name="firstname" id="firstname" value="{{ $driver->firstname }}" class="form-control">
							</div>
							<div class="form-group col-sm-4">
								<label for="surname">Surname</label>
								<input type="text" name="surname" id="surname" value="{{ $driver->surname }}" class="form-control">
							</div>
							<div class="col-sm-4">
								<label for="status">Status</label>
								<br>
								@if($driver->confirmed == 0)
									<a href="{{ url('/home/drivers/'.$driver->id.'/confirm') }}" class="btn btn-warning btn-sm">Pending</a>
								@elseif($driver->confirmed == 1)
									<a href="{{ url('/home/drivers/'.$driver->id.'/confirm') }}" class="btn btn-success btn-sm">Confirmed</a>
								@else
									<a href="{{ url('/home/drivers/'.$driver->id.'/confirm') }}" class="btn btn-danger btn-sm">Banned</a>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="{{ $driver->email }}" class="form-control">
							</div>
							<div class="form-group col-sm-4">
								<label for="phone">Phone</label>
								<input type="phone" name="phone" id="phone" value="0{{ $driver->phone }}" class="form-control">
							</div>
						</div>
						<div class="row col-sm-2" style="margin-top: 70px">
							<button role="submit" class="btn btn-primary btn-sm">Update</button>
						</div>	
					</div>			
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Documents</h2>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="panel panel-default" style="margin-top: 70px;">
			<div class="panel-heading">
				<h2>History</h2>
			</div>
			<div class="panel-body">
				<table class="table table-stripped">
					<tr>
						<th>Booking N°</th>
						<th>State</th>
						<th>Pick-up</th>
						<th>Drop off</th>
						<th>Scooter Model</th>
					</tr>
					@foreach($bookings as $booking)
					<tr>
						<th>{{ $booking->id }}</th>
						<th>{{ $booking->state }}</th>
						<th>{{ date_format(date_create($booking->pick_up_date),'d F Y') }}</th>
						<th>{{ date_format(date_create($booking->drop_off_date),'d F Y') }}</th>
						<th>{{ $booking->model }}</th>
					</tr>
					@endforeach
				</table>
			</div>
			<div class="panel-footer">
				<p><b>Favorite Scooter :</b> {{ ucfirst($favorite_scooter->model) }}</p>
			</div>
		</div>
	</div>
</div>
@stop