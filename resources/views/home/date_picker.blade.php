<div class="row" style="border-bottom: 1px silver solid; padding: 50px 0px">
	<div class="col-xs-6 col-xs-offset-3">
		<form method="post" action="{{ url('/bookings') }}">
			{{ csrf_field() }}
			<div class="form-group col-xs-6">
				<label for="pick_up_date">
					Pick up date
				</label>
				<div class="input-group">
					<span class="input-group-addon glyphicon glyphicon-calendar"></span>
					<input type="date" class="form-control" name="pick_up_date" id="pick_up_date">
				</div>
			</div>
			<div class="form-group col-xs-6">
				<label for="drop_off_date">
					Drop off date
				</label>
				<div class="input-group">
					<span class="input-group-addon glyphicon glyphicon-calendar"></span>
					<input type="date" name="drop_off_date" id="drop_off_date" class="form-control">
				</div>
			</div>
			<div class="form-group col-md-4 col-md-offset-4" style="margin-top: 50px">
				<button class="btn btn-primary btn-lg" type="submit" id="rent-now">Rent now</button>
			</div>
		</form>
	</div>
</div>