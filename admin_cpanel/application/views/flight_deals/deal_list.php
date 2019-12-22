<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Flight Deals Management</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flight_deals"; ?>">Flight Deals Management</a></li>
				<li class="active"><strong>Flight Deals List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."flight_deals/add_deal/"; ?> ">Add New Deal</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="city_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>From Place</th>
							<th>To Place</th>
							<th>Checkin Date</th>
							<th>Checkout Date</th>
							<th>Deal Image</th>
							<th>Offered Price</th>
							<th>Adult</th>
							<th>Child</th>
							<th>Infant</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>From Place</th>
							<th>To Place</th>
							<th>Checkin Date</th>
							<th>Checkout Date</th>
							<th>Deal Image</th>
							<th>Offered Price</th>
							<th>Adult</th>
							<th>Child</th>
							<th>Infant</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						
					<?php if($deals_list!=''){ for($a=0;$a<count($deals_list);$a++){ 
						$table_id = 'flight_deals_id';
						?>
						
						<tr>
							<td><?php echo $deals_list[$a]->$table_id;?></td>
							<td><?php echo $deals_list[$a]->from_city; ?></td>
							<td><?php echo $deals_list[$a]->to_city; ?></td>
							<td><?php echo $deals_list[$a]->departure_date; ?></td>
							<td><?php echo $deals_list[$a]->return_date; ?></td>
							
							<td>
								<?php if($deals_list[$a]->link !=''){ ?> <img width="100" height="50" src="<?php echo base_url(); ?>uploads/flight_deals/<?php echo $deals_list[$a]->link; ?>" alt="Deal Image"><?php } else{ ?>
								<img width="100" height="50" src="http://c.fareportal.com/n/common/air/ai/<?php echo $deals_list[$a]->airline; ?>.gif" alt="Deal Image"/><?php } ?>
							</td>
							<td><?php echo $deals_list[$a]->price; ?></td>
							<td><?php echo $deals_list[$a]->adult; ?></td>
							<td><?php echo $deals_list[$a]->child; ?></td>
							<td><?php echo $deals_list[$a]->infant; ?></td>
							<td>
								<?php if($deals_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($deals_list[$a]->status == "ACTIVE"){ ?>
						<a href="<?php echo site_url()."flight_deals/inactive_deal/".base64_encode(json_encode($deals_list[$a]->$table_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."flight_deals/active_deal/".base64_encode(json_encode($deals_list[$a]->$table_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."flight_deals/edit_deal/".base64_encode(json_encode($deals_list[$a]->$table_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."flight_deals/delete_deal/".base64_encode(json_encode($deals_list[$a]->$table_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
						</tr>
					<?php } } ?>												
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
			var table = $("#city_list").dataTable({
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
