@extends('layouts.main')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1 style="text-align: center; margin-bottom: 50px;">Rent a scooter</h1>
			</div>

			@include('home.date_picker')

			<div class="row" style="border-bottom: 1px silver solid; padding: 50px 0px">
				<div class="container">
					<h2 style="text-align:center;">Sub-title anchor message</h2>
					<p style="text-align: center;">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
			</div>

			@include('home.price_display')
			
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
						<div class="col-md-6">
							<div class="thumbnail">
								<img src="{{ asset('images/scooter.jpg') }}" alt="Scooter Picture">
								<div class="caption">
									<h4>Product label</h4>
									<p>Short text (optionnal)</p>
									<p><a href="#" class="btn btn-info" role="button">More information</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="thumbnail">
								<img src="{{ asset('images/scooter.jpg') }}" alt="Scooter Picture">
								<div class="caption">
									<h4>Product label</h4>
									<p>Short text (optionnal)</p>
									<p><a href="#" class="btn btn-info" role="button">More information</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="thumbnail">
								<img src="{{ asset('images/scooter.jpg') }}" alt="Scooter Picture">
								<div class="caption">
									<h4>Product label</h4>
									<p>Short text (optionnal)</p>
									<p><a href="#" class="btn btn-info" role="button">More information</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="thumbnail">
								<img src="{{ asset('images/scooter.jpg') }}" alt="Scooter Picture">
								<div class="caption">
									<h4>Product label</h4>
									<p>Short text (optionnal)</p>
									<p><a href="#" class="btn btn-info" role="button">More information</a></p>
								</div>
							</div>
						</div>						
					</div>
					<div class="row">
						<p style="text-align: center"><a href="{{ url('/scooters') }}" class="btn btn-primary" role="button">View all models</a></p>
					</div>
				</div>
			</div>
			<div class="row" style="padding: 50px 0px">
				<h3 style="text-align: center">Our Partners</h3>
				<div class="row">
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="{{ asset('images/partner.png') }}" alt="our partner">
							<div class="caption">
								<h4 style="text-align: center">Partner name</h4>
							</div>						
						</div>
					</div>
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="{{ asset('images/partner.png') }}" alt="our partner">
							<div class="caption">
								<h4 style="text-align: center">Partner name</h4>
							</div>						
						</div>
					</div>
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="{{ asset('images/partner.png') }}" alt="our partner">
							<div class="caption">
								<h4 style="text-align: center">Partner name</h4>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop