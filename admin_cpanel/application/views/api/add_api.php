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
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."api/api_list"; ?>">API</a></li>
				<li class="active"><strong>Add New API</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New API
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."api/add_api"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">API Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="api_name" placeholder="API Name" data-validate="required" data-message-required="Please enter the API Name">
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
