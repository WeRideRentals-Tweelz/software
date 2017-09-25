@extends('layouts.main')
@section('content')
	<div class="container">
		<h1>{{ $document->name }}</h1>
		<div class="row">
			@if(isset($document))
			{{ print($document->content) }}
			@endif
		</div>
	</div>
@stop