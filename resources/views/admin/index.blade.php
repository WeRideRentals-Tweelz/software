@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
	<div class="panel panel-default col-sm-10 col-sm-offset-1">
		<div class="panel-heading row">
			<h1><span class="gold">B</span>ookings </h1>
		</div>
		<div class="panel-body row">
			<div id="panel-body-height">
				<div class="col-sm-5">
					<div id="dayList"></div>
				</div>
				<div class="col-sm-6 col-sm-offset-1">
					<div id="monthCalendar"></div>
				</div>
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
          <table class="table table-striped table-hover table-condensed">
          <tr>
          	<td>Booking Number : </td><td id="modalId"></td>
          </tr>
          <tr>
          	<td>Start : </td><td id='modalStart'></td>
          </tr>
          <tr>
          	<td>End : </td><td id='modalEnd'></td>
          </tr>
          <tr>	
          	<td>Scooter : </td><td id="modalScooter"></td>
          </tr>
          </table>
          <h5 id="modalBookingLink"></h5>
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
	  	@if($booking->user_id != 0)
	  		<span class="bookingUserId">{{ $booking->user->id }}</span>
	  		<span class="bookingUser">{{ $booking->user->surname }} {{ $booking->user->name }}</span>
	  	@else
	  		<span class="bookingUser">No User</span>
	  	@endif
	  	<span class="bookingPickUp">{{ $booking->pick_up_date }}</span>
	  	<span class="bookingDropOff">{{ $booking->drop_off_date }}</span>
	  	@if($booking->scooter_id != 0)
	  		<span class="bookingScooter">{{ $booking->scooter->model }}</span>
	  	@else
	  		<span class="bookingScooter">No scooter</span>
	  	@endif
	  </div>
	  @endforeach

	  <!-- Bonds -->
	  @foreach($bonds as $bond)
	  <div class="bonds hidden">
	  	<span class="bookingNumber">{{ $bond['bookingNumber'] }}</span>
	  	<span class="bondDate">{{ $bond['bondDate'] }}</span>
	  	<span class="bondName">{{ $bond['bondName'] }}</span>
	  </div>
	  @endforeach
	  
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		// Get Hidden Bookings informations to store into javascript variables then pushed into array for calendar
		var pickups = [];
		var dropoffs = [];
		var bonds = [];

		$(".bookings").each(function(booking){
			var eventId = $(this).find('.bookingId').html();
			var eventUserId = $(this).find('.bookingUserId').html();
			var eventUser = $(this).find('.bookingUser').html();
			var eventPickUp = $(this).find('.bookingPickUp').html();
			var eventDropOff = $(this).find('.bookingDropOff').html();
			var eventScooter = $(this).find('.bookingScooter').html();

			var title = "<p><a href='/user/"+eventUserId+"'>"+eventUser+"</a> - <a href='/bookings/"+eventId+"/edit' class='btn btn-primary'>Booking</a></p>";

			var pickup = {id: eventId, start: eventPickUp, in: eventPickUp, out: eventDropOff, title: eventId+"-"+eventUser, user: eventUser, userId: eventUserId,scooter: eventScooter,allDay: true, color: "green", type: "Pick Up"};
			pickups.push(pickup);

			var dropoff = {id: eventId, start: eventDropOff, in: eventPickUp, out: eventDropOff, title: eventId+"-"+eventUser, user: eventUser, userId: eventUserId,scooter: eventScooter, allDay: true, color: "orange", type: "Drop Off"};
			dropoffs.push(dropoff);
		});

		$('.bonds').each(function(bond){
			var bondBookingNumber = $(this).find('.bookingNumber').html();
			var bondDate = $(this).find('.bondDate').html();
			var bondName = $(this).find('.bondName').html();

			var bond = {id: bondBookingNumber, title: bondBookingNumber+" - "+bondName, date: bondDate, allDay: true, color:"purple", type: "Bond"};
			bonds.push(bond); 
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
					dropoffs,
					bonds
				],
				eventRender: function(event, element){
					if(event.type  != "Bond"){
						if(event.user == "No User"){
							title = "<tr class='fc-list-item-time fc-widget-content'><td>"+event.type+"</td><td class='fc-list-item-marker fc-widget-content'><span class='fc-event-dot' style='background-color:"+event.color+"'></span></td><td class='fc-list-item-title fc-widget-content'>"+event.user+" - <a href='/bookings/"+event.id+"/edit' class='btn btn-info btn-xs' style='color:white'>"+event.id+"</a></td><tr>";
						} else {
							title = "<tr class='fc-list-item-time fc-widget-content'><td>"+event.type+"</td><td class='fc-list-item-marker fc-widget-content'><span class='fc-event-dot' style='background-color:"+event.color+"'></span></td><td class='fc-list-item-title fc-widget-content'><a href='/user/"+event.userId+"'>"+event.user+"</a> - <a href='/bookings/"+event.id+"/edit' class='btn btn-info btn-xs' style='color:white'>"+event.id+"</a></td><tr>";
						}
					} else {
						title = "<tr class='fc-list-item-time fc-widget-content'><td>"+event.type+"</td><td class='fc-list-item-marker fc-widget-content'><span class='fc-event-dot' style='background-color:"+event.color+"'></span></td><td class='fc-list-item-title fc-widget-content'><a href='/user/"+event.id+"'>Bond Refund</a> <a href='/bookings/"+event.id+"/edit' class='btn btn-info btn-xs' style='color:white'>"+event.id+"</a></td><tr>";
					}
					return title;
				},
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
				dropoffs,
				bonds
			],
			firstDay: 1,
			defaultTimedEventDuration: "00:30",
			// Show booking details when click on event
			eventClick: function(event,view){
				if(event.type != 'Bond'){
					var url = '<a href="/user/'+event.userId+'/">'+event.title+'</a>';
					var bookingUrl = '<a href="/bookings/'+event.id+'/edit" class="btn btn-info">See Booking Details</a>';
					$("#modalTitle").html(url);
				} else {
					var bookingUrl = '<a href="/bookings/'+event.id+'/payBond" class="btn btn-info">Pay Bond</a> <a href="/bookings/'+event.id+'/payBondFinancial" class="btn btn-success">Pay Bond and enter it in financial history</a>';
					$('#modalTitle').text('Bond Refund for Booking N°'+event.id);
				}
					var format = "D MMMM YYYY";
					
					$("#modalId").text(event.id);
					if(event.details === null){
						$("#modalText").text("");
					}else{
						$("#modalText").text(event.details);
					}
					$("#modalStart").text(moment(event.in).format(format));
					$("#modalEnd").text(moment(event.out).format(format));	
					$("#modalScooter").text(event.scooter);
					$('#modalBookingLink').html(bookingUrl);
					$("#myModal").modal();	
			}
	    	});
	});
</script>
@stop