@extends('layouts.main')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Import Csv file</h1>
		</div>
		<div class="panel-body">
			<form method="post" action="/tolls" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="col-xs-4 col-xs-offset-4 form-group">
					<label for="csv">Csv File</label>
					<input type="file" name="csv">	
				</div>
				<div class="col-xs-4 col-xs-offset-4">
					<button role="submit" class="form-group btn btn-primary btn-sm">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop