<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row" style="padding: 30px 0px">
		<?php if(isset($scooter)): ?>
			<div class="media">
				<div class="media-left media-middle">
					<img style="height: 400px; width: 600px;" src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>">
				</div>
				<div class="media-body">
					<h2>Informations</h2>
					<ul class="list-unstyled">
						<li><b>Model</b> : <?php echo e(ucfirst($scooter->model)); ?></li>
						<li><b>Year</b> : <?php echo e($scooter->year); ?></li>
						<li><b>Kilometers</b> : <?php echo e($scooter->kilometers); ?>km</li>
						<li><b>Colors</b> : <?php echo e($scooter->color); ?></li>
					</ul>
					<h2>Details</h2>
					<p><?php echo e($scooter->info); ?></p>
					<p><a href="" class="btn btn-success" role="button">Rent Now</a></p>
				</div>
			</div>	
		<?php else: ?>
			<h1>The requested product doesn't exist...</h1>
			<p><a href="">Back to home page</a></p>
		<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>