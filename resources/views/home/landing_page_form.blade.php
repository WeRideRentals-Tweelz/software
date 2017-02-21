<div class="row">
	<div class="container-fluid" style="height:100vh">
		<div class="row hidden-xs" style="height: 1900px">
			<img src="{{ asset('images/scooter.jpeg') }}" alt="rent a scooter in sydney" style="max-height: 1200px;height:100vh;min-height:900px;width: 100%;margin-top: -200px">
		</div>
		<div id="rent-it" style="position: absolute;bottom: 0px; left:0;background-color: #424242; width: 100%;padding: 30px 0px;box-shadow: 0px -2px 20px 0px black"> 
			<div class="container">
				<form class="form-inline" action="/rent-a-scooter" method="POST">
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
						<button type="submit" class="btn btn-primary rent-scooter">Ask for a meeting to rent a scooter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
