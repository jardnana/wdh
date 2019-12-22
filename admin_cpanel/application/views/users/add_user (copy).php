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
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."users/users_list"; ?>">Users</a></li>
				<li class="active"><strong>Add New User</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New User
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">
							<form id="rootwizard-2" method="post" action="" class="form-wizard form-horizontal form-groups-bordered validate" enctype= "multipart/form-data"> 
								<div class="steps-progress"><div class="progress-indicator"></div></div>									
								<ul>
									<li class="active"><a href="#tab2-1" data-toggle="tab"><span>1</span>User Info</a></li>
									<li><a href="#tab2-2" data-toggle="tab"><span>2</span>Address Info</a></li>
									<li><a href="#tab2-3" data-toggle="tab"><span>3</span>User Type Management</a></li>
									<li><a href="#tab2-4" data-toggle="tab"><span>4</span>Domain Managemnt</a></li>
									<li><a href="#tab2-5" data-toggle="tab"><span>5</span>Product Management</a></li>
									<li><a href="#tab2-6" data-toggle="tab"><span>5</span>Api Management</a></li>
								</ul>									
								<div class="tab-content">
									<div class="tab-pane active" id="tab2-1">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Domain</label>									
											<div class="col-sm-5">
												<select name="doamin" class="selectboxit">
													<option value="TEST" data-iconurl="">TEST</option>
													<option value="CERTIFICATION" data-iconurl="">CERTIFICATION</option>
													<option value="DEVELOPMENT" data-iconurl="">DEVELOPMENT</option>
													<option value="LIVE" data-iconurl="">LIVE</option>
												</select>
											</div>
										</div>
										<div class="form-group">
														<label for="field-2" class="col-sm-3 control-label">API Name Alternative</label>									
														<div class="col-sm-5">
															<input type="text" class="form-control" id="field-2" name="api_name_alternative" placeholder="API Name Alternative" data-validate="required" data-message-required="Please enter the API Name Alternative">
														</div>
													</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">API Username</label>									
											<div class="col-sm-5">
												<input type="text" class="form-control" id="field-4" name="api_user_name" placeholder="API Username" data-validate="required" data-message-required="Please enter the API Username">
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">API Username1</label>									
											<div class="col-sm-5">
												<input type="text" class="form-control" name="api_user_name1" placeholder="API Username1" >
											</div>
										</div>
										<div class="form-group">
											<label for="field-3" class="col-sm-3 control-label">API URL</label>									
											<div class="col-sm-5">
												<input type="text" class="form-control" id="field-3" name="api_url" placeholder="API URL" data-validate="required,url" data-message-required="Please enter the proper API URL">
											</div>
										</div>
										<div class="form-group">
											<label for="field-3" class="col-sm-3 control-label">API URL1</label>									
											<div class="col-sm-5">
												<input type="text" class="form-control" name="api_url1" placeholder="API URL1" >
											</div>
										</div>
										<div class="form-group">
											<label for="field-3" class="col-sm-3 control-label">API Password</label>									
											<div class="col-sm-5">
												<input type="text" class="form-control" name="api_password" placeholder="API Password" data-validate="required" data-message-required="Please enter the API Password">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">API Mode</label>									
											<div class="col-sm-5">										
												<select name="api_mode" class="selectboxit">
													<option value="TEST" data-iconurl="">TEST</option>
													<option value="CERTIFICATION" data-iconurl="">CERTIFICATION</option>
													<option value="DEVELOPMENT" data-iconurl="">DEVELOPMENT</option>
													<option value="LIVE" data-iconurl="">LIVE</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">API Status</label>									
											<div class="col-sm-5">
												<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
													<input type="checkbox" name="api_status" value="ACTIVE" id="api_status" checked>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">API Logo Upload</label>									
											<div class="col-sm-5">										
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" data-trigger="fileinput">
														<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="API Logo">
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail"></div>
													<div>
														<span class="btn btn-white btn-file">
															<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="api_logo" accept="image/*">
														</span>
														<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
												</div>										
											</div>
										</div>
									</div>
																		
									<div class="tab-pane" id="tab2-2">
										<div class="row">
											Need to Update Address information
										</div>
									</div>
									
									<div class="tab-pane" id="tab2-3">
										<div class="row">
											Need to Update Usert Type information
										</div>
									</div>
									
									<div class="tab-pane" id="tab2-4">
										<div class="row">
											Need to Update Domain information
										</div>											
									</div>
									
									<div class="tab-pane" id="tab2-5">
										<div class="row">
											Need to Update Product information
										</div>	
									</div>
									
									
									<div class="tab-pane" id="tab2-6">
										<div class="form-group">
											<label class="col-sm-3 control-label">&nbsp;</label>									
											<div class="col-sm-5">
												<button type="submit" class="btn btn-success">Add API Details</button>
											</div>
										</div>
									</div>
									
									<ul class="pager wizard">
										<li class="previous">
											<a href="#"><i class="entypo-left-open"></i> Previous</a>
										</li>
										
										<li class="next">
											<a href="#">Next <i class="entypo-right-open"></i></a>
										</li>
									</ul>

								</div>

							</form>							
							<form method="post" action="<?php echo site_url()."users/add_user"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								
								
								
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
			$('#domain_status').change(function(){
				var current_status = $('#domain_status').val();
				if(current_status == "ACTIVE")
					$('#domain_status').val('INACTIVE');
				else
					$('#domain_status').val('ACTIVE');
			});
		});
	</script>
</body>
</html>
