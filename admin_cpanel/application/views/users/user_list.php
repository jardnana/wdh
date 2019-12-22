<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Users</title>	
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
				<li><a href="<?php echo site_url()."users/user_list"; ?>">USERS</a></li>
				<li class="active"><strong>Users List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."users/add_user"; ?>">Add New User</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="user_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Actions</th>
							<!--<th>Domain Name</th>
							<th>User Type</th>
							<th>Product</th>
							<th>API</th>
							<th>Country</th>-->
							<th>Name</th>
							<th>Email</th>
							<!--<th>Account No</th>
							<th>Address</th>-->
							<th>Phone No</th>
							<th>Mobile No</th>
							<th>Profile Pic</th>
							<th>Status</th>
							<!--<th>User Management</th>-->							
						</tr>
						<tr>
							<td class="user-management" colspan="1">User Management</td>
							<td class="user-actions" colspan="1">Actions</td>
							<td class="user-info-details" colspan="6">User Information</td>							
						</tr>
						<tr class="replace-inputs">
							<th class="user-management">Sl No</th>
							<th class="user-actions">Actions</th>
							<!--<th class="user-management">Domain Name</th>
							<th class="user-management">User Type</th>
							<th class="user-management">Product</th>
							<th class="user-management">API</th>
							<th class="user-management">Country</th>-->
							<th class="user-info-details">Name</th>
							<th class="user-info-details">Email</th>
							<!--<th class="user-info-details">Account No</th>
							<th class="user-info-details">Address</th>-->
							<th class="user-info-details">Phone No</th>
							<th class="user-info-details">Mobile No</th>
							<th class="user-info-details">Profile Pic</th>
							<th class="user-info-details">Status</th>
							<!--<th class="user-actions">User Management</th>-->
							
						</tr>
					</thead>
					<tbody>
					<?php if($user_list['user_info']!=''){ for($a=0;$a<count($user_list['user_info']);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td class="center">
								<a href="<?php echo site_url()."users/active_users/".base64_encode(json_encode($user_list['user_info'][$a]->user_details_id)); ?>"> <button type="button" class="btn btn-success tooltip-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Active"><i class="glyphicon glyphicon-ok"></i></button></a>
								<a href="<?php echo site_url()."users/inactive_users/".base64_encode(json_encode($user_list['user_info'][$a]->user_details_id)); ?>"><button type="button" class="btn btn-orange tooltip-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="InActive"><i class="glyphicon glyphicon-eye-open"></i></button></a>
								<a href="<?php echo site_url()."users/edit_users/".base64_encode(json_encode($user_list['user_info'][$a]->user_details_id)); ?>"><button type="button" class="btn btn-blue tooltip-primary btn-sm" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></button></a>				
								<a href="<?php echo site_url()."booking/orders_by_user/".base64_encode(json_encode($user_list['user_info'][$a]->user_details_id)); ?>"><button type="button" class="btn btn-default tooltip-primary btn-sm" data-placement="top" data-toggle="tooltip" data-original-title="View Booking"><i class="glyphicon glyphicon-th-list"></i></button></a>				
								<a href="<?php echo site_url()."users/send_email/".base64_encode(json_encode($user_list['user_info'][$a]->user_details_id)); ?>"><button type="button" class="btn btn-gold tooltip-primary btn-sm" data-placement="top" data-toggle="tooltip" data-original-title="Send Email"><i class="glyphicon glyphicon-envelope"></i></button></a>				
								<a data-toggle='modal' href='#modal-example2<?= $c; ?>' role='button'><button type="button" class="btn btn-black tooltip-primary btn-sm" data-placement="top" data-toggle="tooltip" data-original-title="Send Promo Code"><i class="glyphicon glyphicon-send"></i></button></a>	
							</td>
							<td><?php echo str_replace("-", " ", $user_list['user_info'][$a]->first_name); ?></td>
							<td><?php echo $user_list['user_info'][$a]->user_email; ?></td>
							<!--<td><?php //echo $user_list['user_info'][$a]->user_account_number; ?></td>-->
							<!--<td><?php echo $user_list['user_info'][$a]->address.", ".$user_list['user_info'][$a]->city_name."<br/>".$user_list['user_info'][$a]->city_name.", ".$user_list['user_info'][$a]->state_name.", ".$user_list['user_info'][$a]->country_name."-".$user_list['user_info'][$a]->zip_code; ?></td>-->
							<td><?php echo $user_list['user_info'][$a]->user_home_phone; ?></td>
							<td><?php echo $user_list['user_info'][$a]->user_cell_phone; ?></td>
							<td class="center"><img src="<?php echo base_url(); ?>uploads/users/<?php echo $user_list['user_info'][$a]->user_profile_pic; ?>" alt="Profile Pic" width="100%" height="100"></td>
							<td>
								<?php if($user_list['user_info'][$a]->user_status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left action-details1"">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-red btn-icon icon-left action-details1"">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>							
							
						</tr>
					<?php } } ?>												
					</tbody>
				</table>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
	</div>
	<div class='modal fade' id='modal-example2<?= $c; ?>' tabindex='-1'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
					<h4 class='modal-title' id='myModalLabel'>Send Promo Code</h4>
				</div>
				<div class='modal-body'>																					
					<form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo site_url()."users/send_user_promo/".$user_list['user_info'][0]->user_details_id; ?>">
						<div class='form-group'>
							<label class="control-label" for="">Choose Any One Promo </label>
							<?php $i = 1; foreach ($promo as $promos) { ?>
						   <br>
								<div class='radio'>
									<label>
										<input type='radio' data-rule-required='true' id="validation_promo<?= $c . $i; ?>" name="promoid" value='<?php echo $promos->promo_code_details_id; ?>'><?php echo $promos->promo_code; ?> - <em><?php echo $promos->discount; ?>% discount, valid upto <?php echo date('M j,Y', strtotime($promos->exp_date)); ?></em>
										</label>
									</div>
									<?php $i++; } ?>
								</div>
			  
							<div class='modal-footer'>
								<button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
								<button class='btn btn-primary' type='submit'>Send</button>
							</div>
						</form>
					</div>
				</div>
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
			var table = $("#user_list").dataTable({
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
