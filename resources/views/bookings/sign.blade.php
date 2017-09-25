@extends('layouts.main')

@section('content')
	<!-- Sign Modal -->
	<div id="signModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Please take a moment to read and sign</h4>
	      </div>
	      <div class="modal-body" style="box-shadow: 0px 0px 10px 0px rgba(0,0,0,.5) inset">
	        <div id="signContent" style="height: 550px; overflow-y: scroll;">
	        	<p style="text-align: justify; font-size: 16px">
	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	        		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	        		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	        	</p>
	        	<p>
	        		BOTTOM
	        	</p>
	        </div>
	      </div>
	      <div class="modal-footer" style="min-height: 150px">
	      	<p id="signInstructions" style="color: gray; font-size: 2em">Please read and scroll down to the end of the document before proceeding to signature</p>
	      	<form id="signForm" action="/confirm-booking" method="POST" class="hidden">
	      		{{ csrf_field() }}
	      		<input type="hidden" name="userId" value="{{ $user->id }}">
	      		<input type="hidden" name="bookingId" value="{{ $bookingId }}">
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
			      			<input id="electronicSign" type="checkbox" name="electronicSign" value="checked" required>
			      			<label for="electronicSign"><em>signature</em></label>	
			      		</p>
			      	</p>
		      	</div>
		      	<button id="signButton" type="submit" class="btn btn-primary btn-block">Sign</button>
		    </form>
		    <br>
		    <br>
		    <a class="btn btn-danger btn-block" href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    I don't want to sign this
            </a>
	      </div>
	    </div>

	  </div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		//SignModalActivation
	        if($('#signModal') !== null){
	        	$('#signModal').modal({
	        	  backdrop: 'static',	
				  keyboard: false,
				}).modal('show');
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
	</script>
@stop