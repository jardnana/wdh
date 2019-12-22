<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Country</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
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
				<li><a href="<?php echo site_url()."country/country_list"; ?>">Country List</a></li>
				<li class="active"><strong>Add New Country</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Country
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."country/update_country/".base64_encode(json_encode($country_list[0]->country_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Country Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="country_name" value="<?php echo $country_list[0]->country_name; ?>" data-validate="required" data-message-required="Please enter the Country Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Iso Code 2 Digit</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" maxlength="2" name="iso_code" value="<?php echo $country_list[0]->iso_code; ?>" data-validate="required" data-message-required="Please enter the Iso Code 2 Digit">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Iso Code 3 Digit</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-4" maxlength="3" name="iso3_code" value="<?php echo $country_list[0]->iso3_code; ?>" data-validate="required" data-message-required="Please enter the Iso Code 3 Digit">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Iso Numeric Code</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" name="iso_numeric" maxlength="2" value="<?php echo $country_list[0]->iso_numeric; ?>" data-validate="number" data-message-required="Please enter the Iso Numeric Code">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Phone Code</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-3" name="phone_code" value="<?php echo $country_list[0]->phone_code; ?>" data-validate="required,number" data-message-required="Please enter the proper Phone Code">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Currency Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" name="currency_name" value="<?php echo $country_list[0]->currency_name; ?>" data-validate="required" data-message-required="Please enter the Currency Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Currency Code</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" maxlength="3" name="currency_code" value="<?php echo $country_list[0]->currency_code; ?>" data-validate="required" data-message-required="Please enter the Currency Code">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Currency Symbol</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" name="currency_symbol" value="<?php echo $country_list[0]->currency_symbol; ?>" data-validate="" data-message-required="Please enter the Currency Symbol">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Country Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="country_status" value="<?php echo $country_list[0]->country_status; ?>" id="country_status" <?php if($country_list[0]->country_status =="ACTIVE"){ echo"checked"; } ?>>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Country Flag Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>uploads/country/<?php echo $country_list[0]->country_flag; ?>" alt="Country Flag">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" value="<?php echo $country_list[0]->country_flag; ?>" name="country_logo" accept="image/*">
													<input type="hidden" value="<?php echo $country_list[0]->country_flag; ?>" name="country_logo_old">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Country Details</button>
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
				var country_status = $('#country_status').val();
				if(current_status == "ACTIVE")
					$('#country_status').val('INACTIVE');
				else
					$('#country_status').val('ACTIVE');
			});
		});
	</script>
</body>
</html>
