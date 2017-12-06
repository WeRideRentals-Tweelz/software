<!DOCTYPE html>
<html>
<head>
	<title>{{ $name }} signed {{ $documentName }}</title>
</head>
<body>
	<h1>{{ $name }} signed {{ $documentName }}</h1>
	<div>
		@php print($documentContent) @endphp
	</div>
	<br>
	<hr>
	<br>
	<div>
  		<p> 
  			I, {{ $name }} hereby acknowledge the fact that I read and accepted the aggreement between WeRideRentals.pty and I :
  		</p>
  		<p style="text-align: center">
  			 	&#9745; <em>signature</em>
  		</p>
  	</div>
</body>
</html>