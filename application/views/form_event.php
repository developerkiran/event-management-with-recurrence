<!DOCTYPE html>
<html>
<head>
	<title>Add Event</title>
</head>
<body>

	<a href="<?php echo base_url(); ?>" class="btn btn-primary">Back to event list</a>
	<form class="form-horizontal" name="frmcreateevent" id="frmcreateevent" method="post" action="javascript:void(0)" enctype="multipart/form-data">
		<fieldset>

			<!-- Form Name -->
			<legend>Event Form</legend>

			<!-- Event Title-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="event_title">Event Title</label>  
				<div class="col-md-4">
					<input id="event_title" name="event_title" type="text" placeholder="Event Title" class="form-control input-md">

				</div>
			</div>

			<!-- Event Start Date-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="start_date">Start Date</label>  
				<div class="col-md-4">
					<input id="start_date" name="start_date" type="text" placeholder="Start Date" class="form-control input-md">
				</div>
			</div>

			<!-- Recurrence-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="recurrence">Recurrence</label>  
				<div class="col-md-4">
					<span style="font-size: 10pt; font-family: Verdana"><b>Repeat Every</b></span>
					<input type="number"  name="number" value="1" size="10" style="width: 30px;">
					<select id="repeatEvery" class="form-control textbox-medium" name="repeatEvery" id="repeatEvery" tabindex="10">
						<option selected="selected" value="day">Day</option>
						<option value="week">Week</option>
						<option value="month">Month</option>
						<option value="year">Year</option>
					</select> 
				</div>
			</div>

			<div class="form-group" id="week_event" style="display: none">
				<label class="col-md-4 control-label" for="checkboxes">Repeat on</label>
				<div class="col-md-4">
					<div class="checkbox">
						<label for="checkboxes-0">
							<input type="checkbox" name="day[]" id="checkboxes-0" value="sun">
							Sun
							
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="mon">
							mon
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="tue">
							tue
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="wed">
							wed
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="thur">
							thur
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="fri">
							fri
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="checkbox" name="day[]" id="checkboxes-1" value="sat">
							sat
						</label>
					</div>

				</div>
			</div>
			<!-- Multiple Checkboxes -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="checkboxes">End</label>
				<div class="col-md-4">
					<div class="checkbox">
						<label for="checkboxes-0">
							<input type="radio" name="event_end" id="checkboxes-0" value="on">
							On
							<input id="end_date" name="end_date" type="text" placeholder="End Date" class="form-control input-md">
						</label>
					</div>
					<div class="checkbox">
						<label for="checkboxes-1">
							<input type="radio" name="event_end" id="checkboxes-1" value="after" checked="">
							After

							<input id="occurrences" name="occurrences" type="number" placeholder="" value="1" class="form-control input-md">Occurrences

						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right">Save Event</button>
			</div>
		</fieldset>
	</form>


	<script type="text/javascript">
		$(function() {
			$('#start_date,#end_date').datetimepicker();
		});
	</script>

	<script type="text/javascript">
		$(document).on('submit','#frmcreateevent',function(e){

			$('#frmcreateevent').validate({
				rules:{
					event_title:{required:true},
					start_date:{required:true},
					'day[]':{required:true}
				},
				messages : {
					event_title:{required:"required event title"},
					start_date:{required:"required start date"},
					'day[]':{required:"select atleast one day"}

				},

			});


			if($('#frmcreateevent').valid()){
				var data=new FormData($('#frmcreateevent')[0]);
				$.ajax({
					type:'post',
					data:data,
					dataType:"json",
					processData: false,
					contentType: false,
					cashe:false,
					url:"<?php echo base_url('welcome/submit_event'); ?>",
					success:function(result){
						if(result.status==200){
							alert(result.message);
							window.location.href ='<?php echo base_url('welcome');?>';
						}
						
					}
				});

			}
		});



		$(document).ready(function(){
			$("#repeatEvery").change(function(){
				var selected = $(this).val();
				if (selected == 'week') {
					$('#week_event').show();
				} else {
					$('#week_event').hide();
				}
			});
		});

	</script>
</body>
</html>