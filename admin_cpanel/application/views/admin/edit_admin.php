<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Edit Admin</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
		
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
				<li><a href="<?php echo site_url()."admin/admin_list"; ?>">Admin</a></li>
				<li class="active"><strong>Edit User</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit Admin
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">
							<form id="rootwizard" action="<?php echo site_url()."admin/update_admin/".base64_encode(json_encode($admin_list['admin_info'][0]->admin_id)); ?>" method="post" class="form-wizard form-horizontal form-groups-bordered validate" enctype= "multipart/form-data" >
								<div class="steps-progress"><div class="progress-indicator"></div></div>
								<ul>
									<li class="active"><a href="#tab_admin" data-toggle="tab"><span>1</span>Admin Info</a></li>
									<li ><a href="#tab_address" data-toggle="tab"><span>2</span>Address Info</a></li>
									<li ><a href="#tab_roles" data-toggle="tab"><span>3</span>Roles Info</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_admin">
										<div class="form-group">
											<label for="field-2" class="col-sm-3 control-label">Full Admin Name</label>	
											<?php $fullName = explode("-",$admin_list['admin_info'][0]->admin_name); ?>								
											<div class="col-sm-2">
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
											<div class="col-sm-2">
												<input type="text" class="form-control" id="field-f" name="first_name" value="<?php if(isset($fullName[1])){ echo $fullName[1]; } ?>" placeholder="First Name" data-validate="required" data-message-required="Please enter the First Name">
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" id="field-m" name="middle_name" value="<?php if(isset($fullName[2])){ echo $fullName[2]; } ?>" placeholder="Middle Name" >
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" id="field-l" name="last_name" value="<?php if(isset($fullName[3])){ echo $fullName[3]; } ?>" placeholder="Last Name" >
											</div>
										</div>
										<div class="form-group" id="userEmailGroup">
											<label class="col-sm-3 control-label">Email</label>											
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-mail"></i></span>
													<input type="text" class="form-control" id="field-e" name="email_id" value="<?php echo $admin_list['admin_info'][0]->admin_email; ?>" readonly>
												</div>
												<span id="userEmail" class="spanValidation"></span>
											</div>
										</div>
										<!-- <div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Password</label>									
											<div class="col-sm-5">
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
										<div class="form-group" id="confirm_password_Group">
											<label for="field-1" class="col-sm-3 control-label">Confirm Password</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-lock"></i></span>
													<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" data-validate="required" data-message-required="Please enter the Confirm Password" onBlur="check_password_status(this.value)">
												</div>
												<span id="userpasswrod" class="spanValidation"></span>
											</div>
										</div> -->
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Phone Number</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-phone"></i></span>
													<input type="text" class="form-control" id="field-p" name="phone_no" value="<?php echo $admin_list['admin_info'][0]->admin_home_phone ?>" placeholder="Phone Number" data-validate="number" data-message-required="Please enter the Phone Number">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Mobile Number</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-mobile"></i></span>
													<input type="text" class="form-control" name="mobile_no" value="<?php echo $admin_list['admin_info'][0]->admin_cell_phone ?>" placeholder="Mobile Number" data-validate="required,number" data-message-required="Please enter the Mobile Number">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Admin Status</label>									
											<div class="col-sm-5">
												<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
													<input type="checkbox" name="admin_status" value="value="<?php echo $admin_list['admin_info'][0]->admin_status; ?>"" id="admin_status" <?php if($admin_list['admin_info'][0]->admin_status == "ACTIVE"){ echo "checked"; } ?>>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Admin Profile Upload</label>									
											<div class="col-sm-5">										
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" data-trigger="fileinput">
														<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $admin_list['admin_info'][0]->admin_profile_pic; ?>" alt="API Logo">
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail"></div>
													<div>
														<span class="btn btn-white btn-file">
															<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="admin_profile" accept="image/*">
															<input type="hidden" name="user_profile_old" value="<?php echo $admin_list['admin_info'][0]->admin_profile_pic; ?>">
														</span>
														<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
												</div>										
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab_address">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Address</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-doc-text-inv"></i></span>
													<input type="text" class="form-control" id="field-address" name="address" value="<?php echo $admin_list['admin_info'][0]->address ?>" placeholder="Address" data-validate="required" data-message-required="Please enter the Address" />
													<input type="hidden" name="address_id" value="<?php echo $admin_list['admin_info'][0]->address_details_id ?>"/>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">City</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-address"></i></span>
													<input type="text" class="form-control" id="field-city" name="city" placeholder="City" data-validate="required" value="<?php echo $admin_list['admin_info'][0]->city_name ?>" data-message-required="Please enter the City">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">State Name</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-address"></i></span>
													<input type="text" class="form-control" id="field-state" name="state_name" placeholder="State Name" value="<?php echo $admin_list['admin_info'][0]->state_name ?>" data-validate="required" data-message-required="Please enter the State Name">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Zip Code</label>									
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><i class="entypo-address"></i></span>
													<input type="text" class="form-control" id="field-zipcode" name="zip_code" value="<?php echo $admin_list['admin_info'][0]->zip_code ?>" placeholder="Zip Code" data-validate="required" data-message-required="Please enter the Zip Code" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Country</label>									
											<div class="col-sm-5">
												<select name="country" class="selectboxit">
													<?php for($c=0;$c<count($country);$c++){ ?>
													<option value="<?php echo $country[$c]->country_id; ?>" <?php if($admin_list['admin_info'][0]->country_id == $country[$c]->country_id){ echo "selected"; } ?> data-iconurl=""><?php echo $country[$c]->country_name." (".$country[$c]->iso3_code.")"; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="tab-pane" id="tab_roles">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Roles</label>									
											<div class="col-sm-5">
												<select name="role_id" class="select2" required>
													<?php for($a=0;$a<count($admin_type);$a++){ ?>
													<option value="<?php echo $admin_type[$a]->role_details_id; ?>" <?php if($admin_list['admin_info'][0]->role_name == $admin_type[$a]->role_name){ echo "selected"; } ?> data-iconurl=""><?php echo $admin_type[$a]->role_name;; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">&nbsp;</label>									
											<div class="col-sm-5">
												<button type="submit" class="btn btn-success">Update Admin Details</button>
											</div>
										</div>
									</div>
									<ul class="pager wizard">
										<li class="previous first"><a href="#">First</a></li>
										<li class="previous"><a href="#"><i class="entypo-left-open"></i> Previous</a></li>
										<li class="next"><a href="#">Next <i class="entypo-right-open"></i></a></li>
									</ul>
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
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.wizard.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script>
		$(function(){
			$('#admin_status').change(function(){
				var admin_status = $('#admin_status').val();
				if(admin_status == "ACTIVE")
					$('#admin_status').val('INACTIVE');
				else
					$('#admin_status').val('ACTIVE');
			});
		});
		function checkUniqueEmail(email){
			var sEmail = document.getElementById('field-e');
			if (sEmail.value != ''){
				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if(!(sEmail.value.match(filter))){
					$("#emailidflag").val("false");
					return false; 
				}else{
					$('#userEmail').html('<img src="<?php echo base_url(); ?>assets/images/loader-2.gif") />');
					$.ajax({ 
					  url: "<?php echo site_url(); ?>users/check_unique_email/"+email,
					  success: function(data){
							if (data != '' || data != undefined || data != null) {				   
								if(data == '<span class="success" style="color: green;">valid</span>'){
									$("#emailidflag").val("true");
									$('#userEmail').html('');
									$("#userEmailGroup").removeClass( "form-group validate-has-error" ).addClass("form-group " );
								}else{
									$("#emailidflag").val("false");
									$("#userEmailGroup").removeClass( "form-group" ).addClass("form-group validate-has-error" );
									$('#userEmail').html(data);
								}
							}		 
						}      
					});
				}
			}
			return false;
		}
		function check_password_status(userpassword)
		{
			if(userpassword != ''){
				$('#userpasswrod').html('<img src="<?php echo base_url(); ?>assets/images/loader-2.gif") />');
				var data = {}
				data['new_password'] 		= $( "#new_password_text_id").val();
				data['useridflag'] 			= $( "#useridflag").val();
				data['confirm_password'] 	= $( "#confirm_password").val();
				if(data['new_password'] !=''){
					if(data['confirm_password'] != ''){
						if(data['new_password'] != data['confirm_password']){
							$('#userpasswrod').html('<span class="nosuccess">Wrong Password</span>');
							$("#confirm_password_Group").removeClass( "form-group" ).addClass("form-group validate-has-error" );
							return false;
						}else{
							$('#userpasswrod').html('<span class="success">Valid Password</span>');
							$("#confirm_password_Group").removeClass( "form-group validate-has-error" ).addClass("form-group" );
						}
					}
				}else{
					$('#userpasswrod').html('<span class="nosuccess">Wrong Password</span>');
					$("#confirm_password_Group").removeClass( "form-group" ).addClass("form-group validate-has-error" );
					return false;
				}
			}else{
				$('#userpasswrod').html('');
				$("#confirm_password_Group").removeClass( "form-group validate-has-error" ).addClass("form-group" );
			}
		}
	
	</script>
</body>
</html>
