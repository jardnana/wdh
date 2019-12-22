<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Admin Login Log's</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li class="active"><strong>Admin Log Activity List</strong></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="activity_logs">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Attempt</th>
							<th>IP Address</th>
							<th>Browser</th>
							<th>IP|PORT</th>
							<th>Date/Time</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Attempt</th>
							<th>IP Address</th>
							<th>Browser</th>
							<th>IP|PORT</th>
							<th>Date/Time</th>
						</tr>
					</thead>
					<tbody>
					<?php if($logs_activity!=''){ for($p=0;$p<count($logs_activity);$p++){ ?>
						<tr>
							<td><?php echo ($p+1); ?></td>
							<td><?php echo $logs_activity[$p]->login_attempt_type; ?></td>
							<td><?php echo $logs_activity[$p]->login_track_details_ip; ?></td>
							<td><?php echo $logs_activity[$p]->login_track_status_info; ?></td>
							<td><?php echo $logs_activity[$p]->login_track_details_system_info; ?></td>
							<td><?php echo $logs_activity[$p]->login_tracking_details_time_stamp; ?></td>
						</tr>
					<?php }} ?>												
					</tbody>
				</table>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			var table = $("#activity_logs").dataTable({
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
