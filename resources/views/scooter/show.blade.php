@extends('layouts.main')
@section('content')
	<div class="container">
		<div class="row" style="padding: 30px 0px">
		@if(isset($scooter))
			<div class="media">
				<div class="media-left media-middle">
					<img style="height: 400px; width: 600px;" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}">
				</div>
				<div class="media-body">
					<h2>Informations</h2>
					<ul class="list-unstyled">
						<li><b>Model</b> : {{ ucfirst($scooter->model) }}</li>
						<li><b>Year</b> : {{ $scooter->year }}</li>
						<li><b>Kilometers</b> : {{ $scooter->kilometers }}km</li>
						<li><b>Colors</b> : {{ $scooter->color }}</li>
					</ul>
					<h2>Details</h2>
					<p>{{ $scooter->info }}</p>
					<p><a href="" class="btn btn-success" role="button">Rent Now</a></p>
				</div>
			</div>	
		@else
			<h1>The requested product doesn't exist...</h1>
			<p><a href="">Back to home page</a></p>
		@endif
		</div>
	</div>
@stop