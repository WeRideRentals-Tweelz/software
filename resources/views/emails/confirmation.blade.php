<!DOCTYPE html>
<html>
<head>
	<title>WeRide Rental - Your booking request</title>
</head>
<body>
	<h1>Thank you {{ $name }} for your booking request with WeRide !</h1>
	<p>We received your demand of having a scooter from {{ date_format(date_create($pickUp), "d/m/Y") }} to {{ date_format(date_create($dropOff), "d/m/Y") }}.</p>
	<p>We will contact you within 24 hours by email to confirm your booking.</p>
	<p>Please be sure to bring a valid ID and your driver's licence (learner licence not accepted) when you come to pick-up the scooter.</p>
	<p>
		Meet us at this address : 
		<ul>
			<li>406 Botany Road</li>
			<li>Beaconsfield 2015</li>
			<li>NSW, Sydney</li>
		</ul>
		<a href="https://www.google.com.au/maps/place/406+Botany+Rd,+Beaconsfield+NSW+2015/@-33.9103811,151.1998189,17z/data=!3m1!4b1!4m5!3m4!1s0x6b12b1b8fd8629c5:0x7f7a8970806031a3!8m2!3d-33.9103811!4d151.2020076?hl=fr">Get directions with google maps</a></p>
		
	<p>if you encounter a problem with your reservation, wish to modify or cancel it, please contact us between 9:00 am and 6:00 pm at this number +61 412 140 826 or by email at contact@weriderentals.com.</p>
	<p>This email is an automatic response, not a confirmation of your booking.</p>
</body>
</html>
