<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Roles</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."roles/roles_list"; ?>">Roles</a></li>
				<li class="active"><strong>Roles List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."roles/add_roles"; ?>">Add New Roles</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="roles_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Name</th>
							<th>Logo</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Name</th>
							<th>Logo</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($roles_list!=''){ for($a=0;$a<count($roles_list);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $roles_list[$a]->role_name; ?></td>
							<?php if($roles_list[$a]->role_logo !=''){ ?>
								<td class="center"><img src="<?php echo base_url(); ?>uploads/roles/<?php echo $roles_list[$a]->role_logo; ?>" alt="Roles Logo" width="100" height="50"></td>
							<?php }else{ ?>	
								<td class="center"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Roles Logo" width="100" height="50"></td>
							<?php } ?>	
							<td>
								<?php if($roles_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								
								<a href="<?php echo site_url()."roles/edit_roles/".base64_encode(json_encode($roles_list[$a]->role_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>	
								<?php if($roles_list[$a]->role_details_id == 1){ }else{ ?>
									<a href="<?php echo site_url()."privilege/privilegeInfo/".base64_encode(json_encode($roles_list[$a]->role_details_id)); ?>" class="btn btn-success"><?php echo "ManagePrivilege"; ?></a>
									<a href="<?php echo site_url()."roles/delete_roles/".base64_encode(json_encode($roles_list[$a]->role_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
										<?php if($roles_list[$a]->status == "ACTIVE"){ ?>
										<a href="<?php echo site_url()."roles/inactive_roles/".base64_encode(json_encode($roles_list[$a]->role_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
									<?php }else{ ?>
										<a href="<?php echo site_url()."roles/active_roles/".base64_encode(json_encode($roles_list[$a]->role_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
									<?php } ?>
								<?php }  ?>
							</td>
						</tr>
					<?php }} ?>												
					</tbody>
				</table>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
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
			var table = $("#roles_list").dataTable({
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
