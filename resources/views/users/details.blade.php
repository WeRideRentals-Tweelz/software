@extends('layouts.main')
@section('styles')
	<style type="text/css">
		input
		{
			margin-bottom: 20px;
		}
	</style>
@stop

@section('content')
	<div class="container-fluid">
		<div class="col-sm-6 col-sm-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					@if(isset($user))
						<h2>My Profile</h2>
					@else
						<h2>New User</h2>
					@endif
				</div>
				<div class="panel-body">
					@if(Session::has('personnalInfoSuccess'))
					<div class="alert alert-success">
						<p>{{ Session::get('personnalInfoSuccess') }}</p>
					</div>
					@endif

					@if(Session::has('success'))
					<div class="alert alert-success">
						<p>{{ Session::get('success') }}</p>
					</div>
					@endif

					@if(isset($user) && $user->driver->confirmed && Auth::user()->role_id == 1)
					<div class="alert alert-success">
						<p>Driver confirmed</p>
					</div>
					@elseif(isset($user) && !$user->driver->confirmed)
					<div class="alert alert-warning">
						<p>Save time at check in by filling all your information</p>
					</div>
					@endif
					
					<form class="form" action="{{ isset($user) ? url('/profile/'.$user->id.'/update') : url('/users') }}" method="POST" enctype="multipart/form-data">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="userIdInput" type="hidden" name="user" value="{{ $user->id or old('user')}}">
					
					@if(isset($bookingId))
						<input type="hidden" name="booking" value="{{ $bookingId }}">
					@endif

					<div class="col-sm-12">
						<div class="col-sm-4 col-sm-offset-4">
							<div class="col-sm-8 col-sm-offset-2 ">
								@if(isset($user) && file_exists('storage/'.$user->name.'.jpg'))
									<img class="portrait" src="{{ url('storage/'.$user->name.'.jpg')}}" alt="{{ $user->name.' portrait' }}" width="400">
								@else
									<img class="portrait" src="{{ url('storage/user.png')}}" alt="{{ 'User portrait' }}" width="400">
									<p>No image</p>
								@endif
							</div>
							<div class="form-group col-xs-12">
								<label for="userPicture">Picture</label>
								<input class="form-control input-xs" type="file" name="userPicture">
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<h3>Personnal Informations</h3>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="nameFormGroup">
	                            <label  id="nameLabel" for="name" class="col-xs-11 control-label">Name <small><em>as on id or passeport</em></small></label>
	                            <div class="col-xs-12">
	                                <input id="name" type="text" class="form-control infoInputs" name="name" value="{{ $user->name or old('name') }}" required>

	                                @if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}" id="surnameFormGroup">
	                            <label id="surnameLabel" for="surname" class="col-xs-11 control-label">Surname <small class=""><em>as on id or passeport</em></small></label>
	                            <div class="col-xs-12">
	                                <input id="surname" type="text" class="form-control infoInputs" name="surname" value="{{ $user->surname or old('surname') }}" required>

	                                @if ($errors->has('surname'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('surname') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" id="phoneFormGroup">
	                            <label id="phoneLabel" for="phone" class="col-xs-11 control-label">Phone Number</label>
	                            <div class="col-xs-12">
	                                <input id="phone" type="phone" class="form-control infoInputs" name="phone" value="{{ $user->phone or old('phone') }}" required>

	                                @if ($errors->has('phone'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('phone') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="emailFormGroup">
	                            <label id="emailLabel" for="email" class="col-xs-11 control-label">E-Mail Address</label>
	                            <div class="col-xs-12">
	                                <input id="email" type="email" class="form-control infoInputs" name="email" value="{{ $user->email or old('email') }}" required>

	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" id="addressFormGroup">
	                            <label id="addressLabel" for="address" class="col-xs-11 control-label">Renter's Address</label>
	                            <div class="col-xs-12">
	                                <input id="address" type="text" class="form-control infoInputs" name="address" value="{{ isset($user) && $user->driver->address !== null ? $user->driver->address : old('address')}}" >

	                                @if ($errors->has('address'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('address') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>	
	                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}" id="cityFormGroup">
	                            <label id="cityLabel" for="city" class="col-xs-11 control-label">Suburb</label>
	                            <div class="col-xs-12">
	                                <input id="city" type="text" class="form-control infoInputs" name="city" value="{{ isset($user) && $user->driver->city !== null ? $user->driver->city : old('city')}}" >

	                                @if ($errors->has('city'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('city') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}" id="stateFormGroup">
	                            <label id="stateLabel" for="state" class="col-xs-11 control-label">State</label>
	                            <div class="col-xs-12">
	                                <input id="state" type="text" class="form-control infoInputs" name="state" value="{{ isset($user) && $user->driver->state !== null ? $user->driver->state : old('state')}}" >

	                                @if ($errors->has('state'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('state') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}" id="postcodeFormGroup">
	                            <label id="postcodeLabel" for="postcode" class="col-xs-11 control-label">Post Code</label>
	                            <div class="col-xs-12">
	                                <input id="postcode" type="number" class="form-control infoInputs" name="postcode" value="{{ isset($user) && $user->driver->postcode !== null ? $user->driver->postcode : old('postcode')}}" >

	                                @if ($errors->has('postcode'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('postcode') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
					            </div>

					            <div class="col-sm-6">
			                        <h3>Driver's Licence Information</h3>

			                        <div class="form-group{{ $errors->has('drivers_licence') ? ' has-error' : '' }}" id="drivers_licenceFormGroup">
			                            <label id="drivers_licenceLabel" for="drivers_licence" class="col-xs-11 control-label">Driver's Licence Number</label>
			                            <div class="col-xs-12">
			                                <input id="drivers_licence" type="text" class="form-control infoInputs" name="drivers_licence" value="{{ isset($user) && $user->driver->drivers_licence !== null ? $user->driver->drivers_licence : old('drivers_licence') }}" >

			                                @if ($errors->has('drivers_licence'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('drivers_licence') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                        <div class="form-group{{ $errors->has('licence_state') ? ' has-error' : '' }}" id="licence_stateFormGroup">
			                            <label id="licence_stateLabel" for="licence_state" class="col-xs-11 control-label">Driver's Licence State of issue</label>
			                            <div class="col-xs-12">
			                                <input id="licence_state" type="text" class="form-control infoInputs" name="licence_state" value="{{ isset($user) && $user->driver->licence_state !== null ? $user->driver->licence_state : old('licence_state')}}" >

			                                @if ($errors->has('licence_state'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('licence_state') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                <div class="form-group col-xs-12" id="expiry_dateFormGroup">
			        			<label id="expiry_dateLabel" for="expiry_date" class="col-xs-11 control-label">Expiry Date</label>
					            <div class='input-group date  col-xs-12' id='expiry_date'>
					                    <input id="expiryDate" type='text' name="expiry_date" class="form-control" value="{{ isset($user) && $user->driver->expiry_date != '' ? $user->driver->expiry_date : '' }}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            </div>
					            <input type="checkbox" name="noExpiry" id="noExpiry" {{ isset($user) && $user->driver->expiry_date == '' ? 'checked':'' }}>
					            <label for="noExpiry">No expiration date</label>
							</div>
							<div class="form-group col-xs-12" id="date_of_birthFormGroup">
					            <label id="date_of_birthLabel" for="date_of_birth" class="col-xs-11 control-label">Date of birth</label>
					            <div class='input-group date  col-xs-12' id='date_of_birth'>
					                    <input type='text' name="date_of_birth" class="form-control infoInputs" value="{{ $user->driver->date_of_birth or old('date_of_birth') }}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            </div>
							</div>
						</div>
						<div class='col-xs-12'>
	                        <div class="form-group">
	                            <div class="col-xs-6 col-xs-offset-3">
	                            	@if(Auth::user()->role_id == 1 && isset($user) && !$user->signed)
	                            		<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#signModal">Make user sign</button>
	                            	@endif
	                            	@if(isset($user))
	                                <button type="submit" class="btn btn-primary btn-sm btn-block" style="margin-top: 10px; margin-bottom: 10px">
	                                    Update
	                                </button>
	                                @else
	                                <button type="submit" class="btn btn-primary btn-sm form-control" style="margin-top: 10px; margin-bottom: 10px">
	                                    Create
	                                </button>
	                                @endif
							    </div>
							</div>
						</div>
					</form>

					@if(Auth::user()->role_id == 1 && isset($user))
					<div class="form-group">
						@if(!$user->driver->confirmed)
	                        <div id="confirmUserPlace" class="col-xs-6 col-xs-offset-3">
	                           <!-- Here goes the javascript button for confirming User -->
						    </div>
					    @endif
					    <div class="col-xs-2 col-xs-offset-5">
					    	<button type="button" class=" form-control btn btn-danger btn-sm" data-toggle="modal" data-target="#banUser">Ban</button>
					    </div>
					</div>
					@endif
				</div>

				<div id="userAuth" class="hidden">{{ Auth::user()->role_id }}</div>

				@if(isset($user) && Auth::user()->id == $user->id)
				<hr>
				<div class="container-fluid">
					<div class="col-sm-4 col-sm-offset-4">
						@if(Session::has('passwordSuccess'))
						<div class="alert alert-success">
							<p>{{ Session::get('passwordSuccess') }}</p>
						</div>
						@endif
						<form class="form" action="{{ url('/profile/changePassword') }}" method='POST'>
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
				@if(isset($bookings) && count($bookings) > 0)
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Scooter</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($bookings as $booking)
								<tr>
									<td>{{ date_format(date_create($booking->pick_up_date), 'D d M Y') }}</td>
									<td>{{ date_format(date_create($booking->drop_off_date), 'D d M Y') }}</td>

									@if($booking->scooter_id != 0)
										<td>{{ $booking->scooter->color }} {{ $booking->scooter->model }}</td>
									@else
										<td>No scooter assigned yet</td>
									@endif

									<td>{{ ucfirst($booking->status) }}</td>
									<!--
									<td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#datesChange"><span class="glyphicon glyphicon-pencil"> </span> Change dates</button></td>
									-->
									@if(Auth::user()->role_id == 1)
										<td><a href="{{ url('/bookings/'.$booking->id.'/edit') }}" class="btn btn-info btn-xs">Details</a></td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<p>No bookings</p>
				@endif
				</div>
			</div>
		</div>
		@if(isset($user))
		<div class="col-sm-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3>Make a new reservation</h3>
				</div>
				<div class="panel-body">
					<form id="book" class="form" action="/quote" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div id="form-input-group">
							<input type="hidden" name="userId" value="{{ $user->id }}">
							<input type="hidden" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}" required>
							<input type="hidden" name="surname" placeholder="Surname" class="form-control" value="{{ $user->surname }}" required>
							<input type="hidden" name="phone" placeholder="Phone" class="form-control" value="{{ $user->phone }}" required>
							<input type="hidden" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}" required>
							
							<div class="form-group col-xs-6">
						            <div class='input-group date row' id='pickUpDate'>
						                    <input id="pickUp"  type='text' name="pickUp" class="form-control" placeholder="Pick Up Date" required/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
						            </div>

						            <div class="form-group col-xs-6">
						            <div class='input-group date row' id='dropOffDate'>
						                    <input id="dropOff" type='text' name="dropOff" class="form-control" placeholder="Drop Off Date" required/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
						            </div>

							<div id="form-button-container" class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
								<button type="submit" form="book" onclick=ga(‘send’,’event’,’Button’,’Click’,’NewClient’, '0') class="button-bounce btn btn-primary form-control rent-scooter">Book Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endif
	</div>

	@if(isset($booking))
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
	@endif

	@if(isset($user))
	<!-- Ban User Modal -->
	<div id="banUser" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Do you really want to ban this user ?</h4>
	      </div>
	      <div class="modal-body">
	        <form action="{{ url('/profile/'.$user->id.'/delete') }}" method="DELETE">
	        	<button type="submit" class="btn btn-danger">Yes</button>
	        	<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
	        </form>
	      </div>
	    </div>

	  </div>
	</div>
	@endif

	@if(isset($user) && !$user->signed && isset($document))
	<!-- Sign Modal -->
	<div id="signModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Please take a moment to read and sign</h4>
	      </div>
	      <div class="modal-body" style="box-shadow: 0px 0px 10px 0px rgba(0,0,0,.5) inset">
	        <div id="signContent" class="row" style="height: 550px; overflow-y: scroll;">
	        	<h4>{{ $document->name }}</h4>
	        	<div class="col-xs-10 col-xs-offset-1">
	        		{{ print($document->content) }}
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer" style="min-height: 150px">
	      	<p id="signInstructions" style="color: gray; font-size: 2em">Please read and scroll down to the end of the document before proceeding to signature</p>
	      	<form id="signForm" action="/confirm-booking" method="POST" class="hidden">
	      		{{ csrf_field() }}
	      		<input type="hidden" name="userId" value="{{ $user->id }}">
	      		<input type="hidden" name="documentId" value="{{ $document->id }}">
	      		@if(isset($bookingId))
	      			<input type="hidden" name="bookingId" value="{{ $bookingId }}">
	      		@endif
	      		<div class="form-group{{ $errors->has('signedName') ? ' has-error' : '' }}">
	      			@if ($errors->has('signedName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('signedName') }}</strong>
                        </span>
                    @endif

                    @if(Session::has('error'))
                    	<p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
			      	<p style="text-align: justify; font-size: 1em">
			      		<label for="signedName"> I, 
			      			<input type="text" name="signedName" id="signedName" placeholder="Name Surname" required>
			      		hereby acknowledge the fact that I read and accepted the aggreement between WeRideRentals.pty and I :
			      		</label>
			      		<p style="text-align: center">
			      			<input id="electronicSign" type="checkbox" name="electronicSign" required>
			      			<label for="electronicSign"><em>signature</em></label>	
			      		</p>
			      	</p>
		      	</div>
		      	<button id="signButton" type="submit" class="btn btn-primary btn-block">Sign</button>
		    </form>
		    <br>
		    <br>
		    @if(isset($user))
		    	<a href="/notSigned/{{$user->id}}" type="button" class="btn btn-danger btn-block">I don't want to sign this</a>
		    @else
		    	<a href="/notSigned" type="button" class="btn btn-danger btn-block">I don't want to sign this</a>
		    @endif
	      </div>
	    </div>

	  </div>
	</div>
	@endif
@stop

@section("scripts")
<script type="text/javascript">
			
			//SignModalActivation
			var userAuth = $('#userAuth');
	        if($('#signModal') !== null && userAuth.html() != 1){
	        	$('#signModal').modal('show');
	        }
	        //END

	        //Sign document scrolled
	        $('#signContent').on('scroll', function() {
		        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
		            $('#signInstructions').addClass('hidden');
		            $('#signForm').removeClass('hidden');
		      	}
		    });
	        //End

            $(function () {
                $('#pickUpDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#dropOffDate').datetimepicker({
                	format: "DD/MM/YYYY"
                });
                $('#expiry_date').datetimepicker({
                	format: "YYYY-MM-DD"
                });
                
                $('#date_of_birth').datetimepicker({
                	format: "YYYY-MM-DD"
                });
            });

            var inputs = document.getElementsByClassName('infoInputs');
            showButton = true;
        	var filled = false;
        	for (var i = inputs.length - 1; i >= 0; i--) {
        		var filled = false;
        		if(inputs[i].value != '' && inputs[i].value !== null && inputs[i].id != 'expiryDate'){
        			var filled = true;
        			var tick = document.createElement('span');
        			tick.className = 'glyphicon glyphicon-ok pull-right';
        			tick.style.color	= 'green';
        			$('#'+ inputs[i].name +'Label').append(tick);
        			$('#'+ inputs[i].name +'FormGroup').addClass('has-success');
        		}
        		else{
        			showButton = false;
        		}
        	}
        	if(showButton){
	            var confirmUserButton = document.createElement('button');
	            confirmUserButton.id = "confirmUser";
	            confirmUserButton.setAttribute('type','button');
	            confirmUserButton.className = "form-control btn btn-success btn-sm";
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

        	if($('#noExpiry').is(':checked')){
	        		$('#expiryDate').attr('disabled','');
	        		$('#expiryDate').attr('value','');
	        }
        	$('#noExpiry').click(function(){
	        	if($('#noExpiry').is(':checked')){
	        		$('#expiryDate').attr('disabled','');
	        		$('#expiryDate').attr('value','');
	        	} else {
	        		$('#expiryDate').removeAttr('disabled');
	        	}
	        });

</script>
@stop