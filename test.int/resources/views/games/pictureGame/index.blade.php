@extends('layouts.app')

@section('content')

	<div class="container">
			
		<h1>Picture Game!</h1>
	
		

	
	
	@if(Auth()->user()->hasNoUpload())
	
	<p>Upload je favoriete foto en maak kans op een koelkast vol Jupiler !</p>
	
	{!! Form::open(['url' => 'pictures/add', 'files' => true, 'method'=>'post']) !!}
		
		<div class="form-group">
			{!! Form::label('picture', 'Upload  a picture') !!}
			{!! Form::file("picture", ['class'=>'form-control']) !!}

			@if(count($errors) > 0)
						
						@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
			@endif
			
		</div>

		<div class="form-group">
			{!! Form::submit("Upload", ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	
	@else
	
		<p>Succes met je deelname ! Geef een Vote aan je favoriete foto, let op je kan maar 1 keer voten!</p>

	@endif

	

	@if(!Auth()->user()->hasNotVoted())
	
	<p> Je stem is Binnen gebracht. Succes !</p>

	@endif

	<hr>
	
	
	
		@foreach($pictures as $contribution)
			
			<div class="thumbnail col-md-3" style="height:250px">
				<img src="/images/medium/{{$contribution->picture}}.jpg" alt="" style="margin-top:auto, margin-bottom:auto">
				<p>{{$contribution->votes}}</p>
				@if(Auth()->user()->hasNotVoted())
				<a href="/vote/{{$contribution->id}}" class="badge">VOTE</a>
				@endif
			</div>
			

		@endforeach

	
	
	</div>


@endsection