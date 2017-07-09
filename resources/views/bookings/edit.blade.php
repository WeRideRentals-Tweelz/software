@extends('layouts.main')
@section('content')
<form action="{{ isset($booking) ? url('/bookings/'.$booking->id) : url('/bookings')}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			@if(isset($booking))
				<h1>Booking N°{{ $booking->id }}</h1>
			@else
				<h1>New Booking</h1>
			@endif
		</div>
		<div class="panel-body">
				<div class="row">
					
					<div id="scooterInfo" class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2>Scooter Info</h2>
							</div>
							<div class="panel-body">
								@if(isset($booking) && $booking->scooter_id != 0)
									<div class="col-sm-12">
										<div class="col-sm-8 col-sm-offset-2">
											<a href="{{ url('/home/scooters/'.$booking->scooter_id) }}">
												<img class="portrait" src="{{ url('storage/'.$booking->scooter->plate.'-'.$booking->scooter->model.'-'.$booking->scooter->color.'.jpg') }}" alt="{{ 'scooter '.$booking->scooter->model.' of '.$booking->scooter->year }}" width="400">
											</a>
										</div>
									</div>

									<div class="col-sm-6">
										<h3>Model</h3>
										<p>{{ $booking->scooter->model }}</p>
									</div>

									<div class="col-sm-6">
										<h3>Color</h3>
										<p>{{ $booking->scooter->color }}</p>
									</div>

									<div class="col-sm-6">
										<h3>Plate</h3>
										<p>{{ $booking->scooter->plate }}</p>
									</div>

									<div class="col-sm-6">
										<h3>Category</h3>
										<p>{{ $booking->scooter->category }}</p>
									</div>

									<div class="col-sm-12">
										<h3>Kilometers</h3>
										<p>{{ $booking->scooter->kilometers }} km</p>
									</div>

									<input class="hidden" type="radio" name="scooter" value="{{ $booking->scooter->id }}" checked>

									<div class="col-sm-8 col-sm-offset-2">
										<button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#scooterModal">Assign Another Scooter</button>
									</div>
								@elseif(!isset($booking) || $booking->scooter_id == 0)
									<div class="col-sm-6 col-sm-offset-3">
										<button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#scooterModal">Assign Scooter</button>
									</div>
								@endif
							</div>
						</div>
					</div>


					<div class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2>Booking Info</h2>
							</div>
							<div class="panel-body">
								<div class="col-xs-12">
								@if(isset($booking))
									@if($booking->user_id != 0 && $booking->scooter_id != 0)
										<p class="alert alert-info">Booking Ready</p>
									@elseif($booking->user_id == 0 || $booking->scooter_id == 0)
										
										@if($booking->user_id == 0)
											<p class="alert alert-danger">Please Assign User</p>
										@elseif(!$booking->user->driver->confirmed)
											<p class="alert alert-warning">Driver's not confirmed</p>
										@endif

										@if($booking->scooter_id == 0)
											<p class="alert alert-danger">Please Assign Scooter</p>
										@endif
									@endif
								@endif
								</div>
								<div class="col-sm-8 col-sm-offset-2">
									<div class="form-group col-xs-12">
										<label for="pick_up_date">Start Date</label>
										<div class='input-group date' id="pick_up_date">
						                    <input  type='text' name="pick_up_date" class="form-control" value="{{ isset($booking) ? $booking->pick_up_date : ''}}" required/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
								        </div>
									</div>

									<div class="form-group col-xs-12">
										<label for="drop_off_date">End Date</label>
										<div class='input-group date' id="drop_off_date">
						                    <input  type='text' name="drop_off_date" class="form-control" value="{{ isset($booking) ? $booking->drop_off_date : ''}}" required/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
								        </div>
									</div>
									
									<div class="row">

										@if(isset($booking))
											<div class="col-xs-6">
												<button type="submit" class="btn btn-primary btn-sm form-control">Update</button>
											</div>
											<div class="col-xs-6">
												<button type="button" class="btn btn-danger btn-sm form-control" data-toggle="modal" data-target="#removeModal"><span class="glyphicon glyphicon-remove"></span> Delete</button>
											</div>
										@else
											<div class="col-xs-12">
												<button type="submit" class="btn btn-success form-control">Create</button>
											</div>
										@endif

									</div>

								</div>
							</div>
						</div>
					</div>


					<div id="driverInfo" class="col-sm-4" style="font-size: 8px">
						<div class="panel panel-default">

							<div class="panel-heading">
								<h2>Driver Info</h2>
							</div>
							<div class="panel-body">
								@if(isset($booking) && $booking->user_id != 0)
								<div class="row">

									<div class="col-sm-12">
										<div class="col-sm-6 col-sm-offset-3">	
											<a href="{{ url('/profile/'.$booking->user_id) }}">
												@if(file_exists('storage/'.$booking->user->name.'.jpg'))
													<img class="portrait" src="{{ url('storage/'.$booking->user->name.'.jpg')}}" alt="{{ $booking->user->name.' portrait' }}" width="400">
												@else
													<img class="portrait" src="{{ url('storage/user.png')}}" alt="{{ $booking->user->name.' portrait' }}" width="400">
												@endif
											</a>
										</div>
									</div>

										<h4 class="col-sm-12">Personnal Info</h4>

										<div class="col-sm-6">
											<h3>Name</h3>
											<p>{{ $booking->user->name }}</p>
										</div>
										
										<div class="col-sm-6">
											<h3>Date Of Birth</h3>
											@if($booking->user->driver->date_of_birth !== null)
												<p>{{ date_format(date_create($booking->user->driver->date_of_birth), 'd/m/Y') }}</p>
											@endif
										</div>

										<div class="col-sm-12">
											<h3>Email</h3>
											<p>{{ $booking->user->email }}</p>
										</div>

										<div class="col-sm-6">
											<h3>Address</h3>
											<p>{{ $booking->user->driver->address }}</p>
										</div>

										<div class="col-sm-6">
											<h3>Phone Number</h3>
											<p>{{ $booking->user->phone }}</p>
										</div>

										<h4 class="col-xs-12">Licence Info</h4>

										<div class="col-sm-6">
											<h3>Drivers Licence</h3>
											<p>{{ $booking->user->driver->drivers_licence }}</p>
										</div>

										<div class="col-sm-6">
											<h3>Expiry Date</h3>
											@if($booking->user->driver->expiry_date !== null)
												<p>{{ date_format(date_create($booking->user->driver->expiry_date), ' D d/m/Y') }}</p>
											@endif
										</div>

										<div class="col-sm-6">
											<h3>Licence State</h3>
											<p>{{ $booking->user->driver->licence_state }}</p>
										</div>
									@if(!$booking->user->driver->confirmed)
										<div class="col-sm-6 col-sm-offset-3">
											<a href="{{ url('/profile/'.$booking->user_id) }}" class="btn btn-warning" style="margin-bottom: 20px">Fill drivers details</a>
										</div>
									@endif
								</div>

								<input class="hidden" type="radio" name="user" value="{{ $booking->user->id }}" checked>

								<div class="row">
									<div class="col-sm-8 col-sm-offset-2">
										<button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#userModal">Assign Another User</button>
									</div>
								</div>
								@elseif(!isset($booking) || $booking->user_id == 0)
									<div class="col-sm-6 col-sm-offset-3">
										<button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#userModal">Assign User</button>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="panel-footer">
			<a href="{{ url('/bookings') }}" class="btn btn-info">Back</a>
		</div>
	</div>
