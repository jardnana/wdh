<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Today's Top Deal</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
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
				<li><a href="<?php echo site_url()."todaydeals/deal_list/".$category_id; ?>">Today's Top Deals</a></li>
				<li class="active"><strong>Add New Deal</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Deal
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."todaydeals/add_deal/".$category_id; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Domain</label>									
										<div class="col-sm-5">
											<select name="domain" class="select2" required>
												<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
												<option value="<?php echo $domain[$d]->domain_details_id; ?>" data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
													<?php }} ?>
											</select>
										</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Hotel Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" name="hotel_name" placeholder="Hotel Name" data-validate="required" data-message-required="Please enter the Hotel Name">
									</div>
								</div>
								
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">City Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" name="city_name" id="city_autopopulate" placeholder="City Name" data-validate="required" value="" data-message-required="Please enter the City Name">
									</div>
								</div>								
								<div class="form-group">
									<label for="field-5" class="col-sm-3 control-label">Check-in & Check-out Date</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control daterange" name="date_range" id="date_range" data-min-date="<?php echo date('m-d-Y');?>" data-validate="required" data-message-required="Please Select the Date Range" />

										<!--<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>-->
									</div>
								</div>								
								<div class="form-group">
									<label for="field-6" class="col-sm-3 control-label">Price Offer</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-6" name="price_offer" placeholder="Price Offer" data-validate="required" data-message-required="Please enter the Offer Price">
									</div>
								</div>
								<div class="form-group">
									<label for="field-7" class="col-sm-3 control-label">Link</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-7" name="link" placeholder="Link">
									</div>
								</div>
								<div class="form-group">
									<label for="field-8" class="col-sm-3 control-label">Position</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-8" name="position" placeholder="Position" data-validate="required" data-message-required="Please enter the Position">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Image Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>assets/images/logo@2x.png" alt="Hoter Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="hotel_image" accept="image/*">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="deals_status" value="ACTIVE" id="deals_status" checked>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Deal</button>
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
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
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
