
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Profile Info</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/icheck/skins/minimal/_all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/icheck/skins/square/_all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/icheck/skins/flat/_all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/icheck/skins/futurico/futurico.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/icheck/skins/polaris/polaris.css">
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		
		<div class="main-content">		
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
				<hr />
				<h1 class="margin-bottom">Profile Info</h1>
				<ol class="breadcrumb 2">
					<li><a href="<?php echo site_url()."dashboard/index"; ?>"><i class="entypo-home"></i>Home</a></li>
					<li class="active"><strong>Profile</strong></li>
				</ol><br />
				<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="<?php echo site_url('dashboard/update_profile_info');?>">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">Personal Information</div>									
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>
								<div class="panel-body">						
									<div class="form-group">
										<label for="field-1" class="col-sm-2 control-label">Admin Name</label>
										<?php $fullName = explode("-",$admin_profile_info->admin_name); ?>
										<div class="col-sm-1">
											<select name="salution" id="field-sal" class="selectboxit">
												<option value="Mr." <?php if($fullName[0]== "Mr."){ echo "selected"; } ?>>Mr.</option>
												<option value="Mrs." <?php if($fullName[0]== "Mrs."){ echo "selected"; } ?>>Mrs.</option>
												<option value="Miss" <?php if($fullName[0]== "Miss"){ echo "selected"; } ?>>Miss</option>
												<option value="Ms."  <?php if($fullName[0]== "Ms."){ echo "selected"; } ?>>Ms.</option>
												<option value="Dr." <?php if($fullName[0]== "Dr."){ echo "selected"; } ?>>Dr.</option>
												<option value="Prof." <?php if($fullName[0]== "Prof."){ echo "selected"; } ?>>Prof.</option>
												<option value="Rev." <?php if($fullName[0]== "Rev."){ echo "selected"; } ?>>Rev.</option>
												<option value="Other" <?php if($fullName[0]== "Other"){ echo "selected"; } ?>>Other</option>
											</select>
										</div>
										<div class="col-sm-3"><input type="text"  class="form-control" id="field-f" name="first_name" value="<?php if(isset($fullName[1])){ echo $fullName[1]; } ?>" placeholder="First Name" data-validate="required" data-message-required="Please enter first name"></div>
										<div class="col-sm-3"><input type="text"  class="form-control" id="field-m" name="middle_name" value="<?php if(isset($fullName[2])){ echo $fullName[2]; } ?>"></div>
										<div class="col-sm-3"><input type="text"  class="form-control" id="field-l" name="last_name" value="<?php if(isset($fullName[3])){ echo $fullName[3]; } ?>" placeholder="Last Name" data-validate="required" data-message-required="Please enter last name"></div>
									</div>
					
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">Account Number</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" name="account_number" value="<?php echo $admin_profile_info->admin_account_number; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">Email</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" name="email" value="<?php echo $admin_profile_info->admin_email; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label for="field-3" class="col-sm-2 control-label">Phone Number</label>										
										<div class="col-sm-5">
											<input type="text" class="form-control" name="home_phone" id="field-3" data-validate="required" value="<?php echo $admin_profile_info->admin_home_phone; ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-4" class="col-sm-2 control-label">Mobile Number</label>										
										<div class="col-sm-5">
											<input type="text" class="form-control" name="cell_phone" id="field-4" data-validate="required" value="<?php echo $admin_profile_info->admin_cell_phone; ?>">
										</div>
									</div>									
								</div>							
							</div>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">							
							<div class="panel panel-primary" data-collapsed="0">							
								<div class="panel-heading">
									<div class="panel-title">Address Details</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">Address</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" name="address" value="<?php echo $admin_profile_info->address; ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">City Name</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" data-validate="required" name="city_name" value="<?php echo $admin_profile_info->city_name; ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">State</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" data-validate="required" name="state_name" value="<?php echo $admin_profile_info->state_name; ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">Country</label>
										<div class="col-sm-5">
											<select name="country" class="selectboxit">
												<?php for($c=0;$c<count($country);$c++){ ?>
												<option value="<?php echo $country[$c]->country_id; ?>" <?php if($admin_profile_info->country_id == $country[$c]->country_id){ echo "selected"; } ?> data-iconurl=""><?php echo $country[$c]->country_name." (".$country[$c]->iso3_code.")"; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>					
									<div class="form-group">
										<label for="field-2" class="col-sm-2 control-label">ZipCode</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" data-validate="required" name="zip_code" value="<?php echo $admin_profile_info->zip_code; ?>">
										</div>
									</div>											
								</div>								
							</div>						
						</div>
					</div>
					<div class="form-group default-padding">
						<input type="submit" class="btn btn-success" value="Save Changes">
						<input type="reset" class="btn" value="Reset Previous">
					</div>							
				</form>	
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
		<?php $this->load->view('general/chat');	?>	
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/icheck/icheck.min.js"></script>
	<script>
		jQuery(document).ready(function($)
		{
			var icheck_skins = $(".icheck-skins .color_theme");
			icheck_skins.click(function(ev)	{
				ev.preventDefault();
				$(this).toggleClass('current');
			});
		});
	</script>
</body>
</html>
