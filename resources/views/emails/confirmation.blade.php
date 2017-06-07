<!DOCTYPE html>
<html>
<head>
	<title>We Ride - Your rendez-vous confirmation</title>
</head>
<body>
	<h1>Thank you {{ $name }} for renting with We Ride !</h1>
	<p>We receive your demand of having a scooter from {{ date_format(date_create($pickUp), "d/m/Y") }} to {{ date_format(date_create($dropOff), "d/m/Y") }}.</p>
	<p>Please be sure to bring an ID and your driver's licence when you come to pick-up the scooter.</p>
	<p>
		Meet us at this address : 
		<ul>
			<li>360 Botany Road</li>
			<li>Beaconsfield 2015</li>
			<li>NSW, Sydney</li>
		</ul>
		<a href="https://www.google.com.au/maps/place/406+Botany+Rd,+Beaconsfield+NSW+2015/@-33.9103811,151.1998189,17z/data=!3m1!4b1!4m5!3m4!1s0x6b12b1b8fd8629c5:0x7f7a8970806031a3!8m2!3d-33.9103811!4d151.2020076?hl=fr">Get directions with google maps</a>
	</p>
	<p>If you want to cancel your reservation or if there is any issue with your reservation, please contact us at any time at this number 0435820170 or by email at contact@weride.com</p>
</body>
</html>