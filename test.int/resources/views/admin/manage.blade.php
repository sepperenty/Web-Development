@extends('layouts.app')

@section('content')
	

	<div class="container">
			
			<h1>Admin Page</h1>

			<div class="row">

			<table class="table">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Antwoord periode 1</th>
					<th>Antwoord periode 2</th>
					<th>Votes periode 2</th>
					<th>Antwoord periode 3</th>
					<th>Antwoord periode 4</th>
					<th>Schifting periode 4</th>
					<th>Delete</th>
				</tr>
				@foreach($users as $user)
				<tr>
					<th>{{$user->name}}</th>
					<th>{{$user->email}}</th> 
					<th>{{$user->first_period_answer->answer or ""}}</th>
					<th><img src="/images/small/{{$user->second_period_answer->picture or 'default'}}.jpg" alt=""></th>
					<th>{{$user->second_period_answer->votes or ""}}</th>
					<th>{{$user->third_period_answer->answer or ""}}</th>
					<th>{{$user->fourth_period_answer->answer or ""}}</th>
					<th>{{$user->fourth_period_answer->tiebreaker or ""}}</th>
					<th><a href="/{{$user->id}}/delete">delete</a></th>
				</tr>

				@endforeach

				

			</table>
			{{$users->links()}}
			</div>


	</div>
	

@endsection