<div class="col-sm-6">
	@if(isset($scooter))
		@if($scooterService->needsCheck($scooter))
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h2>Checks needed :</h2>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						@foreach($scooterService->checksToDo($scooter) as $check)
							<li class="list-group-item">{{ $check }}km x {{ $scooterService->kmChecksNeeded($scooter)[$check] }}<a href="{{ url('/home/scooter/'.$scooter->id.'/KmCheck/'.$check) }}" class="btn btn-warning btn-xs pull-right">Details</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endif

	@if(isset($scooter))
	<div class="panel panel-success">
		<div class="panel-heading">
			<h2>Repairs History</h2>
		</div>
		<div class="panel-body">
			@if(count($scooterService->getRepairs($scooter)) >= 1)
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Kilometers</th>
						<th>Type</th>
						<th>Part</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($scooterService->getRepairs($scooter) as $repair)
					<tr>
						<td>{{ date_format(date_create($repair->date), 'd/m/Y') }}</td>
						<td>{{ $repair->kilometers }}</td>
						<td>{{ $repair->reason }}</td>
						<td>{{ $repair->part }}</td>
						<td><a href="/scooter/{{ $repair->id }}/removeRepair" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
				<p>No repairs made</p>
			@endif
		</div>
		<div class="panel-heading">
			<h4>Add repair</h4>
		</div>
		<div class="panel-body">
			<form action="/scooter/{{ $scooter->id }}/repair" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="form-group col-sm-4">
						<label for="repairDate">Date</label>
						<div class='input-group date' id="repairDate">
		                    <input  type='text' name="repairDate" class="form-control">
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
				        </div>
					</div>

					<div class='form-group col-sm-4'>
						<label for="reason">Type</label>
						<input type="text" name="reason" class="form-control">
					</div>

					<div class='form-group col-sm-4'>
						<label for="part">Part</label>
						<input type="text" name="part" class="form-control">
					</div>

					<input type="hidden" name="kilometers" value="{{ $scooter->kilometers }}">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit">Add repair</button>
				</div>
			</form>
		</div>
	</div>
	@endif
	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h2>Bookings History</h2>
		</div>
		<div class="panel-body">
			@if(isset($bookings) && count($bookings) > 0 )
			<table class="table table-striped table-condensed">
				<thead>
					<tr>
						<th>Booking Number</th>
						<th>Driver</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Days Booked</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bookings as $booking)
					<tr>
						<td>{{ $booking->id }}</td>
						<td><a href="{{ url('/user/'.$booking->user_id) }}">{{ $booking->user->name }}</a></td>
						<td>{{ date_format(date_create($booking->pick_up_date), 'd M Y') }}</td>
						<td>{{ date_format(date_create($booking->drop_off_date), 'd M Y') }}</td>
						<td>{{ date_create($booking->drop_off_date)->diff(date_create($booking->pick_up_date))->d }}</td>
						<td><a href="{{ url('/bookings/'.$booking->id.'/edit') }}" class="btn btn-info btn-xs">Details</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<p>No Booking History</p>
			@endif
		</div>
	</div>
</div>