</div>


<!-- Scooters Modal -->
<div id="scooterModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Scooters Available</h4>
      </div>
      <div class="modal-body">
        @foreach($scooters as $scooter)
        	<div class="radio">
        		<label>
        			<input type="radio" name="scooter" value="{{ $scooter->id }}">
        			<span class="scooterName">{{ $scooter->plate }}-{{ $scooter->model }}</span><span class="colorPanel" style="background-color: {{ $scooter->color }}"></span>
        		</label>
        	</div>
        @endforeach
        <hr>
       		 <div class="radio">
        		<label>
        			<input type="radio" name="scooter" value="0">
        			<span class="scooterName">No Scooter</span><span class="colorPanel" style="background-color: transparent;"></span>
        		</label>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Assign</button>
      </div>
    </div>

  </div>
</div>

<!-- User Modal -->
<div id="userModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Drivers</h4>
      </div>
      <div class="modal-body">
        @foreach($users as $user)
        	<div class="radio">
        		<label>
        			<input type="radio" name="user" value="{{ $user->id }}">
        			<span class="userName">{{ $user->name }}</span>
        		</label>
        	</div>
        @endforeach
        <hr>
        	<div class="radio">
        		<label>
        			<input type="radio" name="user" value="0">
        			<span class="userName">No User</span>
        		</label>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Assign</button>
        @if(isset($booking))
        	<a href="{{ url('/users/create/fromBooking/'.$booking->id) }}" class="btn btn-success">Create New User</a>
        @endif
      </div>
    </div>

  </div>
</div>

@if(isset($booking))
<!-- Remove Modal -->
<div id="removeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">!!! Warning !!!</h4>
      </div>
      <div class="modal-body">
        <p>Do you REALLY want to delete this booking ?</p>
      </div>
      <div class="modal-footer">
      		<a href="{{ url('/bookings/'.$booking->id.'/destroy') }}" class="btn btn-danger">Yes</a>
        	<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
@endif

</form>



@stop
@section("scripts")
<script type="text/javascript">
            $(function () {
                $('#pick_up_date').datetimepicker({
                	format: "YYYY-MM-DD"
                });
                $('#drop_off_date').datetimepicker({
                	format: "YYYY-MM-DD"
                });
            });
</script>
@stop