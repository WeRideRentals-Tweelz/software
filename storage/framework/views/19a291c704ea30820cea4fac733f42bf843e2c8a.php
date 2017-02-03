<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-sm-5 col-sm-offset-1">
		<h1>Tweelz Driver's Profile</h1>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Details</h2>
			</div>
			<div class="panel-body">
				<form action="<?php echo e(url('/home/drivers/'.$driver->id.'/update')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

					<div class="col-sm-3">
							<img src="<?php echo e(asset('images/drivers/'.$driver->id.'.jpg')); ?>" style="box-shadow: 2px 2px 2px 2px silver; width: 175px;height: 250px;">	
					</div>
					<div class="col-sm-9">
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="firstname">Firstname</label>
								<input type="text" name="firstname" id="firstname" value="<?php echo e($driver->firstname); ?>" class="form-control">
							</div>
							<div class="form-group col-sm-4">
								<label for="surname">Surname</label>
								<input type="text" name="surname" id="surname" value="<?php echo e($driver->surname); ?>" class="form-control">
							</div>
							<div class="col-sm-4">
								<label for="status">Status</label>
								<br>
								<?php if($driver->confirmed == 0): ?>
									<a href="<?php echo e(url('/home/drivers/'.$driver->id.'/confirm')); ?>" class="btn btn-warning btn-sm">Pending</a>
								<?php elseif($driver->confirmed == 1): ?>
									<a href="<?php echo e(url('/home/drivers/'.$driver->id.'/confirm')); ?>" class="btn btn-success btn-sm">Confirmed</a>
								<?php else: ?>
									<a href="<?php echo e(url('/home/drivers/'.$driver->id.'/confirm')); ?>" class="btn btn-danger btn-sm">Banned</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="<?php echo e($driver->email); ?>" class="form-control">
							</div>
							<div class="form-group col-sm-4">
								<label for="phone">Phone</label>
								<input type="phone" name="phone" id="phone" value="0<?php echo e($driver->phone); ?>" class="form-control">
							</div>
						</div>
						<div class="row col-sm-2" style="margin-top: 70px">
							<button role="submit" class="btn btn-primary btn-sm">Update</button>
						</div>	
					</div>			
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Documents</h2>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="panel panel-default" style="margin-top: 70px;">
			<div class="panel-heading">
				<h2>History</h2>
			</div>
			<div class="panel-body">
				<table class="table table-stripped">
					<tr>
						<th>Booking N°</th>
						<th>State</th>
						<th>Pick-up</th>
						<th>Drop off</th>
						<th>Scooter Model</th>
					</tr>
					<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<th><?php echo e($booking->id); ?></th>
						<th><?php echo e($booking->state); ?></th>
						<th><?php echo e(date_format(date_create($booking->pick_up_date),'d F Y')); ?></th>
						<th><?php echo e(date_format(date_create($booking->drop_off_date),'d F Y')); ?></th>
						<th><?php echo e($booking->model); ?></th>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</table>
			</div>
			<div class="panel-footer">
				<p><b>Favorite Scooter :</b> <?php echo e(ucfirst($favorite_scooter->model)); ?></p>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>