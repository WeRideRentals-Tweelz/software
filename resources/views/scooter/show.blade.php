@extends('layouts.main')
@section('content')
	
	<!-- Arrow for switching from a scooter model to another -->
	<div>
		<nav aria-label="...">
		  <ul class="pager">
		  	
		  	@if($scooter->id != 1)
		    	<li class="previous" style="position: absolute;left: 25px; top: 300px;"><a style="padding:20px" href="{{ url('/scooters/'.$previous)  }}"><span aria-hidden="true">&larr;</span> Previous</a></li>
		    @endif

		    @if($scooter->id != $last->id)
		    	<li class="next" style="position: absolute;right: 25px;top: 300px;"><a style="padding:20px" href="{{ url('/scooters/'.$next)  }}">Next <span aria-hidden="true">&rarr;</span></a></li>
		  	@endif

		  </ul>
		</nav>
	</div>

	<div class="container" style="height: 645px">
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