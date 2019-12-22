<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Change Password</title>	
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
				<li class="active"><strong>Change Password</strong></li>
			</ol>
			<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="<?php echo site_url('dashboard/update_password'); ?>">
				<div class="row">
					<div class="col-md-6">							
						<div class="panel panel-primary" data-collapsed="0">							
							<div class="panel-heading">
								<div class="panel-title">Admin Details</div>
								<div class="panel-options">
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-4">
									<div class="panel-body">
										<div class="form-group">
											<?php if($admin_profile_info->admin_profile_pic!=''){ ?>
												<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Profile Pic"/>
											<?php }else{ ?>
												<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Profile Pic"/>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="col-md-8">
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-5 control-label"><strong>Name : </strong></label>										
										<label class="col-sm-6" style="padding-top: 7px;"><?php echo str_replace("-"," ",$admin_profile_info->admin_name); ?></label>	
									</div>					
									<div class="form-group">
										<label class="col-sm-5 control-label"><strong>Account Number : </strong></label>										
										<label class="col-sm-6" style="padding-top: 7px;"><?php echo $admin_profile_info->admin_account_number; ?></label>	
									</div>					
									<div class="form-group">
										<label class="col-sm-5 control-label"><strong>Email : </strong></label>										
										<label class="col-sm-6" style="padding-top: 7px;"><?php echo $admin_profile_info->admin_email; ?></label>	
									</div>					
									<div class="form-group">
										<label class="col-sm-5 control-label"><strong>Created On : </strong></label>										
										<label class="col-sm-6" style="padding-top: 7px;"><?php echo $admin_profile_info->admin_creation_date_time; ?></label>	
									</div>					
								</div>
							</div>							
							</div>						
						</div>						
					</div>
					<div class="col-md-6">
						<div class="panel panel-primary minhigh" data-collapsed="0">
							<div class="panel-heading">
								<div class="panel-title">Change Password Settings</div>
								<div class="panel-options">
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								</div>
							</div>								
							<div class="panel-body">					
								<div class="col-sm-12">
									<div class="form-group">
										<label for="field-5" class="col-sm-3 control-label">Currrent Password</label>										
										<div class="col-sm-7">
											<input type="text" class="form-control" name="current_password" id="field-op" data-validate="required" >
										</div>
									</div>
									<div class="form-group">
										<label for="field-5" class="col-sm-3 control-label">New Password</label>										
										<div class="col-sm-7">
											<div class="input-group gropdis">
												<script src="<?php echo base_url(); ?>assets/js/pwdwidget.js"></script>
												<div class='pwdwidgetdiv' id='thepwddiv'></div>
												<script  type="text/javascript" >
													var pwdwidget = new PasswordWidget('thepwddiv','new_password');
													pwdwidget.MakePWDWidget();
												</script>
												<noscript><span class="input-group-addon"><i class="entypo-lock"></i></span><input type="password" class="form-control" placeholder="Password" data-validate="required" name="new_password" id="new_password" onBlur="check_password_status(this.value)" /></noscript>
											</div>
										</div>
									</div>										
									<div class="form-group">
										<label for="field-5" class="col-sm-3 control-label">Confirm Password</label>										
										<div class="col-sm-7">
											<input type="password" class="form-control" name="confirm_password" id="confirm_password" data-validate="required" >
										</div>
									</div>										
									<div class="form-group">
										<?php if($status == 1){ ?><label class="col-sm-7 control-label"><span style="color:#00C40A">Successfully Password Changed</span></label>
										<?php }else if($status == 2){ ?><label class="col-sm-7 control-label"><span style="color:#C41417">Failed</span></label>
										<?php }else if($status == 3){ ?><label class="col-sm-7 control-label"><span style="color:#C41417">Incorrect Old Password</span></label>
										<?php }else if($status == 4){ ?><label class="col-sm-7 control-label"><span style="color:#C41417">Password Mismatch</span></label><?php } ?>
										<div class="col-sm-5 pull-right">
											<button type="submit" class="btn btn-success">Update Password</button>
										</div>
									</div>										
								</div>
							</div>							
						</div>
					</div>
				</div>
			</form>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<?php $this->load->view('general/load_js');	?>
</body>
</html>
