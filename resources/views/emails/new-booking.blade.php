<!DOCTYPE html>
<html>
<head>
	<title>WeRide : New Scooter Booking</title>
</head>
<body>
	<h1>{{ $lastname }} {{ $surname }} wish to book a scooter !</h1>
	<br>
	<h2>Booking Info</h2>
	<ul>
		<li>Pick-up date : {{ date('l d F Y', strtotime($pick_up_date)) }}</li>
		<li>Drop-off date : {{ date('l d F Y', strtotime($drop_off_date)) }}</li>
	</ul>
	<h2>Personnal Info</h2>
	<ul>
		<li>Name : {{ $lastname }} {{ $surname }}</li>
		<li>Phone : {{ $phone }}</li>
		<li>Email : {{ $email }}</li>
	</ul>
</body>
</html>