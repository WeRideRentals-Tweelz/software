@extends('layouts.main')
@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Documents</h1>
			</div>
			<div class="panel-body">
			@if( count($documents) >= 1)
			<div class="row">
				@foreach($documents as $document)
				<div class="col-xs-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h2 class="panel-title">{{ $document->name }}</h2>
						</div>
						<div class="panel-body">
							<div class="well" style="height: 300px; overflow-y: scroll;">
								{{ print($document->content) }}
							</div>
						</div>
						<div class="panel-footer">
							<a href="/documents/{{ $document->id }}/edit" class="btn btn-primary btn-block">Edit</a>
							
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@else
				<p>No Documents</p>
			@endif
			</div>
			<div class="panel-footer">
				<a href="/documents/create" class="btn btn-primary">Create New Document</a>
			</div>
		</div>
	</div>
@stop