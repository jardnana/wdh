<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Flight CRS Segment Management</title>	
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
				<li><a href="<?php echo site_url()."flight/flight_list"; ?>">FLIGHT</a></li>
				<li class="active"><strong>Flight CRS Segment List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."flight/add_flight_segments/".base64_encode(json_encode($flight_id))."/".base64_encode(json_encode($flight_crs_id))."/".base64_encode(json_encode($trip_type)); ?>">Add Segments</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						
						<tr>
							<th>Sl No</th>
							<th>Trip Type</th>
							<th>Segment Type</th>
							<th>Flight Name</th>
							<th>Flight Equipment</th>
							<th>Flight Number</th>
							<th>From City</th>
							<th>To City</th>
							<th>Marketing Airline</th>
							<th>operating Airline</th>
							<th>Booking Code</th>
							<th>Departure Time(onward)</th>
							<th>Return Time(onward)</th>
							<th>Marriage Group</th>
							<th>Departure Time Zone</th>
							<th>Return Time Zone</th>
							<th>ETicket</th>
							<th>Seats Remaining</th>
							<th>Cabin</th>
                            <th>Meal</th>
							<th>Non Refundable</th>
							<th>Weight Allowance</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Trip Type</th>
							<th>Segment Type</th>
							<th>Flight Name</th>
							<th>Flight Equipment</th>
							<th>Flight Number</th>
							<th>From City</th>
							<th>To City</th>
							<th>Marketing Airline</th>
							<th>operating Airline</th>
							<th>Booking Code</th>
							<th>Departure Time(onward)</th>
							<th>Return Time(onward)</th>
							<th>Marriage Group</th>
							<th>Departure Time Zone</th>
							<th>Return Time Zone</th>
							<th>ETicket</th>
							<th>Seats Remaining</th>
							<th>Cabin</th>
                            <th>Meal</th>
							<th>Non Refundable</th>
							<th>Weight Allowance</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(!empty($flight_segments)) {  $count = 1;
												foreach($flight_segments as $key => $segments) { ?>
												<?php //echo '<pre>'; print_r($segments); ?>
											<tr>
                        						<td><?php echo $count; ?></td>
                        						<td><?php echo ucfirst($segments->journey_type); ?></td>
                        						<td><?php echo ucfirst($segments->segment_type); ?></td>
												<td><?php foreach($airline_list as $airlinevalue) { 
												 if($segments->flight_name == $airlinevalue->airline_code) {
												 echo $airlinevalue->airline_name; } } ?></td>	
												<td><?php echo strtoupper($segments->Equipment); ?></td>
												<td><?php echo $segments->FlightNumber_no;?></td>
												<td><?php echo $segments->OriginLocation;?></td>
												<td><?php echo $segments->DestinationLocation;?></td>
												<td><?php foreach($airline_list as $airlinevalue) { 
												 if($segments->MarketingAirline == $airlinevalue->airline_code) {
												 echo $airlinevalue->airline_name; } } ?></td>
												 <td><?php foreach($airline_list as $airlinevalue) { 
												 if($segments->OperatingAirline == $airlinevalue->airline_code) {
												 echo $airlinevalue->airline_name; } } ?></td>
												<td><?php echo strtoupper($segments->ResBookDesigCode);?></td>
												<td><?php echo $segments->DepartureDateTime;?></td>
												<td><?php echo $segments->ArrivalDateTime;?></td>
												<td><?php echo $segments->MarriageGrp;?></td>
												<td><?php echo $segments->DepartureTimeZone;?></td>
												<td><?php echo $segments->ArrivalTimeZone;?></td>
												<td><?php echo $segments->eTicket;?></td>
												<td><?php echo $segments->SeatsRemaining;?></td>
												<td><?php if($segments->Cabin == "All") { echo $segments->Cabin; }
												elseif ($segments->Cabin == "F")  { echo "First, Supersonic"; }
												elseif ($segments->Cabin == "C")  { echo "Business"; }
												elseif ($segments->Cabin == "Y")  { echo "Economic"; }
												elseif ($segments->Cabin == "W")  { echo "Premium Economy"; }
												else { echo "Standard Economy"; }?></td>
												<td><?php echo strtoupper($segments->Meal);?></td>
												<td><?php echo $segments->nonRefundable;?></td>
												<td><?php echo $segments->Weight_Allowance;?></td>
												<td>
													<?php if($segments->status == "ACTIVE"){ ?>
														<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
													<?php }else{ ?>
															<button type="button" class="btn btn-red btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
													<?php } ?>
							                    </td>
												<td class="center">
													<?php if($segments->status == "ACTIVE"){ ?>
														<a href="<?php echo site_url()."flight/update_flight_segment_status/".base64_encode(json_encode($segments->flight_segments_id))."/0/".base64_encode(json_encode($segments->flight_id))."/".base64_encode(json_encode($segments->flight_crs_id))."/".base64_encode(json_encode($segments->journey_type)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
													<?php }else{ ?>
														<a href="<?php echo site_url()."flight/update_flight_segment_status/".base64_encode(json_encode($segments->flight_segments_id))."/1/".base64_encode(json_encode($segments->flight_id))."/".base64_encode(json_encode($segments->flight_crs_id))."/".base64_encode(json_encode($segments->journey_type)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
													<?php } ?>
													<a href="<?php echo site_url()."flight/edit_flight_segment/".base64_encode(json_encode($segments->flight_segments_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
													<a href="<?php echo site_url()."flight/delete_flight_segment/".base64_encode(json_encode($segments->flight_segments_id))."/".base64_encode(json_encode($segments->flight_id))."/".base64_encode(json_encode($segments->flight_crs_id))."/".base64_encode(json_encode($segments->journey_type)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>													
												</td>
												
												
						<!-- <td class="center">
		
                            
                          <a href="<?php echo site_url()."flight_crs/edit_pricing/$value->flight_id" ?>">
				            <button type="button" class="btn btn-blue tooltip-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Edit Price Management"><i class="glyphicon glyphicon-edit"></i></button>
				          </a>
                          <a href="<?php echo site_url();?>flight_crs/delete_flightpricing/<?php echo $value->flight_id ?>" data-original-title="Delete"  onclick="return confirm('Do you want delete this record');" class="btn btn-danger btn-xs has-tooltip" data-original-title="Delete"> 
                            <i class="glyphicon glyphicon-remove"></i>
                          </a>
                          
						</td>
							
					</tr>	 -->	
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
