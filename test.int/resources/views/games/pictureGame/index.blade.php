@extends('layouts.app')

@section('content')

	<div class="container">
				
		

	  <div class="row webBlock">

	 <h1> Foto Spel </h1>
	
	@if(Auth()->user()->hasNoUpload())
	
	<p>Upload je favoriete jupiler gerelateerde foto en maak kans op een koelkast vol Jupiler! </p>
	
	{!! Form::open(['url' => 'pictures/add', 'files' => true, 'method'=>'post']) !!}
		
		<div class="form-group">
			<div class="fileUpload">
				<p>Kies Foto</p>
				{!! Form::file("picture", ['id'=>'uploadBtn', 'class'=>'upload']) !!}
			</div>

			<input id="uploadFile" placeholder="0 files selected" disabled="disabled" />
			

			@if(count($errors) > 0)
						
						@foreach($errors->all() as $error)
								<p class="alert alert-danger">
									{{$error}}
								</p>
						@endforeach
			@endif
			
		</div>

		<div class="form-group">
			{!! Form::submit("VERSTUUR FOTO", ['id'=>'webButton']) !!}
		</div>

	{!! Form::close() !!}
	
	@else
	
		<p>Succes met je deelname ! Geef een Vote aan je favoriete foto, let op je kan maar 1 keer voten!</p>

	@endif

	

	@if(!Auth()->user()->hasNotVoted())
	
	<p> Je stem is Binnen gebracht. Succes !</p>

	@endif

	</div>
	
	
	
		@foreach($pictures as $contribution)
			
			<div class="uploadPicture" style="height:250px">
				<img src="/images/medium/{{$contribution->picture}}.jpg" alt="" style="margin-top:auto, margin-bottom:auto">
				<p>{{$contribution->votes}}</p>
				@if(Auth()->user()->hasNotVoted())
				<a href="/vote/{{$contribution->id}}" class="badge">VOTE</a>
				@endif
			</div>
			

		@endforeach

	
	
	</div>


@endsection