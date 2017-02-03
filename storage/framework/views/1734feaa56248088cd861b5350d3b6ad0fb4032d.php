<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Scooter informations</h1>
		</div>
		<div class="panel-body">
			<form action="<?php echo e(url('/home/scooters/'.$scooter->id.'/update')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

				<div class="col-sm-4">
					<img src="<?php echo e(asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg')); ?>" alt="<?php echo e('scooter '.$scooter->model.' of '.$scooter->year); ?>" style="max-height: 150px;">
					<input class="form-control" type="file" name="scooter-picture">
				</div>

				<div class="col-sm-2">
					
					<div class="form-group">
						<label for="model">Model</label>
						<input class="form-control" type="text" name="model" value="<?php echo e($scooter->model); ?>">	
					</div>

					<div class="form-group">
						<label for="availability">Status</label>
						<?php if($scooter->availability == 1): ?>
						<br>
						<span class="btn btn-success btn-sm">In Store</span>
						<?php elseif($scooter->availability == 2): ?>
						<br>
						<span class="btn btn-danger btn-sm">Garage</span>
						<?php endif; ?>
						<input class="form-control" type="number" name="availability" value="<?php echo e($scooter->availability); ?>">
					</div>

					<div class="form-group">
						<label for="color">Color</label>
						<input class="form-control" type="text" name="color" value="<?php echo e($scooter->color); ?>">
					</div>

					<div class="form-group">
						<label for="state">State</label>
						<input class="form-control" type="text" name="state" value="<?php echo e($scooter->state); ?>">
					</div>

					<div class="form-group">
						<label for="plate">Plate</label>
						<input class="form-control" type="text" name="plate" value="<?php echo e($scooter->plate); ?>">
					</div>
					
					<div class="form-group">
						<label for="year">Year</label>
						<input class="form-control" type="number" name="year" value="<?php echo e($scooter->year); ?>">
					</div>

					<div class="form-group">
						<label for="category">Category</label>
						<input class="form-control" type="text" name="category" value="<?php echo e($scooter->category); ?>">
					</div>

					<div class="form-group">
						<label for="kilometers">Kilometers</label>
						<input class="form-control" type="text" name="kilometers" value="<?php echo e($scooter->kilometers); ?>">
					</div>

					<div class="form-group">
						<label for="last_check">Last Check</label>
						<input class="form-control" type="date" name="last_check" value="<?php echo e($scooter->last_check); ?>">
					</div>

					<div class="form-group">
						<label for="info">Info</label>
						<textarea class="form-control" name="info"><?php echo e($scooter->info); ?></textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm">Update</button>
					</div>

				</div>

			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>