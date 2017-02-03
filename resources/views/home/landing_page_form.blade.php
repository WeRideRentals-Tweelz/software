<div class="row">
	<div class="container-fluid" style="height:100vh">
		<div class="row" style="height: 1900px">
			<img src="{{ asset('images/scooter.jpeg') }}" style="height: 900px;width: 100%;margin-top: -200px">
		</div>
		<div style="position: absolute;bottom: 0px; left:0;background-color: #eee; width: 99.2vw;padding: 30px 0px;box-shadow: 0px -2px 20px 0px black"> 
			<div class="container">
				<form class="form-inline">
					<div class="row">
						<input type="text" name="firstname" placeholder="Name" class="form-control">
						<input type="text" name="surname" placeholder="Familly Name" class="form-control">
						<input type="phone" name="phone" placeholder="Phone Number" class="form-control">
						<input type="email" name="email" placeholder="Email address" class="form-control">
						<input type="date" name="pick_up_date" placeholder="Pick Up Date" class="form-control">
						<input type="date" name="drop_off_date" placeholder="Drop Off Date" class="form-control">
					</div>
					<div class="col-sm-4 col-sm-offset-5" style="margin-top: 25px">
						<button type="submit" class="btn btn-primary">I wish to rent a scooter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
