<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Privilege</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> sidebar-collapsed">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."privilege/privilege_list"; ?>">Privilege</a></li>
				<li class="active"><strong>Privileges List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."privilege/add_privilege"; ?>">Add New Privilege</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="privilege_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Name</th>
							<th>UserName</th>
							<th>UserName1</th>
							<th>URL</th>
							<th>URL1</th>
							<th>Password</th>
							<th>Mode</th>
							<th>Logo</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Name</th>
							<th>UserName</th>
							<th>UserName1</th>
							<th>URL</th>
							<th>URL1</th>
							<th>Password</th>
							<th>Mode</th>
							<th>Logo</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($privilege_list!=''){ for($a=0;$a<count($privilege_list);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $privilege_list[$a]->api_name." (".$privilege_list[$a]->api_alternative_name.")"; ?></td>
							<td><?php echo $privilege_list[$a]->api_username; ?></td>
							<td><?php echo $privilege_list[$a]->api_username1; ?></td>
							<td><?php echo $privilege_list[$a]->api_url; ?></td>
							<td><?php echo $privilege_list[$a]->api_url1; ?></td>
							<td><?php echo $privilege_list[$a]->api_password; ?></td>
							<td><?php echo $privilege_list[$a]->api_credential_type; ?></td>
							<td class="center"><img src="<?php echo base_url(); ?>uploads/privilege/<?php echo $privilege_list[$a]->api_logo; ?>" alt="Domain Logo" width="100" height="50"></td>
							<td>
								<?php if($privilege_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-red btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($privilege_list[$a]->status == "ACTIVE"){ ?>
									<a href="<?php echo site_url()."privilege/inactive_privilege/".$privilege_list[$a]->privilege_details_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."privilege/active_privilege/".$privilege_list[$a]->privilege_details_id; ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."privilege/edit_privilege/".$privilege_list[$a]->privilege_details_id; ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."privilege/delete_privilege/".$privilege_list[$a]->privilege_details_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
						</tr>
					<?php }} ?>												
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
			var table = $("#privilege_list").dataTable({
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
