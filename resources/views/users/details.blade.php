@extends('layouts.main')
@section('content')
	<div class="container-fluid">
		<div class="col-sm-6 col-sm-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>My Profile</h2>
				</div>
				<div class="panel-body">
					@if(Session::has('personnalInfoSuccess'))
					<div class="alert alert-success">
						<p>{{ Session::get('personnalInfoSuccess') }}</p>
					</div>
					@endif
					
					@if($user->driver->confirmed && Auth::user()->role_id == 1)
					<div class="alert alert-success">
						<p>Driver confirmed</p>
					</div>
					@elseif(!$user->driver->confirmed)
					<div class="alert alert-warning">
						<p>Driver not confirmed</p>
						<p>Save time at check in by filling all your information</p>
					</div>
					@endif
					
					<form class="form" action="{{ url('/user/update') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="userIdInput" type="hidden" name="user" value="{{ $user->id }}">
						<div class="col-sm-6">
						<h3>Personnal Informations</h3>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					                            <label for="name" class="col-xs-10 control-label">Name</label>
					                            <div class="col-xs-12">
					                                <input id="name" type="text" class="form-control infoInputs" name="name" value="{{ $user->name or old('name') }}" required>

					                                @if ($errors->has('name'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('name') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
					                            <label for="phone" class="col-xs-10 control-label">Phone Number</label>
					                            <div class="col-xs-12">
					                                <input id="phone" type="phone" class="form-control infoInputs" name="phone" value="{{ $user->phone or old('phone') }}" required>

					                                @if ($errors->has('phone'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('phone') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					                            <label for="email" class="col-xs-10 control-label">E-Mail Address</label>
					                            <div class="col-xs-12">
					                                <input id="email" type="email" class="form-control infoInputs" name="email" value="{{ $user->email or old('email') }}" required>

					                                @if ($errors->has('email'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('email') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
					                            <label for="address" class="col-xs-10 control-label">Renter's Address</label>
					                            <div class="col-xs-12">
					                                <input id="address" type="text" class="form-control infoInputs" name="address" value="{{ $user->driver->address !== null ? $user->driver->address : old('address')}}" >

					                                @if ($errors->has('address'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('address') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>	
					            </div>

					            <div class="col-sm-6">
					                        <h3>Driver's Licence Information</h3>

					                        <div class="form-group{{ $errors->has('drivers_licence') ? ' has-error' : '' }}">
					                            <label for="drivers_licence" class="col-xs-10 control-label">Driver's Licence Number</label>
					                            <div class="col-xs-12">
					                                <input id="drivers_licence" type="text" class="form-control infoInputs" name="drivers_licence" value="{{  $user->driver->drivers_licence !== null ? $user->driver->drivers_licence : old('drivers_licence') }}" >

					                                @if ($errors->has('drivers_licence'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('drivers_licence') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('licence_state') ? ' has-error' : '' }}">
					                            <label for="licence_state" class="col-xs-10 control-label">Driver's Licence State of issue</label>
					                            <div class="col-xs-12">
					                                <input id="licence_state" type="text" class="form-control infoInputs" name="licence_state" value="{{ $user->driver->licence_state !== null ? $user->driver->licence_state : old('licence_state')}}" >

					                                @if ($errors->has('licence_state'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('licence_state') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group col-xs-12 ">
					        			<label for="expiry_date" class="col-xs-10 control-label">Expiry Date</label>
							            <div class='input-group date  col-xs-12' id='expiry_date'>
							                    <input type='text' name="expiry_date" class="form-control infoInputs" value="{{ $user->driver->expiry_date !== null ? date_format(date_create($user->driver->expiry_date),'d/m/Y') : null }}" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							            </div>
							</div>
							<div class="form-group col-xs-12 ">
							            <label for="date_of_birth" class="col-xs-10 control-label">Date of birth</label>
							            <div class='input-group date  col-xs-12' id='date_of_birth'>
							                    <input type='text' name="date_of_birth" class="form-control infoInputs" value="{{ $user->driver->date_of_birth !== null ? date_format(date_create($user->driver->date_of_birth),'d/m/Y') : null }}" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							            </div>
							</div>
						</div>
						<div class='col-xs-12'>
					                        <div class="form-group">
					                            <div class="col-xs-2 col-xs-offset-5">
					                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px; margin-bottom: 10px">
					                                    Update Profile
					                                </button>
							    </div>
							</div>
						</div>
					</form>

					@if(Auth::user()->role_id == 1 && !$user->driver->confirmed)
					<div class="form-group">
			                            <div id="confirmUserPlace"class="col-xs-2 col-xs-offset-5">
			                               <!-- Here goes the javascript button for confirming User -->
					    </div>
					</div>
					@endif
				</div>

				@if(Auth::user()->id == $user->id)
				<hr>
				<div class="container-fluid">
					<div class="col-sm-4 col-sm-offset-4">
						@if(Session::has('passwordSuccess'))
						<div class="alert alert-success">
							<p>{{ Session::get('passwordSuccess') }}</p>
						</div>
						@endif
						<form class="form" action="{{ url('/user/changePassword') }}" method='POST'>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="container-fluid">
							<h3>Change Password</h3>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					                            <label for="password" class="col-xs-12 control-label">Password</label>
					                            <div class="col-xs-12">
					                                <input id="password" type="password" class="form-control" name="password" required>

					                                @if ($errors->has('password'))
					                                    <span class="help-block">
					                                        <strong style="color: red">{{ $errors->first('password') }}</strong>
					                                    </span>
					                                @elseif (Session::has('passwordError'))
					                                <span class="help-block">
					                                        <strong>{{ Session::get('passwordError') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
					                            <label for="new_password" class="col-xs-12 control-label">New Password</label>
					                            <div class="col-xs-12">
					                                <input id="new_password" type="password" class="form-control" name="new_password" required>

					                                @if ($errors->has('new_password'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('new_password') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group">
					                            <div class="col-xs-4 col-xs-offset-2">
					                                <button type="submit" class="btn btn-warning btn-sm" style="margin-top: 10px; margin-bottom: 10px">
					                                    Change password
					                                </button>
							    </div>
							</div>
						</div>
						</form>
					</div>
				</div>
				@endif
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>My Bookings</h2>
				</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Pick Up Date</th>
								<th>Drop Off Date</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($bookings as $booking)
							<tr>
								<td>{{ $booking->pick_up_date }}</td>
								<td>{{ $booking->drop_off_date }}</td>
								<td>{{ ucfirst($booking->status) }}</td>
								<td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#datesChange"><span class="glyphicon glyphicon-pencil"> </span> Change dates</button></td>
							</tr>
						@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div id="datesChange" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Please Select Other Dates</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="container-fluid">
		        	<form id="datesChangeForm">
		        		<div class="form-group col-xs-12">
		        			<label>Pick Up Date</label>
				            <div class='input-group date row' id='pickUpDate'>
				                    <input type='text' name="pickUp" class="form-control" placeholder="Pick Up Date" value="{{ date_format(date_create($booking->pick_up_date),'d/m/Y') }}" required/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				            </div>
				</div>
				<div class="form-group col-xs-12">
				            <label>Drop Off Date</label>
				            <div class='input-group date row' id='dropOffDate'>
				                    <input type='text' name="dropOff" class="form-control" placeholder="Drop Off Date" value="{{ date_format(date_create($booking->drop_off_date),'d/m/Y') }}" required/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				            </div>
				</div>
		        	</form>
		</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" form="datesChangeForm">Save</button>
	      </div>
	    </div>

	  </div>
	</div>
@stop

@section("scripts")
<script type="text/javascript">
            $(function () {
                $('#pickUpDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#dropOffDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#expiry_date').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#date_of_birth').datetimepicker({
                	format: "DD/MM/YYYY"
                });
            });

            var inputs = document.getElementsByClassName('infoInputs');
            showButton = true;
        	var filled = false;
        	for (var i = inputs.length - 1; i >= 0; i--) {
        		var filled = false;
        		if(inputs[i].value !== ''){
        			var filled = true;
        			var tick = document.createElement('span');
        			tick.className = 'glyphicon glyphicon-ok';
        			tick.style.color	= 'green';
        			inputs[i].parentElement.parentElement.prepend(tick);
        			console.log(inputs[i].value);
        		}
        		else{
        			showButton = false;
        		}
        	}
        	if(showButton){
	            var confirmUserButton = document.createElement('button');
	            confirmUserButton.id = "confirmUser";
	            confirmUserButton.setAttribute('type','button');
	            confirmUserButton.className = "btn btn-success btn-sm";
	            confirmUserButton.style.marginTop = "10px";
	            confirmUserButton.style.marginBottom = "10px";
	            confirmUserButton.textContent = "Confirm User";

	            var buttonPlace = document.getElementById('confirmUserPlace');
	            buttonPlace.append(confirmUserButton);
	            
	            var userId = document.getElementById('userIdInput').value;
	            confirmUserButton.addEventListener('click',function(e){
	            	location.href = "/user/confirm/"+userId;
	            });
        	}

</script>
@stop