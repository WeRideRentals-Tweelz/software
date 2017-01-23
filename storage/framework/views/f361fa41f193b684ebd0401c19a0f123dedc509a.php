<?php $__env->startSection('content'); ?>
	<div class="container" style="min-height: 670px;">
		<h1 style="text-align: center;">Our Scooters</h1>
		<div class="row">
			<?php $__currentLoopData = $scooters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scooter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>" style="max-height: 150px;">
					<div class="caption">
						<h3 style="text-align: center"><?php echo e(ucfirst($scooter->model)); ?></h3>
						<p style="text-align: center"><a href="<?php echo e(url('scooters/'.$scooter->id)); ?>" class="btn btn-info" role="button">More Information</a></p>
					</div>
				</div>				
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>