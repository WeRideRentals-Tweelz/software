<?php $__env->startSection('content'); ?>
	<div class="container" style="min-height: 670px">
		<div class="row" style="margin-bottom:50px;padding-left: 15px;padding-right: 15px;">
			<a href="">
				<div class="col-sm-6" style="box-shadow: 2px 2px 2px 2px gray;text-align: center; padding: 20px 0px;">
					<h3>Bookings</h3>
					<span class="fa fa-book fa-5x"></span>
				</div>
			</a>
			<a href="">
				<div class="col-sm-6" style="box-shadow: 2px 2px 2px 2px gray;text-align: center;padding: 20px 0px;">
					<h3>Drivers</h3>
					<span class="fa fa-user fa-5x"></span>
				</div>
			</a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Scooters Today Status</h2>
			</div>
			<div class="panel-body">
				<table class="col-xs-12 table table-hover">
					<tr style="text-align: center">
						<th>Image</th>
						<th>Model</th>
						<th>Plate</th>
						<th>Km</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php $__currentLoopData = $scooters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scooter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td><img style="height: 40px; width: 60px;" src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>"></td>
						<td><?php echo e($scooter->model); ?></td>
						<td><?php echo e($scooter->state); ?> - <?php echo e($scooter->plate); ?></td>
						<td><?php echo e($scooter->kilometers); ?> km</td>
						<td>
						<?php $__currentLoopData = $available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scooter_available): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if($scooter->id != $scooter_available->id): ?>
								<a href="" class="btn btn-info btn-sm" role="button">Rented</a>
							<?php else: ?>
								<?php if($scooter->availability == 1): ?>
									<a href="/scooter/<?php echo e($scooter->id); ?>/garage" class="btn btn-success btn-sm" role="button">In Store</a>	
								<?php elseif($scooter->availability == 2): ?>
									<a href="/scooter/<?php echo e($scooter->id); ?>/in-store" class="btn btn-danger btn-sm" role="button">Garage</a>
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td>
							<a style="margin-left: 20px" href="/scooters/<?php echo e($scooter->id); ?>/update" class="btn btn-info btn-sm" role="button">More Details</a>
							<a href="/scooters/<?php echo e($scooter->id); ?>/delete" class="btn btn-danger btn-sm" role="button">Delete</a>
						</td>
					</tr>				
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>