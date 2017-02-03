<?php $__env->startSection('content'); ?>
	<div class="container" style="max-height: 670px">
		<h1>Scooters available </h1>
		<h2>From <?php echo e(date_format(date_create($pick_up_date),'l d F Y')); ?> 
		to <?php echo e(date_format(date_create($drop_off_date),'l d F Y')); ?> - $<?php echo e($price); ?>/day</h2>
		<div class="row">
		<?php if(count($available) >= 1): ?>
			<?php $__currentLoopData = $available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scooter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>">
					<div class="caption">
						<h3 style="text-align: center"><?php echo e(ucfirst($scooter->model)); ?></h3>
						<p style="text-align: center"><a href="<?php echo e(url('scooters/'.$scooter->id)); ?>" class="btn btn-info" role="button">More Information</a></p>

						<form action="<?php echo e(url('bookings/confirmation')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="pick_up_date" value="<?php echo e($pick_up_date); ?>">
							<input type="hidden" name="drop_off_date" value="<?php echo e($drop_off_date); ?>">
							<input type="hidden" name="scooter_id" value="<?php echo e($scooter->id); ?>">
							<?php if(null !== Auth::user()): ?>
							<button type="submit" class="btn btn-success" style="margin-left: 75px;">Rent now</button>
							<?php else: ?>
							<a href="<?php echo e(url('/login')); ?>" class="btn btn-warning" role="button" style="margin-left:65px">Login to rent</a>
							<?php endif; ?>
						</form>
					</div>
				</div>				
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		<?php else: ?>
			<h3 style="text-align: center">There is no scooter available for the requested dates</h3>
			<h4 style="text-align: center; margin-top: 50px;margin-bottom: -25px;">Change the dates</h4>
			<?php echo $__env->make('home.date_picker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>