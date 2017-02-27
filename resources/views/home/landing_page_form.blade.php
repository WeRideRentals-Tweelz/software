<div class="row">
	<div class="container-fluid" style="height:100vh">
		<div class="row hidden-xs" style="height: 1900px">
			<img src="{{ asset('images/scooter.jpeg') }}" alt="rent a scooter in sydney" style="max-height: 1200px;height:100vh;min-height:900px;width: 100%;margin-top: -200px">
		</div>
		
		<!-- Facebook like and share buttons -->
		<div class="fb-like" data-href="https://www.facebook.com/weriderentals/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true" style="position: absolute;top: 50px;background-color: #424242;right: 0px;padding: 20px;border-radius: 0px 0px 0px 10px;"></div>
		<!-- End of Facebook buttons -->

		<div id="rent-it" style="position: absolute;bottom: 0px; left:0;background-color: #424242; width: 100%;padding: 30px 0px;box-shadow: 0px -2px 20px 0px black"> 
			<div class="container">
				<form class="form-inline hidden-sm hidden-md hidden-lg" action="/rent-a-scooter" method="POST">
					<div class="row">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-xs-6" style="padding-right: 0;">
							<input type="text" name="firstname" placeholder="Name" class="form-control" required>
							<input type="text" name="surname" placeholder="Familly Name" class="form-control" required>
						</div>
						<div class="col-xs-6" style="padding-left: 0;">
							<input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
							<input type="email" name="email" placeholder="Email address" class="form-control" required>
						</div>
						<div class="col-xs-6 form-group" style="margin-top: 10px">
							<label for="pick_up_date" style="color: white;">Pick Up Date</label>
							<input id="pick_up_date" type="date" name="pick_up_date" class="form-control" required>
						</div>
						<div class="col-xs-6 form-group" style="margin-top: 10px">
							<label for="drop_off_date" style="color: white;">Drop Off Date</label>
							<input id="drop_off_date" type="date" name="drop_off_date" class="form-control" required>
						</div>
					</div>

					<div class="col-xs-4 col-xs-offset-2 col-sm-offset-5" style="margin-top: 25px">
						<button type="submit" class="btn btn-primary rent-scooter">Ask for a meeting to rent a scooter</button>
					</div>
				</form>
				<form class="hidden-xs form-inline" action="/rent-a-scooter" method="POST">
					<div class="row">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="firstname" placeholder="Name" class="form-control" required>
						<input type="text" name="surname" placeholder="Familly Name" class="form-control" required>
						<input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
						<input type="email" name="email" placeholder="Email address" class="form-control" required>
						<input type="date" name="pick_up_date" class="form-control" required>
						<input type="date" name="drop_off_date" class="form-control" required>
					</div>
					<div class="col-xs-4 col-xs-offset-2 col-sm-offset-5" style="margin-top: 25px">
						<button type="submit" ga(‘send’,’event’,’Button’,’Click’,’NewClient’, opt_value) class="btn btn-primary rent-scooter">Ask for a meeting to rent a scooter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
