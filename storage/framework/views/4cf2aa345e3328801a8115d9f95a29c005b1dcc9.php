<!DOCTYPE html>
<html>
<head>
	<title>WeRide : New Scooter Booking</title>
</head>
<body>
	<h1><?php echo e($lastname); ?> <?php echo e($surname); ?> wish to book a scooter</h1>
	<h2>Booking Info</h2>
	<ul>
		<li>Pick-up date : <?php echo e($pick_up_date); ?></li>
		<li>Drop-off date : <?php echo e($drop_off_date); ?></li>
	</ul>
	<h2>Personnal Info</h2>
	<ul>
		<li>Phone : <?php echo e($phone); ?></li>
		<li>Email : <?php echo e($email); ?></li>
	</ul>
</body>
</html>