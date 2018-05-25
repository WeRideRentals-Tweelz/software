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
					<thead class="fixed">
						<tr>
							<th>Name</th>
							<th>Surname</th>
							<th>Phone Number</th>
							<th>Email Address</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->surname }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->email }}</td>
								
								@if($userServices->isUserActive($user))
									<td class="alert alert-success">Active</td>
								@else
									<td class="alert alert-warning">Not Active</td>
								@endif
								
								<td><a href="{{ url('/user/'.$user->id) }}" class="btn btn-info btn-sm">Profile</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<div>	
				{{ $users->links() }}
			</div>
			<a href="{{ url('/users/create') }}" class="btn btn-primary">Create user</a>
			<a href="{{ url('/export') }}" class="btn btn-success pull-right">Export to csv</a>
		</div>
	</div>
</div>

@stop