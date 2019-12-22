<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Flight CRS Pricing Management</title>	
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
				<li class="active"><strong>Flight CRS Pricing List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."flight/add_flight_pricing/".base64_encode(json_encode($flight_id))."/".base64_encode(json_encode($flight_crs_id))."/".base64_encode(json_encode($trip_type)); ?>">Add Price</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						
						<tr>
							<th>Sl No</th>
							<th>Currency</th>
							<th>Adult Price</th>
							<th>Adult Tax</th>
							<th>Adult Total Fare</th>
							<th>Child Price</th>
							<th>Child Tax</th>
							<th>Child Total Fare</th>
							<th>Infant Price</th>
							<th>Infant Tax</th>
							<th>Infant Total Fare</th>
							<th>Fare Basis Code</th>
							<th>Fare Rules</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Currency</th>
							<th>Adult Price</th>
							<th>Adult Tax</th>
							<th>Adult Total Fare</th>
							<th>Child Price</th>
							<th>Child Tax</th>
							<th>Child Total Fare</th>
							<th>Infant Price</th>
							<th>Infant Tax</th>
							<th>Infant Total Fare</th>
							<th>Fare Basis Code</th>
							<th>Fare Rules</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(!empty($price_flight)) {  $count = 1;
												foreach($price_flight as $key => $value) { ?>
											<tr>
                        						<td><?php echo $count; ?></td>
                        						<td><?php foreach($currency_list as $currencyvalue) { 
												 if($value->base_currency == $currencyvalue->currency_code) {
												 echo $currencyvalue->currency_name; } } ?></td>
												<td><?php echo $value->adult_base_fare; ?></td>
												<td><?php echo $value->adult_total_tax; ?></td>
												<td><?php echo $value->adult_total_fare; ?></td>
												<td><?php echo $value->child_base_fare;?></td>
												<td><?php echo $value->child_total_tax;?></td>
												<td><?php echo $value->child_total_fare;?></td>
												<td><?php echo $value->infant_base_fare; ?></td>
												<td><?php echo $value->infant_total_tax; ?></td>
												<td><?php echo $value->infant_total_fare; ?></td>
												<td><?php echo $value->fare_basis_code; ?></td>
												<td><?php echo $value->fare_rules; ?></td>
												<td>
													<?php if($value->status == "ACTIVE"){ ?>
														<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>							
													<?php }else{ ?>
															<button type="button" class="btn btn-red btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
													<?php } ?>
							                    </td>
												<td class="center">
													<?php if($value->status == "ACTIVE"){ ?>
														<a href="<?php echo site_url()."flight/update_flight_price_status/".base64_encode(json_encode($value->flight_price_details_id))."/0/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
													<?php }else{ ?>
														<a href="<?php echo site_url()."flight/update_flight_price_status/".base64_encode(json_encode($value->flight_price_details_id))."/1/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
													<?php } ?>
													<a href="<?php echo site_url()."flight/edit_flight_price/".base64_encode(json_encode($value->flight_price_details_id))."/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
													<a href="<?php echo site_url()."flight/delete_flight_price/".base64_encode(json_encode($value->flight_price_details_id))."/".base64_encode(json_encode($value->flight_id))."/".base64_encode(json_encode($value->flight_crs_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>													
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
