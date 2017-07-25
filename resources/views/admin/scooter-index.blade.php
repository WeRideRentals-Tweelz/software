@extends('layouts.main')
@section('content')	
	<div class="container" style="min-height: 670px;">
		<h1 style="text-align: center;">Scooters</h1>
		<div class="row" style="margin-top: 50px">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Plate</th>
						<th>Model</th>
						<th>Last Check</th>
						<th>Kilometers</th>
						<th>Today's Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($scooters as $scooter)
					<tr>
						<td><img src="{{ url('storage/'.$scooter->plate.'-'.$scooter->model.'-'.$scooter->color.'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}" height="100"></td>
						<td>{{ $scooter->plate }}</td>
						<td>{{ $scooter->model }}</td>
						<td>{{ date_format(date_create($scooter->last_check),'d/m/Y') }}</td>
						<td>{{ $scooter->kilometers }} km</td>
						<td>
							@if($scooterService->isAvailable($scooter))
								<p class="alert alert-success">{{ $scooterService->isAvailable($scooter,true) }}</p>
							@else
								<p class="alert alert-danger">{{ $scooterService->isAvailable($scooter,true) }}</p>
							@endif
						</td>
						<td><a href="{{ url('home/scooters/'.$scooter->id) }}" class="btn btn-primary btn-xs">Profile</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<a href="{{ url('/scooters/create') }}" class="btn btn-primary btn-sm">Add new Scooter</a>
	</div>	
@stop