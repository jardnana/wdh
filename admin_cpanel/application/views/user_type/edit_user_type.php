<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | API</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> sidebar-collapsed">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."usertype"; ?>">User Type</a></li>
				<li class="active"><strong>Edit User Type List</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit User Type
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."usertype/update_user_type/".$user_type[0]->user_type_id; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="user_type_name" value="<?php echo $user_type[0]->user_type_name; ?>" data-validate="required" data-message-required="Please enter the User Type Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">API Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="<?php echo $user_type[0]->status; ?>" id="status" <?php if($user_type[0]->status == "ACTIVE"){ ?> checked <?php } ?> >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add API Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
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
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script>
		$(function(){
			$('#status').change(function(){
				var status = $('#status').val();
				if(status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});
		});
	</script>
</body>
</html>
