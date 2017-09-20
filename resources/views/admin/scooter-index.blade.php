@extends('layouts.main')
@section('content')	
	<div class="container" style="min-height: 670px;">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 style="text-align: center;">Scooters</h1>
			</div>
			<div class="panel-body">
				<div class="row" style="margin-top: 50px">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Picture</th>
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
									@if(!$scooterService->isBooked($scooter))
										@if($scooterService->needsCheck($scooter))
											<p class="alert alert-warning">{{ $scooterService->scooterStatus($scooter) }}</p>
										@else
											<p class="alert alert-success">{{ $scooterService->scooterStatus($scooter) }}</p>
										@endif
									@else
										<p class="alert alert-danger">{{ $scooterService->scooterStatus($scooter) }}</p>
									@endif
								</td>
								<td><a href="{{ url('home/scooters/'.$scooter->id) }}" class="btn btn-primary btn-xs">Profile</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<a href="{{ url('/scooters/create') }}" class="btn btn-primary">Add new Scooter</a>
			</div>
		</div>
	</div>	
@stop