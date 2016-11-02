@extends('layouts.app')

@section('content')
	

	<div class="container">
			
		

			<div class="row webBlock">
	<h1>Admin Page</h1>

			<table class="table">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Wedstrijd 1</th>
					<th>Wedstrijd 2</th>
					<th>Stemmen Wedstrijd 2</th>
					<th>Wedstrijd 3</th>
					<th>Wedstrijd 4</th>
					<th>Wedstrijd 4 schifting</th>
					<th>Delete</th>
				</tr>
				@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td> 
					<td>{{$user->first_period_answer->answer or ""}}</td>
					<td><img src="/images/small/{{$user->second_period_answer->picture or 'default.jpg'}}" alt=""></td>
					<td>{{$user->second_period_answer->votes or ""}}</td>
					<td>{{$user->third_period_answer->answer or ""}}</td>
					<td>{{$user->fourth_period_answer->answer or ""}}</td>
					<td>{{$user->fourth_period_answer->tiebreaker or ""}}</td>
					<td><a href="/{{$user->id}}/delete" id="webButton">delete</a></td>
				</tr>

				@endforeach

				

			</table>
			{{$users->links()}}
			</div>


	</div>
	

@endsection