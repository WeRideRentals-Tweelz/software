<div class="row" style="border-bottom: 1px silver solid;padding: 50px 0px">
	<div class="col-md-8">
		<div class="row">
			<h3><span class="fa fa-newspaper-o fa-2x"></span> News</h3>
		</div>
		<!-- Here comes the Facebook news -->
		<div class="row" style="padding: 50px 0px">
			<div class="media">
				<div class="media-left media-middle">
					<a href="#">
						<img style="height: 120px; width: 120px;" src="{{ asset('images/user.png') }}" alt="Facebook Post Image" class="media-object">
					</a>
				</div>
				<div class="media-body" style="padding: 0px 30px">
					<h4 class="media-heading">Facebook Post Title</h4>
					<p style="text-align: justify;">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
			</div>
			<div class="media">
				<div class="media-left media-middle">
					<a href="#">
						<img style="height: 120px; width: 120px;" src="{{ asset('images/user.png') }}" alt="Facebook Post Image" class="media-object">
					</a>
				</div>
				<div class="media-body" style="padding: 0px 30px">
					<h4 class="media-heading">Facebook Post Title</h4>
					<p style="text-align: justify;">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<h3><span class="fa fa-motorcycle pull-left"></span>Discover our latest scooters</h3>
		<div class="row" style="padding: 50px 0px">
		@foreach($scooters as $scooter)
			<div class="col-md-6">
				<div class="thumbnail" style="min-height: 280px">
					<img src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}" style="max-height: 150px;">
					<div class="caption">
						<h4>{{ $scooter->model }}</h4>
						<p>{{ substr($scooter->info,0,50) }}</p>
						<p style="position: absolute;bottom: 25px;"><a href="{{ url('/scooters/'.$scooter->id) }}" class="btn btn-info" role="button">More information</a></p>
					</div>
				</div>
			</div>
		@endforeach
		<div class="row">
			<p style="text-align: center"><a href="{{ url('/scooters') }}" class="btn btn-primary" role="button">View all models</a></p>
		</div>
	</div>
</div>