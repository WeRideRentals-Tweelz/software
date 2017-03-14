<div class="row">
	<div id="desktop-image-cover" class="container-fluid" style="height:100vh">
		<div class="row hidden-xs" style="height: 1900px">
			<img src="{{ asset('images/scooter.jpeg') }}" alt="rent a scooter in sydney">
		</div>
		
		<!-- Facebook like and share buttons -->
		<div id="facebook-buttons">
			<a id="facebook-logo" href="https://www.facebook.com/weriderentals/" target="facebook" title="check facebook page"><span class="fa fa-facebook fa-2x"></span></a>
			<div id="like-share" class="fb-like" data-href="https://www.facebook.com/weriderentals/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true" ></div>
		</div>
		<!-- End of Facebook buttons -->

		<div id="rent-it"> 
				<form id="mobile-form" class="form-inline hidden-sm hidden-md hidden-lg" action="/rent-a-scooter" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="input-container-right col-xs-6">
							<div class="input-container col-xs-12">
								<input type="text" name="firstname" placeholder="Firstame" class="form-control" required>
							</div>
							<div class="input-container col-xs-12">
								<input type="text" name="surname" placeholder="Lastname" class="form-control" required>
							</div>
						</div>
						<div class="input-container-left col-xs-6">
							<div class="input-container col-xs-12">
								<input type="text" name="phone" placeholder="Phone" class="form-control" required>
							</div>
							<div class="input-container col-xs-12">
								<input type="email" name="email" placeholder="Email" class="form-control" required>
							</div>
						</div>
						<div class="date-input col-xs-6 form-group">
							<div class="input-container col-xs-12">
								<label for="pick_up_date">Pick Up Date</label>
								<input id="pick_up_date" type="date" name="pick_up_date" class="form-control" required>
							</div>
						</div>
						<div class="date-input col-xs-6 form-group">
							<div class="input-container col-xs-12">
								<label for="drop_off_date">Drop Off Date</label>
								<input id="drop_off_date" type="date" name="drop_off_date" class="form-control" required>
							</div>
						</div>

					<div class="mobile-button-container col-xs-4 col-xs-offset-5 col-sm-offset-5">
						<button type="submit" class="btn btn-primary rent-scooter">Book Now</button>
					</div>
				</form>
				<form id="desktop-form" class="hidden-xs form-inline" action="/rent-a-scooter" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="text" name="firstname" placeholder="Firstame" class="form-control" required>
					<input type="text" name="surname" placeholder="Lastname" class="form-control" required>
					<input type="text" name="phone" placeholder="Phone" class="form-control" required>
					<input type="email" name="email" placeholder="Email" class="form-control" required>
					<input type="date" name="pick_up_date" class="form-control" required>
					<input type="date" name="drop_off_date" class="form-control" required>
					<div id="form-button-container">
						<button type="submit" onclick=ga(‘send’,’event’,’Button’,’Click’,’NewClient’, '0') class="button-bounce btn btn-primary rent-scooter">Book Now</button>
					</div>
				</form>
		</div>
	</div>
</div>	
