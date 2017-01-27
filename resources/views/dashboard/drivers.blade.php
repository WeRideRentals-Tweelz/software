@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Drivers waiting for confirmation</h3>
		</div>
		<div class="panel-body">
			<table class="col-xs-12 table table-striped">
				<tr>
					<th>Name</th>
					<th>Familly Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Inscription Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				@foreach($new_drivers as $driver)
				<tr>
					<th>{{ $driver->firstname }}</th>
					<th>{{ $driver->surname }}</th>
					<th>0{{ $driver->phone }}</th>
					<th>{{ $driver->email }}</th>
					<th>{{ date_format(date_create($driver->created_at),'d F Y') }}</th>
					<th><a href="{{ url('/home/drivers/'.$driver->id.'/confirm') }}" class="btn btn-warning btn-sm" role="button">Pending</a></th>
					<th><a href="{{ url('/home/drivers/'.$driver->id) }}" class="btn btn-info btn-sm" role="button">Details</a></th>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Confirmed Drivers</h3>
		</div>
		<div class="panel-body">
			<table class="col-xs-12 table table-striped">
				<tr>
					<th>Picture</th>
					<th>Name</th>
					<th>Familly Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Inscription Date</th>
					<th>Actions</th>
				</tr>
				@foreach($drivers as $driver)
				<tr>
					<th><img src="{{ asset('images/drivers/'.$driver->id.'.jpg') }}" style="height:50px;width: 50px"></th>
					<th>{{ $driver->firstname }}</th>
					<th>{{ $driver->surname }}</th>
					<th>0{{ $driver->phone }}</th>
					<th>{{ $driver->email }}</th>
					<th>{{ date_format(date_create($driver->created_at),'d F Y') }}</th>
					<th><a href="{{ url('/home/drivers/'.$driver->id) }}" class="btn btn-info btn-sm" role="button">Details</a></th>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@stop