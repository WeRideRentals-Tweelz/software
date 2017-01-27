@extends('layouts.main')
@section('content')
	<div class="container" style="min-height: 670px">
		<div class="row" style="margin-bottom:50px;padding-left: 15px;padding-right: 15px;">
			<a href="{{ url('/home/bookings') }}">
				<div class="col-sm-6" style="box-shadow: 2px 2px 2px 2px gray;text-align: center; padding: 20px 0px;">
					<h3>Bookings</h3>
					<span class="fa fa-book fa-5x"></span>
				</div>
			</a>
			<a href="{{ url('/home/drivers') }}">
				<div class="col-sm-6" style="box-shadow: 2px 2px 2px 2px gray;text-align: center;padding: 20px 0px;">
					<h3>Drivers</h3>
					<span class="fa fa-user fa-5x"></span>
				</div>
			</a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Scooters Today Status</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-hover">
					<tr style="text-align: center">
						<th>Image</th>
						<th>Model</th>
						<th>Plate</th>
						<th>Km</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					@foreach($scooters as $scooter)
					<tr>
						<td><img style="height: 40px; width: 60px;" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}"></td>
						<td>{{ $scooter->model }}</td>
						<td>{{ $scooter->state }} - {{ $scooter->plate }}</td>
						<td>{{ $scooter->kilometers }} km</td>
						<td>
						@if(count($available) != count($scooters))
						@foreach($available as $scooter_available)
							@if($scooter->id != $scooter_available->id)
								<a href="" class="btn btn-info btn-sm" role="button">Rented</a>
							@else
								@if($scooter->availability == 1)
									<a href="/scooter/{{ $scooter->id }}/garage" class="btn btn-success btn-sm" role="button">In Store</a>	
								@elseif($scooter->availability == 2)
									<a href="/scooter/{{ $scooter->id }}/in-store" class="btn btn-danger btn-sm" role="button">Garage</a>
								@endif
							@endif
						@endforeach
						@else
							@if($scooter->availability == 1)
								<a href="/scooter/{{ $scooter->id }}/garage" class="btn btn-success btn-sm" role="button">In Store</a>	
							@elseif($scooter->availability == 2)
								<a href="/scooter/{{ $scooter->id }}/in-store" class="btn btn-danger btn-sm" role="button">Garage</a>
							@endif							
						@endif
						</td>
						<td>
							<a style="margin-left: 20px" href="/scooters/{{ $scooter->id }}/update" class="btn btn-info btn-sm" role="button">More Details</a>
							<a href="/scooters/{{ $scooter->id }}/delete" class="btn btn-danger btn-sm" role="button">Delete</a>
						</td>
					</tr>				
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop