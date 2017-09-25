@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Users</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Surname</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->surname }}</td>
								<td><a href="{{ url('/profile/'.$user->id) }}" class="btn btn-info btn-sm">Profile</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<a href="{{ url('/users/create') }}" class="btn btn-primary">Create user</a>
		</div>
	</div>
</div>

@stop