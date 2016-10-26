@extends('layouts.app')

@section('content')
	

	<div class="container">

		<h1>Pick Image Game!</h1>

		@if(Auth()->user()->hasNotPickedImage())

		{!! Form::open(['url'=>'/image/pick', 'method'=>'post'])!!}

		{!! Form::token() !!}
		
		<p>Raad hoe het nieuwe jupiler flesje er uit zal zien !</p>
			
			<div class="row">
				<div class="form-group col-md-4 thumbnail" >
					<img src="/images/medium/1.png" alt="">	
					{!! Form::radio('bottlePick', '1') !!}
				</div>
				<div class="form-group col-md-4 thumbnail">	
					<img src="/images/medium/2.jpg" alt="">	
					{!! Form::radio('bottlePick', '2') !!}				
				</div>
				<div class="form-group col-md-4 thumbnail">
					<img src="/images/medium/3.png" alt="">	
					{!! Form::radio('bottlePick', '3') !!}
				</div>
			</div>
			<hr>

			<div class="row">
				<p><strong>Schiftingsvraag:</strong>  Hoeveel pinten werden er op Rock Werchter Festival gedronken?</p>
				
				<div class="form-group">
					{!! Form::number("tiebreaker","",['class'=>'form-control']) !!}
				</div>

			</div>

			@if(count($errors) > 0)
						<div class="row">
							@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
						</div>
						
			@endif
				
			<div class="form-group">
				{!! Form::submit("verzend",['class'=>'btn btn-primary']) !!}
			</div>

			
	

		{!! Form::close() !!}

		@else
			<p>You antwoord is verstuurd. <strong>Succes !</strong></p>

		@endif
	</div>
	
	
	


@endsection