<!DOCTYPE html>
<html>
<head>
	<title>New Scooter Booking</title>
</head>
<body>
	<h1>{{ $name }} wish to book a scooter !</h1>
	<br>
	<h2>Booking Info</h2>
	<ul>
		<li>Pick Up date : {{ $pickUp }}</li>
		<li>Drop Off date : {{ $dropOff }}</li>
	</ul>
	<h2>Personnal Info</h2>
	<ul>
		<li>Name : {{ $name }}</li>
		<li>Phone : {{ $phone }}</li>
		<li>Email : {{ $email }}</li>
	</ul>
</body>
</html>