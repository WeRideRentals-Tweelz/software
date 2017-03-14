@extends('layouts.main')
@section('content')
	
	<!-- Arrow for switching from a scooter model to another -->
	<div>
		<nav aria-label="...">
		  <ul class="pager">
		  	
		  	@if($scooter->id != 1)
		    	<li class="previous" style="position: absolute;left: 25px;"><a style="padding:20px" href="{{ url('/scooters/'.$previous)  }}" title='Previous scooter'><span aria-hidden="true">&larr;</span> Previous</a></li>
		    @endif

		    @if($scooter->id != $last->id)
		    	<li class="next" style="position: absolute;right: 25px;"><a style="padding:20px" href="{{ url('/scooters/'.$next)  }}" title='Next scooter'>Next <span aria-hidden="true">&rarr;</span></a></li>
		  	@endif

		  </ul>
		</nav>
	</div>

	<div class="container scooter-show">
		<div class="row" style="padding: 30px 0px">
		@if(isset($scooter))
			<div class="media">
				<div class="media-left media-middle col-xs-12 col-sm-6">
					<img class="scooter-img" src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}">
				</div>
				<div class="col-xs-12 col-sm-6">
					<h2>Informations</h2>
					<ul class="list-unstyled">
						<li><b>Model</b> : {{ ucfirst($scooter->model) }}</li>
						<li><b>Year</b> : {{ $scooter->year }}</li>
						<li><b>Kilometers</b> : {{ $scooter->kilometers }}km</li>
						<li><b>Colors</b> : {{ $scooter->color }}</li>
					</ul>
					<h2>Details</h2>
					<p>{{ $scooter->info }}</p>
					<p><a href="{{ url('/#rent-it') }}" class="btn btn-success" role="button" title="Go to rent form">Rent it</a></p>
				</div>
			</div>	
		@else
			<h1>The requested product doesn't exist...</h1>
			<p><a href="{{ url('/') }}">Back to home page</a></p>
		@endif
		</div>
	</div>
@stop