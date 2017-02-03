@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Scooter informations</h1>
		</div>
		<div class="panel-body">
			<form action="{{ url('/home/scooters/'.$scooter->id.'/update') }}" method="post">
				{{ csrf_field() }}
				<div class="col-sm-4">
					<img src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}" style="max-height: 150px;">
					<input class="form-control" type="file" name="scooter-picture">
				</div>

				<div class="col-sm-2">
					
					<div class="form-group">
						<label for="model">Model</label>
						<input class="form-control" type="text" name="model" value="{{ $scooter->model }}">	
					</div>

					<div class="form-group">
						<label for="availability">Status</label>
						@if($scooter->availability == 1)
						<br>
						<span class="btn btn-success btn-sm">In Store</span>
						@elseif($scooter->availability == 2)
						<br>
						<span class="btn btn-danger btn-sm">Garage</span>
						@endif
						<input class="form-control" type="number" name="availability" value="{{ $scooter->availability }}">
					</div>

					<div class="form-group">
						<label for="color">Color</label>
						<input class="form-control" type="text" name="color" value="{{ $scooter->color }}">
					</div>

					<div class="form-group">
						<label for="state">State</label>
						<input class="form-control" type="text" name="state" value="{{ $scooter->state }}">
					</div>

					<div class="form-group">
						<label for="plate">Plate</label>
						<input class="form-control" type="text" name="plate" value="{{ $scooter->plate }}">
					</div>
					
					<div class="form-group">
						<label for="year">Year</label>
						<input class="form-control" type="number" name="year" value="{{ $scooter->year }}">
					</div>

					<div class="form-group">
						<label for="category">Category</label>
						<input class="form-control" type="text" name="category" value="{{ $scooter->category }}">
					</div>

					<div class="form-group">
						<label for="kilometers">Kilometers</label>
						<input class="form-control" type="text" name="kilometers" value="{{ $scooter->kilometers }}">
					</div>

					<div class="form-group">
						<label for="last_check">Last Check</label>
						<input class="form-control" type="date" name="last_check" value="{{ $scooter->last_check }}">
					</div>

					<div class="form-group">
						<label for="info">Info</label>
						<textarea class="form-control" name="info">{{ $scooter->info }}</textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm">Update</button>
					</div>

				</div>

			</form>
		</div>
	</div>
</div>
@stop