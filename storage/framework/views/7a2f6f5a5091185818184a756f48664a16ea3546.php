<?php $__env->startSection('content'); ?>

	<div class="container scooter-show">
		<div class="row" style="padding: 30px 0px">
		<?php if(isset($scooter)): ?>
			<div class="media">
				<div class="media-left media-middle col-xs-12 col-sm-6">
					<?php if(!empty($color)): ?>
						<img class="scooter-img" src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'-'.lcfirst($color).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>">
					<?php else: ?>
						<img class="scooter-img" src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'-'.lcfirst($scooter->color).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>">
					<?php endif; ?>
				</div>
				<div class="col-xs-12 col-sm-6">
					<h2>Informations</h2>
					<ul class="list-unstyled">
						<li>Model : <?php echo e(ucfirst($scooter->model)); ?></li>
						<li>Year : <?php echo e($scooter->year); ?></li>
						<li>Kilometers : <?php echo e($scooter->kilometers); ?>km</li>
						<li>
							<div class="col-xs-2" style="padding: 0">
								Colors : 
							</div>
							<?php $__currentLoopData = $scooter_color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<div class="col-xs-1" style="padding: 0">
								<a href="<?php echo e(url('/scooters/'.str_replace(' ','-',$scooter->model).'/'.lcfirst($color->color))); ?>" title="<?php echo e($color->color); ?>">
									<div style="width: 20px; height: 20px; background-color: <?php echo e($color->color); ?>; border: 2px solid black">
									</div>
								</a>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</li>	
					</ul>
					<h2>Details</h2>
					<p><?php echo e($scooter->info); ?></p>
					<p><a href="<?php echo e(url('/#rent-it')); ?>" class="btn btn-success" role="button">Rent it</a></p>
				</div>
			</div>	
		<?php else: ?>
			<h1>The requested product doesn't exist...</h1>
			<p><a href="<?php echo e(url('/')); ?>">Back to home page</a></p>
		<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>