@extends('layouts.main')
@section('content')

	<!-- Header Start -->
		<div id="header" class="container-fluid">
			<div id="beta-version">
				<p>Beta Version</p>
			</div>

			<div id="desktop-image" class="row">
				<img src="{{ asset('images/scooter.jpeg') }}">
			</div>

			<div id="titles" class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1">
				<div id="title" class="">
					<h1 class="bold hidden">WeRide</h1>
					<div id="logo-large">
						<img src="{{ asset('images/logo-large.png') }}" alt="logo">
					</div>
					<h2><i>Work, Leisure, Lifestyle</i></h2>
				</div>
			</div>

			<div id="desktop-form" class="col-lg-3 col-lg-offset-8">
				<div id="form-contact" class="col-xs-12">
					<p>Contact us at : 0412 140 826</p>
					@if(Session::has('success'))
						<div class="col-xs-12 alert alert-success">
							<p>{{ Session::get('success') }}</p>
						</div>
					@endif
					@if($errors->any())
						<ul class="alert alert-danger list-group">
							@foreach($errors->all() as $error)
								<li class="list-group-item">{{ $error }}</li>
							@endforeach
						</ul>
					@elseif(Session::has('error'))
						<div class="col-xs-12 alert alert-danger">
							<p>{{ Session::get('error') }}</p>
						</div>
					@endif
				</div>
				<form class="form" action="/quote" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div id="form-input-group">
						<input type="{{ Auth::check() ? 'hidden' : 'text' }}" name="name" placeholder="Name" class="form-control" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
						<input type="{{ Auth::check() ? 'hidden' : 'text' }}" name="surname" placeholder="Surname" class="form-control" value="{{ Auth::check() ? Auth::user()->surname : '' }}" required>
						<input type="{{ Auth::check() ? 'hidden' : 'text' }}" name="phone" placeholder="Phone" class="form-control" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
						<input type="{{ Auth::check() ? 'hidden' : 'email' }}" name="email" placeholder="Email" class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
						
						<div class="form-group col-xs-6">
					            <div class='input-group date row' id='pickUpDate'>
					                    <input id="pickUp"  type='text' name="pickUp" class="form-control" placeholder="Pick Up Date" required/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>

					            <div class="form-group col-xs-6">
					            <div class='input-group date row' id='dropOffDate'>
					                    <input id="dropOff" type='text' name="dropOff" class="form-control" placeholder="Drop Off Date" required/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>

						<div class='col-xs-12'>
							<p id="price-helper"></p>
							<p><a href="#prices" class="btn btn-info btn-xs">Check our price range</a></p>
						</div>

						<div id="form-button-container" class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
							<button type="submit" onclick=ga(‘send’,’event’,’Button’,’Click’,’NewClient’, '0') class="button-bounce btn btn-primary form-control rent-scooter">Book Now</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<!-- End Header -->

		<div class="container second-screen">
				<div class="section">
					<div class="container-fluid">
						<h2><span class="gold">R</span>ent your scooter with <span class="gold">We</span>Ride</h2>
						<p>
							<span class="gold">We</span>Ride is a low cost, all inclusive rental solution to get you riding today.
							Forget registrations, maintenance and insurances, we take care of it for you.
							We can also offer you all accessories that goes with it.
							<br>
							<br>
							<span class="bold">Why renting with us ?</span> 
							<br>
							We offer low cost and keys in hand rental solution: scooter, equipment and insurance for a price lower than a backpacker room in Sydney.
							<br>
							<br>
							<span class="bold">You have the choice :</span>
							<br>
							We drop it to your address <span class="oldGold">or</span> you come have a chat with us in store and you are good to go.
							<br>
							No hidden fees, you exactly know how much it is going to cost you for the week, starting from $20/day<span class="italic-little">*including GST.</span>
						</p>

						@include('home.price_display')

						<h2><span class="gold">W</span>hat are the benefits from renting a scooter ?</h2>
						<div class="col-sm-4 benefits">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset1.jpeg') }}" alt="beat the traffic">
								<div class="caption">
									<h3>Beat the traffic</h3>
								</div>
							</div>
						</div>
						<div class="col-sm-4 benefits">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset2.jpeg') }}" alt="save money">
								<div class="caption">
									<h3>Earn money</h3>
								</div>
							</div>
						</div>
						<div class="col-sm-4 benefits">
							<div class='thumbnail'>
								<img src="{{ asset('images/asset3.jpeg') }}" alt="stay independant">
								<div class="caption">
									<h3>Stay independant</h3>
								</div>
							</div>
						</div>
						<p>
							Motorbike’s owners spend an average of $1500 per year for the general maintenance of their ride. 
							<br>
							By renting, you don’t have to worry about it.
							<br>
							Also, motorbike parking is free in the city of SYDNEY !!<span class="italic-little">*Conditions Apply.</span>
						</p>
					</div>
				</div>

				<div class="section">
					<div class="container-fluid">
						<h2><span class="gold">B</span>ook with us</h2>
						<div class="col-xs-12">
							<p>
								Once you have placed an online request, one of our friendly staff will contact you to finalise your booking over the phone.
								<br>
								Visit our store to choose your scooter and the accessories you want.
								<br>
								Too busy or new in the city ? Rather than coming to the shop, we can deliver the scooter to your location within a 20km radius from the CBD. Just tick the delivery option when you are filling the form.
							</p>
						</div>
					</div>
					<div style="margin-top: 25px" class="container-fluid">
						<h2><span class="gold">W</span>hat do you need to rent ?</h2>
						<div class="row">
							<div class="col-sm-4">
								<h3 class="bubble" style="background-color: lightpink;">1</h3> 
								<h4>A valid ID</h4>
							</div>
							<div class="col-sm-4">
								<h3 class="bubble" style="background-color: lightgreen;">2</h3>
								<h4>A 125cc licence</h4>
							</div>
							<div class="col-sm-4">
								<h3 class="bubble" style="background-color: lightblue;">3</h3>
								<h4>A $280 bond</h4>
							</div>
						</div>
					</div>

					<div class="row cta-container">
						<a href="#rent-it" class="button-bounce col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3 btn btn-primary btn-lg btn-responsive" onclick=ga(‘send’,’event’,’Button’,’Click’,’CTABookNow’,'0')>Order Now</a>
					</div>	

					<div id="more-info" class="container-fluid" style="margin-top: 40px">
						<p style="padding: 0px 15px">
							Having a motorbike license is compulsory to ride a motorcycle in NSW (and Victoria as well). 
							<br>
							Then you will have to provide a motorcycle license from any Australian states or oversea licence.
							<br>
							<span class="oldGold">A learner rider licence is enough to ride up a to 125cc scooter category</span>
							<br>
							<a href="http://www.rms.nsw.gov.au/geared/your_licence/getting_a_licence/on_your_bike.html" onclick=ga(‘send’,’event’,’Button’,’Click’,’MoreInformationOn125Licence’,'0') target="_blank">Get your licence today</a>
							<br>
							Your overseas license must clearly mention that you can ride the desired category, plus its international translation : International license.
						</p>
					</div>
				</div>

				<div class="final section container-fluid">
					<h2><span class="gold">C</span>ontact Us</h2>
					<h3>Still have a question in mind ? Contact us or come chat with us in store !</h3>
					<div style="padding: 50px">
						<div class="col-sm-6 not-aligned">
							<h3><span class="bold">Address</span></h3>
							<p><span class="fa fa-map-marker" aria-hidden="true"></span> <a href="https://www.google.com.au/maps/place/406+Botany+Rd,+Beaconsfield+NSW+2015/@-33.9103811,151.1998189,17z/data=!3m1!4b1!4m5!3m4!1s0x6b12b1b8fd8629c5:0x7f7a8970806031a3!8m2!3d-33.9103811!4d151.2020076?hl=fr" onclick=ga(‘send’,’event’,’Button’,’Click’,’GetAdressInGoogleMaps’,'0')>406 Botany Rd, Beaconsfield NSW 2015</a></p>
							<h3><span class="bold">Phone Number</span></h3>
							<p><span class="fa fa-phone" aria-hidden="true"></span> 0412 140 826</p>
							<h3><span class="bold">Email Address</span></h3>
							<p><span class="fa fa-envelope" aria-hidden="true"></span> contact@weriderentals.com</p>
							<h3><span class="bold">Open Hours</span></h3>
							<p><span class="fa fa-clock-o" aria-hidden="true"></span> 9am to 1pm</p>
							<h3><span class="bold">Transports</span></h3>
							<h4>Train</h4>
							<p><span class="fa fa-train"></span> <a href="http://www.sydneytrains.info/timetables/timetables_by_line.htm?line=eh&dir=2#landingPoint"><span class="label label-warning" target="_blank" style="border-radius: 50px; padding: 5px">T2</span></a> Station Green Square</p>
							<h4>Bus</h4>
							<p><span class="fa fa-bus"></span> <a href="http://www.sydneybuses.info/routes/309_20151004_tt.pdf"><span class="label label-info">309</span></a> <a href="http://www.sydneybuses.info/routes/309_20151004_tt.pdf"><span class="label label-info">310</span></a></p>
						</div>
						<div class="col-sm-6">
							<iframe class="hidden-xs google-maps" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJxSmG_bixEmsRozFggHCJen8&key=AIzaSyA8cF6MhPz1UZPyBe9hiGr7zPdthmAe4E4" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
@stop

@section("scripts")
<script type="text/javascript">
            $(function () {
                $('#pickUpDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#dropOffDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
            });
</script>
@stop