@extends('layouts.app')

@section('content')


		<div class="container">
		 <div class="row webBlock">

			<h1>Derde Wedstrijd</h1>

			@if(Auth()->user()->hasNotSubmittedCode())
				<p>Vul hier de code in die zich om de onderkant van een jupiler flesje bevind.</p>
				<p>Deze wedstrijd eindigt op {{$codeGame->end}}</p>
				<p>Let op, niet elk Jupiler flesje heeft een code.</p>
				<p>Maak kans op een koelkast vol Jupiler!</p>
			
				{!! Form::open(['url'=>'/code/add', 'method'=>'post']) !!}
					
					{!! Form::token() !!}

					<div class="form-group">
					{!! Form::label('code', "Je code"); !!}
					
					{!! Form:: text('code',"",['class'=>'inputField']); !!}
					@if(count($errors) > 0)
						
						@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
					@endif

					</div>
		
					<div class="form-group">
						{!! Form::submit('Verzend Code',['id'=>'webButton'])!!}
					</div>			



				{!! Form::close() !!}

			@else

				<p>Jou code is verzonden !</p>
				<p>Deze wedstrijd eindigt op {{$codeGame->end}}</p>
				<p>Veel succes {{Auth()->user()->name}}</p>

			@endif

			</div>
			
		</div>
	


@endsection