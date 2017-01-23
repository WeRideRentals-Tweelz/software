<?php $__env->startSection('content'); ?>
	<div class="container" style="min-height: 670px">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Bookings</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-striped">
					<tr>
						<th>Booking number</th>
						<th>Pick-up date</th>
						<th>Drop-off date</th>
						<th>Scooter</th>
						<th>Plate</th>
						<th>Color</th>
						<th>Confirmed ?</th>
					</tr>
					<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td><?php echo e($booking->id); ?></td>
						<td><?php echo e(date_format(date_create($booking->pick_up_date),'F d M Y')); ?></td>
						<td><?php echo e(date_format(date_create($booking->drop_off_date),'F d M Y')); ?></td>
						<td><?php echo e($booking->model); ?></td>
						<td><?php echo e($booking->plate); ?></td>
						<td><?php echo e($booking->color); ?></td>
						<td></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</table>
			</div>
		</div>
		<div class="panel-default">
			<div class="panel-heading">
				<h2>Scooters</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-hover">
					<tr style="text-align: center">
						<th>Image</th>
						<th>Model</th>
						<th>Plate</th>
						<th>Year</th>
						<th>Color</th>
						<th>Km</th>
						<th>Last Check</th>
						<th>Available</th>
						<th>Details</th>
						<th colspan="2">Action</th>
					</tr>
					<?php $__currentLoopData = $scooters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scooter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td><img style="height: 40px; widtd: 60px;" src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>"></td>
						<td><?php echo e($scooter->model); ?></td>
						<td><?php echo e($scooter->state); ?> - <?php echo e($scooter->plate); ?></td>
						<td><?php echo e($scooter->year); ?></td>
						<td><?php echo e($scooter->color); ?></td>
						<td><?php echo e($scooter->kilometers); ?> km</td>
						<td><?php echo e(date_format(date_create($scooter->last_check),'l d F Y')); ?></td>
						<td>
							<a href="" class="btn btn-success btn-sm" role="button">Rent</a>
						</td>
						<td style="width: 200px; text-align: justify;"><?php echo e($scooter->info); ?></td>
						<td>
							<a style="margin-left: 20px" href="" class="btn btn-info btn-sm" role="button">Update</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" role="button">Delete</a>
						</td>
					</tr>				
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</table>
				<a style="margin-top: 100px" href="" class="btn btn-primary" role="button"><span class="fa fa-plus"> Add a scooter</span></a>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>