@extends('layouts.main')
@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div id="arrows">
					@if(isset($prev) && $prev > 0)
					<a href="{{ url('/home/scooters/'.$prev) }}" class="pull-left">
						<span class="glyphicon glyphicon-arrow-left"></span>
					</a>	
					@endif

					@if(isset($next) && $next > $scooter->id)
					<a href="{{ url('/home/scooters/'.$next) }}" class="pull-right">
						<span class="glyphicon glyphicon-arrow-right"></span>
					</a>
					@endif

				</div>
				<h1>Scooter informations</h1>
			</div>
			<div class="panel-body">
				<div class="col-sm-6" style="border-right: 2px solid silver">
					<h2>Technical Sheet</h2>
					<form action="{{ isset($scooter) && !is_null($scooter->id) ? url('scooters/'.$scooter->id) : url('scooters') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="col-sm-12">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="col-xs-12">
									@if(isset($scooter))
									<img src="{{ url('storage/'.$scooter->plate.'-'.$scooter->model.'-'.$scooter->color.'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}" width="400" style="width: 100%; border: 2px solid #424242; border-radius: 10px">
									@else
									<p>No image</p>
									@endif
								</div>
								<div class="form-group col-xs-12">
									<label for="scooter-picture">Picture</label>
									<input class="form-control input-xs" type="file" name="scooterPicture">
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group col-xs-6">
								<label for="model">Model</label>
								<input class="form-control" type="text" name="model" value="{{ $scooter->model or old('model') }}" required>	
							</div>

							<div class="form-group col-xs-6">
								<label for="availability">Status</label>
								@if(isset($scooter))
									@if($scooter->availability == 1)
									<br>
									<span class="btn btn-success btn-sm">In Store</span>
									@elseif($scooter->availability == 2)
									<br>
									<span class="btn btn-danger btn-sm">Garage</span>
									@endif
								@endif
								<input class="form-control" type="number" name="availability" value="{{ $scooter->availability or old('availability')}}">
							</div>

							<div class="form-group col-xs-6">
								<label for="color">Color</label>
								<input class="form-control" type="text" name="color" value="{{ $scooter->color or old('color')}}" required>
							</div>

							<div class="form-group col-xs-6">
								<label for="state">State</label>
								<input class="form-control" type="text" name="state" value="{{ $scooter->state or old('state')}}">
							</div>

							<div class="form-group col-xs-6">
								<label for="plate">Plate</label>
								<input class="form-control" type="text" name="plate" value="{{ $scooter->plate or old('plate')}}" required>
							</div>
							
							<div class="form-group col-xs-6">
								<label for="year">Year</label>
								<input class="form-control" type="number" name="year" value="{{ $scooter->year or old('year')}}">
							</div>

							<div class="form-group col-xs-6">
								<label for="category">Category</label>
								<select class="form-control" name="category">
									<option value="{{ $scooter->category or old('category')}}">{{ $scooter->category or old('category')}}</option>
									<option value="tourism">Tourism</option>
									<option value="city">City</option>
								</select>
							</div>

							<div class="form-group col-xs-6">
								<label for="kilometers">Kilometers</label>
								<input class="form-control" type="text" name="kilometers" value="{{ $scooter->kilometers or old('kilometers')}}">
							</div>

							<div class="form-group col-xs-6">
								<label for="last_check">Last Check</label>
								<div class='input-group date row' id="last_check" style="width: 100%;margin-left: 0px;">
				                    <input  type='text' name="last_check" class="form-control" value="{{ isset($scooter) ? $scooter->last_check : ''}}" required/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
						        </div>
							</div>

							<div class="form-group col-xs-12">
								<label for="info">Info</label>
								<textarea class="form-control" rows="5" name="info">{{ $scooter->info or old('info')}}</textarea>
							</div>

							<div class="form-group col-xs-12">
								<button type="submit" class="btn btn-primary btn-sm">
									@if(isset($scooter))
										Update
									@else
										create
									@endif
								</button>
								@if(isset($scooter))
								<button type="button" class="pull-right btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModal">
									<span class="glyphicon glyphicon-remove"></span> Delete
								</button>
								@endif
							</div>

						</div>

					</form>
				</div>

				<div class="col-sm-6">
					<h2>Bookings History</h2>
						@if(isset($bookings) && count($bookings) > 0 )
						<table class="table table-striped table-condensed">
							<thead>
								<tr>
									<th>Booking Number</th>
									<th>Driver</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Days Booked</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($bookings as $booking)
								<tr>
									<td>{{ $booking->id }}</td>
									<td><a href="{{ url('/profile/'.$booking->user_id) }}">{{ $booking->user->name }}</a></td>
									<td>{{ date_format(date_create($booking->pick_up_date), 'd M Y') }}</td>
									<td>{{ date_format(date_create($booking->drop_off_date), 'd M Y') }}</td>
									<td>{{ date_create($booking->drop_off_date)->diff(date_create($booking->pick_up_date))->d }}</td>
									<td><a href="{{ url('/bookings/'.$booking->id.'/edit') }}" class="btn btn-info btn-xs">Details</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<p>No Booking History</p>
						@endif
				</div>


			</div>
			<div class="panel-footer">
				<a href="{{ url('/home/scooters') }}" class="btn btn-info"><span class="fa fa-undo fa-2x"></span>Back</a>
			</div>
		</div>
	</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="label label-danger">WARNING</span></h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this scooter from the database ? <br> It can destroy data from the report for ever...</p>
      </div>
      <div class="modal-footer">
      	@if(isset($scooter))
      		<a href="{{ url('/scooters/'.$scooter->id.'/destroy') }}" class="btn btn-danger">Yes, I am sure</a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@stop

@section("scripts")
<script type="text/javascript">
            $(function () {
                $('#last_check').datetimepicker({
                	format: "YYYY-MM-DD"
                });
            });
</script>
@stop