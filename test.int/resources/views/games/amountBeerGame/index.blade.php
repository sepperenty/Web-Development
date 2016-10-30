@extends('layouts.app')

@section('content')


	<div class="container">

	 <div class="row webBlock">

		
		
			
		
<h1>Eerste wedstrijd</h1>
	
	@if(Auth()->user()->hasNoBeerAnswer())
			
		
		<p>Raad hoeveel liter bier Jupiler brouwd per dag.</p>
		<p>Wie het dichtste bij is wint!</p>
		<p>Ja kan 1 keer raden.</p>

			{!! Form::open(['url' => 'beer/add', 'method'=> 'post' ]) !!}
		    	
				{!! Form::token(); !!}
			
				<div class="form-group">
					
					{!! Form::label('answer', "Je Antwoord:"); !!}
					{!! Form:: number('answer',0,['class'=>'inputField']); !!}

					@if(count($errors) > 0)
						
						@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
					@endif

				</div>
				
				<div class="form-group">
					<button id="webButton">
						submit je antwoord
					</button>
				</div>

			{!! Form::close() !!}

	@else



		<p>Je deelname is verstuurd.</p>
		<p>Veel succes {{Auth()->user()->name}}</p>
		


	@endif

	</div>
	</div>
	

@endsection