@extends('layouts.main')
@section('content')

	<div class="container scooter-show">
		<div class="row" style="padding: 30px 0px">
		@if(isset($scooter))
			<div class="media">
				<div class="media-left media-middle col-xs-12 col-sm-6">
					@if(!empty($color))
						<img class="scooter-img" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'-'.lcfirst($color).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}">
					@else
						<img class="scooter-img" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'-'.lcfirst($scooter->color).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}">
					@endif
				</div>
				<div class="col-xs-12 col-sm-6">
					<h2>Informations</h2>
					<ul class="list-unstyled">
						<li>Model : {{ ucfirst($scooter->model) }}</li>
						<li>Year : {{ $scooter->year }}</li>
						<li>Kilometers : {{ $scooter->kilometers }}km</li>
						<li>
							<div class="col-xs-2" style="padding: 0">
								Colors : 
							</div>
							@foreach($scooter_color as $color)
							<div class="col-xs-1" style="padding: 0">
								<a href="{{ url('/scooters/'.str_replace(' ','-',$scooter->model).'/'.lcfirst($color->color)) }}" title="{{ $color->color }}">
									<div style="width: 20px; height: 20px; background-color: {{$color->color}}; border: 2px solid black">
									</div>
								</a>
							</div>
							@endforeach
						</li>	
					</ul>
					<h2>Details</h2>
					<p>{{ $scooter->info }}</p>
					<p><a href="{{ url('/#rent-it') }}" class="btn btn-success" role="button">Rent it</a></p>
				</div>
			</div>	
		@else
			<h1>The requested product doesn't exist...</h1>
			<p><a href="{{ url('/') }}">Back to home page</a></p>
		@endif
		</div>
	</div>
@stop