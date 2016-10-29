@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      	
      	<div class="webBlock">
                    
	        <h1>Jupiler wedstrijd</h1>

	        <p>Deze maand wordt er elke week een andere wedstrijd geopend met kans op een koelkast vol met je favoriete bier!</p>

	        <p>Klik hier en ondek aan welke wedstrijd je kan deelemen.</p>

	        
	        <a href="/game" id="webButton">NEEM DEEL</a>
	        
        </div>

    </div>

    <div class="row webBlock">
    	
		@if(count($winners1)>0)
			
				<h4>Winnaar(s) eerste periode is bekend.</h4>
				@foreach($winners1 as $winner)
				<p><strong>Proficiat</strong> :  {{$winner->user->name}}</p>
				@endforeach
			
				<hr>

		@endif
		
		@if(count($winners2)>0)
			
			<h4>Winnaar(s) tweede periode is bekend.</h4>
				@foreach($winners2 as $winner)
				<p><strong>Proficiat</strong> :  {{$winner->user->name}}</p>
				<p>Met foto : </p>
				<img src="/images/medium/{{$winner->picture}}.jpg" alt="" id="winPicture">
				@endforeach
				<hr>	
			

		@endif


		@if(count($winners3)>0)
			
			<h4>Winnaar(s) derde periode is bekend.</h4>
				@foreach($winners3 as $winner)
				<p><strong>Proficiat</strong> :  {{$winner->user->name}}</p>
				@endforeach
				<hr>
		@endif	
		

		@if(count($winners4)>0)
			
			<h4>Winnaar(s) vierde periode is bekend.</h4>
				@foreach($winners4 as $winner)
				<p><strong>Proficiat</strong> :  {{$winner->user->name}}</p>
				@endforeach
				<hr>
		@endif	

		@if( (count($winners1) == 0) && (count($winners2) == 0) && (count($winners3) == 0) && (count($winners4) == 0)) 
			
			<h4>De eerste wedstrijd is volop bezig!</h4>
				<p>Het is niet moeilijk. Registreer en maak kans op deze koelkast!</p>
				<img src="images/webImages/koelkast.jpg" alt="" id="koelkast">
			<hr>

		@endif


    </div>


</div>
@endsection
