

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>



		
		
		@if(count($winners)>0)

		<h1> Er is een nieuwe winnaar !  </h1>

		<h4>Wedstrijd : {{$period}}</h4>

		<p><strong>Gegevens: </strong></p>

			@foreach($winners as $winner)

				<p>{{$winner->user->name}}</p>
				<p>{{$winner->user->email}}</p>

			@endforeach

		@else
		
		<h1>Periode is afgelopen, er is geen winnaar.</h1>

		<h4>Wedstrijd : {{$period}}</h4>
		
		<p>Niemand heeft een juist antwoord gegeven.</p>

		@endif
</body>
</html>