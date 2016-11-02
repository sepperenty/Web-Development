@extends('layouts.app')

@section('content')
	

	<div class="container">
	<div class="webBlock">

		<h1>Vierde Wedstrijd</h1>
		<p>Deze wedstrijd eindigd op {{$pickImageGame->end}}</p>

		@if(Auth()->user()->hasNotPickedImage())

		{!! Form::open(['url'=>'/image/pick', 'method'=>'post'])!!}

		{!! Form::token() !!}
		
		<p>Raad hoe het nieuwe jupiler flesje er uit zal zien !</p>
			<p>Klik op het juiste flesje!</p>
			<div class="row">
				<div class="form-group col-md-4 frame" >
					<label>
						{!! Form::radio('bottlePick', '1') !!}
						<div class="uploadPicture">
						
							<img src="/images/webImages/1.jpg" alt="">	
						</div>
						
					</label>

				</div>
				<div class="form-group col-md-4 frame">	
					<label>
						{!! Form::radio('bottlePick', '2') !!}
						<div class="uploadPicture">
						
							<img src="/images/webImages/2.png" alt="">	
						</div>
						
					</label>
			
				</div>
				<div class="form-group col-md-4 frame">
					<label>
						{!! Form::radio('bottlePick', '3') !!}
						<div class="uploadPicture">
						
							<img src="/images/webImages/3.png" alt="">	
						</div>
						
					</label>

				</div>
			</div>
			</div>
			<div class="webBlock">

			<div class="row">
				<p><strong>Schiftingsvraag:</strong>  Hoeveel pinten werden er op Rock Werchter Festival gedronken?</p>
				
				<div class="form-group">
					{!! Form::number("tiebreaker",0,['class'=>'inputField']) !!}
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
				{!! Form::submit("verzend",['id'=>'webButton']) !!}
			</div>

			
	

		{!! Form::close() !!}

		@else
			<p>You antwoord is verstuurd. <strong>Succes: {{Auth()->user()->name}}</strong></p>


		@endif
		</div>
	</div>
	
	
	


@endsection