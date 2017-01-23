<!DOCTYPE html>
<html>
<head>
	<title>New Scooter Booking</title>
</head>
<body>
	<h1>You received a new booking from Tweelz.com</h1>
	<ul>
		<li>Scooter desired : {{ $scooter->model - $scooter->plaque - $scooter->year }}</li>
		<li>Pick-up date : {{ $pick_up_date }}</li>
		<li>Drop-off date : {{ $drop_off_date }}</li>
	</ul>
</body>
</html>