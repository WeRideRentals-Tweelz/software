<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
		<div style="background-color:rgba(0,0,0, 0.6);width:100%;text-align: center;color: white;position: absolute;left: 0;top: 50px">
			<div class="col-sm-6 col-sm-offset-3">
				<h1>Tweelz</h1>
				<h2>We ride</h2>
			</div>
		</div>
		<?php echo $__env->make('home.landing_page_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="container">
			<div class="row" style="border-bottom: 1px silver solid; padding: 50px 0px">
				<div class="container">
					<h2 style="text-align:center;">Rent your scooter with Tweelz</h2>
					<p style="text-align: center;">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					<div class="row" style="padding: 50px">
						<div class="col-sm-4 col-sm-offset-5">
							<a href="<?php echo e(url('/scooters')); ?>" class="btn btn-primary">Look at the scooters</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="<?php echo e(asset('images/asset1.jpeg')); ?>" style="width: 100%;height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Asset 1</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="<?php echo e(asset('images/asset2.jpeg')); ?>" style="width: 100%;height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Asset 2</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class='thumbnail'>
								<img src="<?php echo e(asset('images/asset3.jpeg')); ?>" style="width: 100%; height: 220px">
								<div class="caption">
									<h3 style="text-align: center">Asset 3</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php echo $__env->make('home.price_display', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<div class="row" style="border-bottom: 1px silver solid; padding: 50px 0px">
				<h2 style="text-align:center;">Book with us</h2>
				<p style="text-align: center;">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<h2 style="text-align:center;">What do you need to rent ?</h2>
				<div class="row">
					<div class="col-sm-4">
						<h3 style="text-align:center;">1</h3> 
						<h4 style="text-align:center;">A valid international driver's licence</h4>
					</div>
					<div class="col-sm-4">
						<h3 style="text-align:center;">2</h3>
						<h4 style="text-align:center;">An Australian 125cc scooter licence</h4>
					</div>
					<div class="col-sm-4">
						<h3 style="text-align:center;">3</h3>
						<h4 style="text-align:center;">Get covered !</h4>
					</div>
				</div>
			</div>

			<div class="row">
				<h2 style="text-align:center;">Contact Us</h2>
				<div class="row" style="padding: 50px">
					<div class="col-sm-6">
						<h3>Address</h3>
						<p><span class="fa fa-map-marker" aria-hidden="true"></span> 406 Botany Rd, Beaconsfield NSW 2015</p>
						<h3>Phone Number</h3>
						<p><span class="fa fa-phone" aria-hidden="true"></span> 0410 125 994</p>
						<h3>Email Address</h3>
						<p><span class="fa fa-envelope" aria-hidden="true"></span> contact@tweelz.com</p>
						<h3>Open Hours</h3>
						<p><span class="fa fa-clock-o" aria-hidden="true"></span> 9am to 1pm</p>
					</div>
					<div class="col-sm-6">
						<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJxSmG_bixEmsRozFggHCJen8&key=AIzaSyA8cF6MhPz1UZPyBe9hiGr7zPdthmAe4E4" allowfullscreen></iframe>
					</div>
				</div>
			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>