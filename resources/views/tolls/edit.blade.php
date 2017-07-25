@extends('layouts.main')
@section('content')
<div class="container">
	<form action="{{ url('/tolls/update') }}" method="POST">
		{{ csrf_field() }}
		@foreach($tolls as $toll)
		<div class="panel panel-default col-sm-6">
			<div class="panel-heading row">
				<h1>Toll N°{{ $toll->id }}</h1>
			</div>
			<div class="panel-body">
				<div class="col-sm-10 col-sm-offset-1">
					<input type="hidden" name="tollId[]" value="{{ $toll->id }}">
					
					<div class="form-group col-xs-4">
						<label for="Date">Date</label>
						<div class='input-group date row Date'>
		                    <input type='text' name="Date{{ $toll->id }}" class="form-control" placeholder="Date" value="{{ $toll->Date or old('Date') }}" required/>
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
					</div>

					<div class="form-group col-xs-4">
						<label for="Time">Time</label>
						<div class='input-group date row Time'>
		                    <input type='text' name="Time{{ $toll->id }}" class="form-control" placeholder="Time" value="{{ $toll->Time or old('Time') }}" required/>
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-time"></span>
		                    </span>
		                </div>
					</div>

					<div class="form-group col-xs-4">
						<label for="LicencePlate">Licence Plate</label>
						<input class="form-control" type="text" name="LicencePlate{{ $toll->id }}" value="{{ $toll->LicencePlate or old('LicencePlate') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="Tag">Tag</label>
						<input class="form-control" type="text" name="Tag{{ $toll->id }}" value="{{ $toll->Tag or old('Tag') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="TagName">Tag Name</label>
						<input class="form-control" type="text" name="TagName{{ $toll->id }}" value="{{ $toll->TagName or old('TagName') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="Group">Group</label>
						<input class="form-control" type="text" name="Group{{ $toll->id }}" value="{{ $toll->Group or old('Group') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="On">On</label>
						<input class="form-control" type="text" name="On{{ $toll->id }}" value="{{ $toll->On or old('On') }}">
					</div>
					
					<div class="form-group col-xs-4">
						<label for="Lane">Lane</label>
						<input class="form-control" type="text" name="Lane{{ $toll->id }}" value="{{ $toll->Lane or old('Lane') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="VehicleType">Vehicle Type</label>
						<input class="form-control" type="text" name="VehicleType{{ $toll->id }}" value="{{ $toll->VehicleType or old('VehicleType') }}">
					</div>

					<div class="form-group col-xs-4">
						<label for="Amount">Amount</label>
						<input class="form-control" type="text" name="Amount{{ $toll->id }}" value="{{ $toll->Amount or old('Amount') }}">
					</div>
				</div>	
			</div>
		</div>

		@endforeach
		
		<div class="col-xs-12 panel panel-default panel-footer">	
			<a href="{{ url('/tolls') }}" class="btn btn-info btn-sm">Back</a>
			<button role="submit" class="btn btn-primary btn-sm pull-right">Update</button>
		</div>

	</form>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('.Date').datetimepicker({
        	format: "YYYY-MM-DD"
        });
        $('.Time').datetimepicker({
        	format: "HH:mm"
        });
    });
</script>
@stop