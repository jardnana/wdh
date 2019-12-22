<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | FLIGHT LIST</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body  id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flight/flight_list"; ?>">FLIGHT CRS</a></li>
				<li class="active"><strong>FLIGHT List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."flight/add_flight"; ?>">Add New FLIGHT</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Journey Type</th>
							<th>From City</th>
							<th>To City</th>
							<th>Departure Date</th>
							<th>Return Date</th>
							<th>Adult</th>
							<th>Child</th>
							<th>Infant</th>
							<th>Airline</th>
							<th>Class</th>
							<th>Number of Seats</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Journey Type</th>
							<th>From City</th>
							<th>To City</th>
							<th>Departure Date</th>
							<th>Return Date</th>
							<th>Adult</th>
							<th>Child</th>
							<th>Infant</th>
							<th>Airline</th>
							<th>Class</th>
							<th>Number of Seats</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(!empty($result_view)) {  $count = 1;
												foreach($result_view as $key => $value) { ?>
											<tr>
                        						<td><?php echo $count; ?></td>
												<td><?php echo $value->journey_type; ?></td>
												<td><?php echo $value->departure_city; ?></td>
												<td><?php echo $value->arrival_city; ?></td>
												<td><?php echo $value->departure_date; ?></td>
												<td><?php echo $value->return_date; ?></td>
												<td><?php echo $value->adult; ?></td>
												<td><?php echo $value->child; ?></td>
												<td><?php echo $value->infant; ?></td>	
												<td><?php foreach($airline_list as $airlinevalue) { 
												 if($value->airline == $airlinevalue->airline_code) {
												 echo $airlinevalue->airline_name; } } ?></td>							
												<td><?php if($value->cabin_class == "All") { echo $value->cabin_class; }
												elseif ($value->cabin_class == "F")  { echo "First, Supersonic"; }
												elseif ($value->cabin_class == "C")  { echo "Business"; }
												elseif ($value->cabin_class == "Y")  { echo "Economic"; }
												elseif ($value->cabin_class == "W")  { echo "Premium Economy"; }
												else { echo "Standard Economy"; }?></td>
												<td><?php echo $value->number_of_seats;?></td>
												<td>
													<?php if($value->status == "ACTIVE"){ ?>
														<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
													<?php }else{ ?>
															<button type="button" class="btn btn-red btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
													<?php } ?>
							                    </td>
												<td class="center">
													<?php if($value->status == "ACTIVE"){ ?>
														<a href="<?php echo site_url()."flight/update_flight_status/".base64_encode(json_encode($value->flight_id))."/0"; ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
													<?php }else{ ?>
														<a href="<?php echo site_url()."flight/update_flight_status/".base64_encode(json_encode($value->flight_id))."/1"; ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
													<?php } ?>
													<a href="<?php echo site_url()."flight/edit_flight/".base64_encode(json_encode($value->flight_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
													<a href="<?php echo site_url()."flight/delete_flight/".base64_encode(json_encode($value->flight_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
													<a href="<?php echo site_url()."flight/flight_segments/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id))."/".base64_encode(json_encode($value->journey_type)); ?>" class="btn btn-blue btn-icon icon-left"><i class="entypo-check"></i>Manage Segment</a>
													<a href="<?php echo site_url()."flight/flight_pricing/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id)); ?>" class="btn btn-green btn-icon icon-left"><i class="entypo-check"></i>Pricing Management</a>
												</td>
											</tr>		
					<?php $count ++; } } ?>											
					</tbody> 
				</table>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Chat Module -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			var table = $("#api_list").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
		});		
	</script>
</body>
</html>
