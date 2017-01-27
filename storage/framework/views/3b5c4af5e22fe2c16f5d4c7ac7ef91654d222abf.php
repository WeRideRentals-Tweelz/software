<?php $__env->startSection('content'); ?>
<div class="container">
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
					<th>Driver</th>
					<th>Driver's phone</th>
					<th>Scooter</th>
					<th>Plate</th>
					<th>Color</th>
					<th>Accessories</th>
					<th>Status</th>
				</tr>
				<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<td><?php echo e($booking->id); ?></td>
					<td><?php echo e(date_format(date_create($booking->pick_up_date),'F d M Y')); ?></td>
					<td><?php echo e(date_format(date_create($booking->drop_off_date),'F d M Y')); ?></td>
					<td><a href="<?php echo e(url('/home/drivers/'.$booking->driver_id)); ?>"><?php echo e($booking->firstname); ?> <?php echo e($booking->surname); ?></a></td>
					<td>0<?php echo e($booking->phone); ?></td>
					<td><?php echo e($booking->model); ?></td>
					<td><?php echo e($booking->plate); ?></td>
					<td><?php echo e($booking->color); ?></td>
					<td><?php echo e($booking->accessory_name); ?></td>
					<td><?php echo e($booking->status); ?></td>
					<td></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>