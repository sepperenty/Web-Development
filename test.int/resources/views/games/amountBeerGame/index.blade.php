@extends('layouts.app')

@section('content')


	<div class="container">

	<h1>Beer Game!</h1>
	<p>Raad hoeveel bier Jupiler brouwd per dag !</p>
	<p>Ja kan 1 keer raden.</p>
	
	<hr>
	
		
		

	
	@if(Auth()->user()->hasNoBeerAnswer())

			{!! Form::open(['url' => 'beer/add', 'method'=> 'post' ]) !!}
		    	
				{!! Form::token(); !!}
			
				<div class="form-group">
					
					{!! Form::label('answer', "Je Antwoord"); !!}
					{!! Form:: number('answer',0,['class'=>'form-control']); !!}

					@if(count($errors) > 0)
						
						@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
					@endif

				</div>
				
				<div class="form-group">
					<button class="btn btn-primary">
						submit je antwoord
					</button>
				</div>

			{!! Form::close() !!}

	</div>

	@endif

	

@endsection