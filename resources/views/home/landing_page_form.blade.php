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
			<div id="desktop-form" class="col-xs-12 col-sm-4 col-sm-offset-2">
				<form class="form" action="/quote" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div id="form-input-group">
						<input type="text" name="firstname" placeholder="Name" class="form-control" required>
						<input type="text" name="phone" placeholder="Phone" class="form-control" required>
						<input type="email" name="email" placeholder="Email" class="form-control" required>
						<input type="date" name="pickUp" class='form-control' required>
						<input type="date" name="dropOff" class="form-control" required>
						<div id="form-button-container">
							<button type="submit" onclick=ga(‘send’,’event’,’Button’,’Click’,’NewClient’, '0') class="button-bounce btn btn-primary rent-scooter">Book Now</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	
