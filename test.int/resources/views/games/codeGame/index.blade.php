@extends('layouts.app')

@section('content')


		<div class="container">

			<h1>Code Game!</h1>

			@if(Auth()->user()->hasNotSubmittedCode())

			
				{!! Form::open(['url'=>'/code/add', 'method'=>'post']) !!}
					
					{!! Form::token() !!}

					<div class="form-group">
					{!! Form::label('code', "Je code"); !!}
					
					{!! Form:: text('code',"",['class'=>'form-control']); !!}

					</div>
		
					<div class="form-group">
						{!! Form::submit('Verzend Code',['class'=>'btn btn-primary'])!!}
					</div>			



				{!! Form::close() !!}

			@else

				<p>Jou code is gesubmit !</p>

			@endif

			
			
		</div>
	


@endsection