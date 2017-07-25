@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>{{ $scooter->plate }} {{ $scooter->model }} - {{ $check }}km check interventions</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class='table table-hover table-striped table-condensed'>
					<thead>
						<tr>
							<th>Part</th>
							<th>Action Required</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($actionsNeeded as $part => $action)
						<tr>
							<td>{{ ucfirst($part) }}</td>
							<td>{{ $action }}</td> 
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<a href="{{ url('/home/scooters/'.$scooter->id) }}" class="btn btn-info btn-sm">Back</a>
			<a href="{{ url('/home/scooter/checked/'.$scooter->id.'/kmCheck/'.$check) }}" class="btn btn-success btn-sm pull-right">Check Done</a>
		</div>
	</div>
</div>
@stop