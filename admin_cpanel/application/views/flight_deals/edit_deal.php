
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Flight Deals Management</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">	
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
</head>
<body id="top" oncontextmenu="return false" class="thebg page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flight_deals/"; ?>">Flight Deals Management</a></li>
				<li class="active"><strong>Edit Deals</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit a Deal
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."flight_deals/update_deal/".base64_encode(json_encode($deal[0]->flight_deals_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">	
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">From City</label>									
									<div class="col-sm-5">
										<input type="text" id="from_city" name="from_city" class="form-control" placeholder="Type Departure City" value="<?php echo $deal[0]->from_city; ?>" required />
										<input type="hidden" id="from_city_id" value="" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">To City</label>									
									<div class="col-sm-5">
										<input type="text" id="to_city"  name="to_city" class="form-control"  placeholder="Type Destination City" value="<?php echo $deal[0]->to_city; ?>" required />
										<input type="hidden" id="to_city_id" value="" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label for="field-5" class="col-sm-3 control-label">Check-in & Check-out Date</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control daterange" name="date_range" id="date_range" data-min-date="<?php echo date('m-d-Y');?>" value="<?php echo $deal[0]->departure_date."-".$deal[0]->return_date; ?>" data-validate="required" data-message-required="Please Select the Date Range" />

										<!--<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>-->
									</div>
								</div>
								<div class="form-group">
									<label for="field-6" class="col-sm-3 control-label">Price Offer</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-6" name="price_offer" placeholder="Price Offer" data-validate="required" value="<?php echo $deal[0]->price; ?>" data-message-required="Please enter the Offer Price">
									</div>
								</div>
								<div class="form-group">
									<label for="field-6" class="col-sm-3 control-label">Adult</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-6" name="adult" placeholder="Adult"  value="<?php echo $deal[0]->adult; ?>" data-validate="required,number" data-message-required="Please enter the Offer Price">
									</div>
								</div>
								<div class="form-group">
									<label for="field-6" class="col-sm-3 control-label">Child</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-6" name="child" placeholder="Child"  value="<?php echo $deal[0]->child; ?>" data-validate="number" data-message-required="Please enter the Offer Price">
									</div>
								</div>
								<div class="form-group">
									<label for="field-6" class="col-sm-3 control-label">Infant</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-6" name="infant" placeholder="Infant"  value="<?php echo $deal[0]->infant; ?>" data-validate="number" data-message-required="Please enter the Offer Price">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Airline</label>									
									<div class="col-sm-5">
										<select name="airline" class="select2" required>
											<option value=""/>
											<?php if($airline_list!=''){ for($ad=0;$ad<count($airline_list);$ad++){ ?>
											<option value="<?php echo $airline_list[$ad]->airline_code; ?>" <?php if($airline_list[$ad]->airline_code ==$deal[0]->airline){ echo "selected"; } ?> data-iconurl=""><?php echo $airline_list[$ad]->airline_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Image Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo site_url()."uploads/flight_deals/".$deal[0]->link; ?>" alt="Airline Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" value="<?php echo $deal[0]->link; ?>" name="deal_image" accept="image/*">
													<input type="hidden" value="<?php echo $deal[0]->link; ?>" name="deal_image_old">
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
											<input type="checkbox" name="deal_status" value="<?php echo $deal[0]->status; ?>" id="deals_status" <?php if($deal[0]->status == "ACTIVE"){ ?> checked <?php } ?> >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Deal Details</button>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
	<script>
		$(function(){
			$('#status').change(function(){
				var status = $('#status').val();
				if(status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});
			$("#from_city,#to_city").autocomplete({
				source: "<?php echo site_url(); ?>flight_deals/get_airports",
				minLength: 2, //search after two characters
				autoFocus: true, // first item will automatically be focused
			});
		});
	</script>
</body>
</html>
