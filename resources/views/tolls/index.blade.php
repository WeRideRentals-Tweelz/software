@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<form id="form" method="POST">
		{{ csrf_field() }}
			<div class="panel-heading">
				@if(isset($sort) && isset($order))
					<h1><span id="sort" class="hidden">{{ $sort }}</span>Tolls<span id="order" class="hidden">{{ $order }}</span></h1>
				@else	
					<h1>Tolls</h1>
				@endif
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-striped table-hover">
						<thead>
							<tr id="head">
								<?php $order == 'asc' ? $oOrder = 'desc' : $oOrder = "asc"?>
								<th id="Date"><a href="{{ url('/tolls/') }}">Date </a></th>
								<th id="Time"><a href="{{ url('/tolls/Time/'.$oOrder.'/'.$limit) }}">Time</a></th>
								<th id="LicencePlate"><a href="{{ url('/tolls/LicencePlate/'.$oOrder.'/'.$limit) }}">Licence Plate</a></th>
								<th id="Tag"><a href="{{ url('/tolls/Tag/'.$oOrder.'/'.$limit) }}">Tag</a></th>
								<th id="TagName"><a href="{{ url('/tolls/TagName/'.$oOrder.'/'.$limit) }}">Tag Name</a></th>
								<th id="Group"><a href="{{ url('/tolls/Group/'.$oOrder.'/'.$limit) }}">Group</a></th>
								<th id="On"><a href="{{ url('/tolls/On/'.$oOrder.'/'.$limit) }}">On</a></th>
								<th id="Lane"><a href="{{ url('/tolls/Lane/'.$oOrder.'/'.$limit) }}">Lane</a></th>
								<th id="VehicleType"><a href="{{ url('/tolls/VehicleType/'.$oOrder.'/'.$limit) }}">Vehicle Type</a></th>
								<th id="Amount"><a href="{{ url('/tolls/Amount/'.$oOrder.'/'.$limit) }}">Amount</a></th>
								<th>Edit/Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tolls as $toll)
								<tr>
									<td>{{ date_format(date_create($toll->Date), 'd/m/Y') }}</td>
									<td>{{ $toll->Time }}</td>
									<td>{{ $toll->LicencePlate }}</td>
									<td>{{ $toll->Tag }}</td>
									<td>{{ $toll->TagName }}</td>
									<td>{{ $toll->Group }}</td>
									<td>{{ $toll->On }}</td>
									<td>{{ $toll->Lane }}</td>
									<td>{{ $toll->VehicleType }}</td>
									<td>{{ $toll->Amount }}</td>
									<td><input class="modify" type="checkbox" name="toll[]" value="{{ $toll->id }}"></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<a href="{{ url('/home') }}" class="btn btn-info btn-sm">Back</a>
				@if($limit <= 10)
					<a id="showButton" href="{{ url('/tolls/'.$sort.'/'.$order.'/100') }}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"> </span> Show More</a>
				@else
					<a id="showButton" href="{{ url('/tolls/'.$sort.'/'.$order.'/10') }}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-minus"> </span> Show Less</a>
				@endif
				<a href="{{ url('/tolls/create') }}" class="btn btn-primary btn-sm">Import new tolls</a>
				
				<div id="options" class="hidden pull-right">
					<button id="edit" role="button" class="btn btn-info btn-xs">Edit</button>
					<button id="delete" role="button" class="btn btn-danger btn-xs">Delete</button>
				</div>

			</div>
		</form>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	var head = document.getElementById('head');
	var order = document.getElementById('order');
	var sort = document.getElementById('sort');

	var headings = head.childNodes;
	headings.forEach(function(heading){
		if(heading.id == sort.textContent){
			if(order.textContent == "asc"){
				var arrow = document.createElement('span');
				arrow.className = "glyphicon glyphicon-arrow-up";
				heading.append(arrow);
			}else{
				var arrow = document.createElement('span');
				arrow.className = "glyphicon glyphicon-arrow-down";
				heading.append(arrow);
			}
			heading.getElementsByTagName('a')[0].style.color	= "black";
		}
	});

	//EDIT/DELETE FORM OPTIONS
	var tolls = document.getElementsByClassName('modify');

	for (var i = tolls.length - 1; i >= 0; i--) {
		tolls[i].addEventListener('change', function(e){
				var options = document.getElementById('options');
				options.classList.remove('hidden');
		});
	}

	var form = document.getElementById('form');
	var edit = document.getElementById('edit');
	var del = document.getElementById('delete');

	edit.addEventListener('click', function(e){
		e.preventDefault();
		form.setAttribute('action','{{ url("/tolls/edit") }}');
		form.submit();
	});

	del.addEventListener('click', function(e){
		e.preventDefault();
		form.setAttribute('action','{{ url("/tolls/delete") }}');
		form.submit();
	});

</script>
@stop