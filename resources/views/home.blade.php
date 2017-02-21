@extends('layouts.main')
@section('content')
	<div class="container-fluid">
		<div id="beta-version">
			<p>Beta Version</p>
		</div>
		<div class="hidden-xs" style="width:100%;text-align: center;color: white;position: absolute;left: 0;bottom: 210px">
			<div class="col-sm-6 col-sm-offset-3">
				<h1>We ride</h1>
				<h2>Start riding today, earn money tomorow</h2>
			</div>
			@if(Session::has('success'))
				<div class="col-sm-6 col-sm-offset-3 alert alert-success">
					<p>{{ Session::get('success') }}</p>
				</div>
			@endif
		</div>
		<div class="row">
			<div class="hidden-sm hidden-md hidden-lg">
				<img src="{{ asset('images/scooter.jpeg') }}" style="width: 100%; margin-top: -125px">
			</div>
		</div>
		@include('home.landing_page_form')
	</div> 

		<div class="container second-screen">
				<div style="border-bottom: 1px silver solid; padding: 50px 0px;">
					<div class="container-fluid">
						<h2 style="text-align:center;">Rent your scooter with WeRide</h2>
						<p style="text-align: center;">
							WeRide is proposing you an alternative and low cost way to ride a motorcycle without buying it.
							<br>
							Why renting a scooter? We offer low cost, keys in hand rental solution: the scooter, equipment and insurance for a price lower than a backpacker room in Sydney.
							<br>
							It is an all-inclusive rental solution; we take care of the insurance, service and repairs.
							You just have to choose your model, the accessories you want with. We drop it to your address or come have a chat in store and you are good to go.
							<br>
							No hidden fees, you exactly know how much it is going to cost you for the week, starting from $20/day<span style="font-style: italic; font-size: 0.8em">*including GST.</span>
						</p>
						<div class="row" style="padding: 50px">
							<div class="col-sm-4 col-sm-offset-5">
								<a href="{{ url('/scooters') }}" class="btn btn-primary">Look at the scooters</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset1.jpeg') }}" style="width: 100%;height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Beat the traffic</h3>
									<p></p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset2.jpeg') }}" style="width: 100%;height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Save money</h3>
									<p></p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset3.jpeg') }}" style="width: 100%; height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Stay independant</h3>
									<p></p>
								</div>
							</div>
						</div>
						<h3 style="text-align: center">What are your benefits from renting a scooter ?</h3>
						<h4 style="text-align: center"><span style="font-style: italic">Beat the traffic, save on money, and stay independent</span></h4>
						<p style="text-align: center">
							Motorbike’s owners spend an average of $1500 per year for the general maintenance of their ride. By renting, you don’t have worry about it.
							<br>
							Also, motorbike parking is free in the city of SYDNEY !!<span style="font-style: italic; font-size: 0.8em">*Conditions Apply.</span>
						</p>
					</div>
				</div>

				@include('home.price_display')

				<div class="container-fluid" style="border-bottom: 1px silver solid; padding: 50px 0px">
					<h2 style="text-align:center;">Book with us</h2>
					<div class="col-xs-12">
						<p style="text-align: center">
							After completing the form we will contact you shortly. So make sure you leave us a way to reach you.
							<br>
							While in store, you will just have to choose your model and the accessories you want with. We drop it to your address or come have a chat in store and you are good to go.
							<br>
							Too busy or new in the city ? Rather than coming to the shop, we can deliver the scooter to your location within a 20km radius from the CBD. Just tick the delivery option when you are filling the form.
						</p>
					</div>
					<h2 style="text-align:center;">What do you need to rent ?</h2>
					<div class="col-sm-4">
						<h3 style="text-align:center;">1</h3> 
						<h4 style="text-align:center;">A valid ID</h4>
					</div>
					<div class="col-sm-4">
						<h3 style="text-align:center;">2</h3>
						<h4 style="text-align:center;">An Australian 125cc scooter licence</h4>
					</div>
					<div class="col-sm-4">
						<h3 style="text-align:center;">3</h3>
						<h4 style="text-align:center;">Get covered !</h4>
					</div>
					<p style="text-align: center; margin-top: 150px">
							Having a motorbike license is compulsory to ride a motorcycle in NSW (and Victoria as well). 
							<br>
							Then you will have to provide either a NSW riding license; learner stage allow you to ride a vehicle up to 125cc.
							<br>
							Or your overseas license clearly stating your right to ride the desired category, coming with its international translation (International license).
							<br>
							<a href="#">More information</a>
						</p>
				</div>

				<div class="container-fluid">
					<h2 style="text-align:center;">Contact Us</h2>
					<div style="padding: 50px">
						<div class="col-sm-6">
							<h3>Address</h3>
							<p><span class="fa fa-map-marker" aria-hidden="true"></span> <a href="https://www.google.com.au/maps/place/406+Botany+Rd,+Beaconsfield+NSW+2015/@-33.9103811,151.1998189,17z/data=!3m1!4b1!4m5!3m4!1s0x6b12b1b8fd8629c5:0x7f7a8970806031a3!8m2!3d-33.9103811!4d151.2020076?hl=fr">406 Botany Rd, Beaconsfield NSW 2015</a></p>
							<h3>Phone Number</h3>
							<p><span class="fa fa-phone" aria-hidden="true"></span> 0410 125 994</p>
							<h3>Email Address</h3>
							<p><span class="fa fa-envelope" aria-hidden="true"></span> contact@tweelz.com</p>
							<h3>Open Hours</h3>
							<p><span class="fa fa-clock-o" aria-hidden="true"></span> 9am to 1pm</p>
							<h3>Transports</h3>
							<h4>Train</h4>
							<p><span class="fa fa-train"></span> <a href="http://www.sydneytrains.info/timetables/timetables_by_line.htm?line=eh&dir=2#landingPoint"><span class="label label-warning" style="border-radius: 50px; padding: 5px">T2</span></a> Station Green Square</p>
							<h4>Bus</h4>
							<p><span class="fa fa-bus"></span> <a href="http://www.sydneybuses.info/routes/309_20151004_tt.pdf"><span class="label label-info">309</span></a> <a href="http://www.sydneybuses.info/routes/309_20151004_tt.pdf"><span class="label label-info">310</span></a></p>
						</div>
						<div class="col-sm-6">
							<iframe class="hidden-xs" width="400" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJxSmG_bixEmsRozFggHCJen8&key=AIzaSyA8cF6MhPz1UZPyBe9hiGr7zPdthmAe4E4" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
@stop