<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Drivers waiting for confirmation</h3>
		</div>
		<div class="panel-body">
			<table class="col-xs-12 table table-striped">
				<tr>
					<th>Name</th>
					<th>Familly Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Inscription Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php $__currentLoopData = $new_drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<th><?php echo e($driver->firstname); ?></th>
					<th><?php echo e($driver->surname); ?></th>
					<th>0<?php echo e($driver->phone); ?></th>
					<th><?php echo e($driver->email); ?></th>
					<th><?php echo e(date_format(date_create($driver->created_at),'d F Y')); ?></th>
					<th><a href="<?php echo e(url('/home/drivers/'.$driver->id.'/confirm')); ?>" class="btn btn-warning btn-sm" role="button">Pending</a></th>
					<th><a href="<?php echo e(url('/home/drivers/'.$driver->id)); ?>" class="btn btn-info btn-sm" role="button">Details</a></th>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</table>
		</div>
	</div>
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Confirmed Drivers</h3>
		</div>
		<div class="panel-body">
			<table class="col-xs-12 table table-striped">
				<tr>
					<th>Picture</th>
					<th>Name</th>
					<th>Familly Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Inscription Date</th>
					<th>Actions</th>
				</tr>
				<?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<th><img src="<?php echo e(asset('images/drivers/'.$driver->id.'.jpg')); ?>" style="height:50px;width: 50px"></th>
					<th><?php echo e($driver->firstname); ?></th>
					<th><?php echo e($driver->surname); ?></th>
					<th>0<?php echo e($driver->phone); ?></th>
					<th><?php echo e($driver->email); ?></th>
					<th><?php echo e(date_format(date_create($driver->created_at),'d F Y')); ?></th>
					<th><a href="<?php echo e(url('/home/drivers/'.$driver->id)); ?>" class="btn btn-info btn-sm" role="button">Details</a></th>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>