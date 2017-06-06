@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="panel panel-default col-sm-8 col-sm-offset-2">
		<div class="panel-heading row">
			<h1><span class="gold">B</span>ookings </h1>
		</div>
		<div class="panel-body row">
			<div class="col-sm-4 col-sm-offset-1">
				<div id="dayList"></div>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<div id="monthCalendar"></div>
			</div>
		</div>
	</div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modalTitle"></h4>
        </div>
        <div class="modal-body">
          <p id="modalText"></p>
          <ul>
          	<li>Start : <span id='modalStart'></span></li>
          	<li>End : <span id='modalEnd'></span></li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Bookings -->
  @foreach($bookings as $booking)
  <div class="bookings hidden">
  	<span class="bookingId">{{ $booking->id }}</span>
  	<span class="bookingUserId">{{ $booking->user->id }}</span>
  	<span class="bookingUser">{{ $booking->user->name }}</span>
  	<span class="bookingPickUp">{{ $booking->pick_up_date }}</span>
  	<span class="bookingDropOff">{{ $booking->drop_off_date }}</span>
  </div>
  @endforeach
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		// Get Hidden Bookings informations to store into javascript variables then pushed into array for calendar
		var pickups = [];
		var dropoffs = [];
		$(".bookings").each(function(booking){
			var eventId = $(this).find('.bookingId').html();
			var eventUserId = $(this).find('.bookingUserId').html();
			var eventUser = $(this).find('.bookingUser').html();
			var eventPickUp = $(this).find('.bookingPickUp').html();
			var eventDropOff = $(this).find('.bookingDropOff').html();

			var pickup = {id: eventId, start: eventPickUp, in: eventPickUp, out: eventDropOff, title: eventUser, userId: eventUserId,allDay: true, color: "green"};
			pickups.push(pickup);

			var dropoff = {id: eventId, start: eventDropOff, in: eventPickUp, out: eventDropOff, title: eventUser, userId: eventUserId, allDay: true, color: "orange"};
			dropoffs.push(dropoff);
		});

		// List Calendar of bookings
    		$('#dayList').fullCalendar({
    			header:{
	    			left: "",
	    			center: "",
	    			right: ""
	    		},
	    		firstDay: 1,
	    		defaultView: "listWeek",
	    		eventSources: [
				pickups,
				dropoffs
			],
    		});

    		// MonthCalendar of bookings
	    	$('#monthCalendar').fullCalendar({
	    		header:{
	    			left: "",
	    			center: "title",
	    			right: "prev next"
	    		},
	    		defaultView: "month",
			eventSources: [
				pickups,
				dropoffs
			],
			firstDay: 1,
			defaultTimedEventDuration: "00:30",
			// Show booking details when click on event
			eventClick: function(event,view){
				var format = "D MMMM YYYY";
				var url = '<a href="/profile/'+event.userId+'/">'+event.title+'</a>';

				$("#modalTitle").html(url);
				if(event.details === null){
					$("#modalText").text("");
				}else{
					$("#modalText").text(event.details);
				}
				$("#modalStart").text(moment(event.in).format(format));
				$("#modalEnd").text(moment(event.out).format(format));	
				$("#myModal").modal();
			}
	    	});
	});
</script>
@stop