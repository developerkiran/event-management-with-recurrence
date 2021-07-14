<!DOCTYPE html>
<html>
<head>
	<title>View All Event Lists</title>
</head>
<body>

	<div class="container">
		<div class="row">

			<?php

			if($this->session->flashdata('message')) {
				$message = $this->session->flashdata('message');
				?>
				<div class=""><?php echo $message; ?>

			</div>
			<?php
		}

		?>

		<div class="col-md-12">

			<h4>Event List Page</h4>
			<a href="<?php echo base_url('welcome/event_add'); ?>" class="btn btn-primary pull-right">Add New Event</a>
			<div class="table-responsive">


				<table id="mytable" class="table table-bordred table-striped">

					<thead>

						<th>#</th>
						<th>Title</th>
						<th>Start Date</th>
						<th>Action</th>

					</thead>
					<tbody>

						<?php 
						foreach ($events as $key => $value) { 
							$event_startdate=json_decode($value['event_start_date']);
							?>
							<tr>
								<td><input type="checkbox" class="checkthis" /></td>
								<td><?php echo $value['event_title']; ?></td>
								<td><?php echo $event_startdate[0]->date; ?></td>
								<td><p data-placement="top" data-toggle="tooltip" title="Edit">
									<a class="btn btn-primary btn-xs" href="<?php echo base_url('welcome/event_details/'.$value['event_id']); ?>"><span class="glyphicon glyphicon-eye-open"></span></a></p>
									<p data-placement="top" data-toggle="tooltip" title="Delete">
										<a onclick="return confirm('are you sure detele this event?')" href="<?php echo base_url('welcome/event_delete/'.$value['event_id']); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a></p>
									</td>
								</tr>
							<?php } ?>

						</tbody>

					</table>

					<div class="clearfix"></div>
					

				</div>

			</div>
		</div>
	</div>


	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control " type="text" placeholder="Mohsin">
					</div>
					<div class="form-group">

						<input class="form-control " type="text" placeholder="Irshad">
					</div>
					<div class="form-group">
						<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


					</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>



	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
				</div>
				<div class="modal-body">

					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>

</body>
</html>