<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Markup</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
</head>
<body  id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."markup"; ?>">Markup</a></li>
				<li class="active"><strong>Add New Markup</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Markup
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."markup/update_markup/".base64_encode(json_encode($markup[0]->markup_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type</label>									
									<div class="col-sm-5">
										<select name="user_type" class="select2" required>
											<?php if($user_type!=''){ for($a=0;$a<count($user_type);$a++){ ?>
											<option value="<?php echo $user_type[$a]->user_type_id; ?>" <?php if($user_type[$a]->user_type_id == $markup[0]->user_type_id){ echo "selected"; } ?> data-iconurl=""><?php echo $user_type[$a]->user_type_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Domain</label>									
									<div class="col-sm-5">
										<select name="domain" class="select2" required>
											<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
											<option value="<?php echo $domain[$d]->domain_details_id; ?>" <?php if($domain[$d]->domain_details_id == $markup[0]->domain_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Product</label>									
									<div class="col-sm-5">
										<select name="product" class="select2" required>
											<?php if($product!=''){ for($p=0;$p<count($product);$p++){ ?>
											<option value="<?php echo $product[$p]->product_details_id; ?>" <?php if($product[$p]->product_details_id == $markup[0]->product_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $product[$p]->product_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">API</label>									
									<div class="col-sm-5">
										<select name="api" class="select2" required>
											<?php if($api!=''){ for($a=0;$a<count($api);$a++){ ?>
											<option value="<?php echo $api[$a]->api_details_id; ?>" <?php if($api[$a]->api_details_id == $markup[0]->api_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_credential_type.")"; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select onchange="makup_type_details(this.value)" name="markup_type" class="select2" required>
											<option value="GENERAL" <?php if($markup[0]->markup_type =="GENERAL"){ echo "selected"; } ?> data-iconurl="">GENERAL</option>
											<option value="SPECIFIC" <?php if($markup[0]->markup_type =="SPECIFIC"){ echo "selected"; } ?> data-iconurl="">SPECIFIC</option>
										</select>
									</div>
								</div>
								<div id="specific">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Journey Type</label>									
										<div class="col-sm-5">
											<select name="journey_type" class="select2" >
												<option value="ALL" <?php if($markup[0]->journey_type =="ALL"){ echo "selected"; } ?> data-iconurl="">ALL</option>
												<option value="ONEWAY" <?php if($markup[0]->journey_type =="ONEWAY"){ echo "selected"; } ?> data-iconurl="">ONEWAY</option>
												<option value="ROUNDTRIP" <?php if($markup[0]->journey_type =="ROUNDTRIP"){ echo "selected"; } ?> data-iconurl="">ROUNDTRIP</option>
												<option value="MULTICITY" <?php if($markup[0]->journey_type =="MULTICITY"){ echo "selected"; } ?> data-iconurl="">MULTICITY</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Country</label>									
										<div class="col-sm-5">
											<select name="country" class="select2">
												<option value="">Please Select Specific Country</option>
												<?php if($country!=''){ for($p=0;$p<count($country);$p++){ ?>
												<option value="<?php echo $country[$p]->country_id; ?>" <?php if($country[$p]->country_id == $markup[0]->country_id){ echo "selected"; } ?> data-iconurl=""><?php echo $country[$p]->country_name; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Airline</label>									
										<div class="col-sm-5">
											<select name="airline" class="select2">
												<option value="">Please Select Airline</option>
												<?php if($airline!=''){ for($ad=0;$ad<count($airline);$ad++){ ?>
												<option value="<?php echo $airline[$ad]->airline_details_id; ?>" <?php if($airline[$ad]->airline_details_id ==$markup[0]->airline_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $airline[$ad]->airline_name; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>	
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Value %age</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-mv" name="markup_value" value="<?php echo $markup[0]->markup_value; ?>" data-message-required="Please enter the Markup Value">
									</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Markup Value Fixed</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-mf" name="markup_fixed" value="<?php echo $markup[0]->markup_fixed; ?>"  data-message-required="Please enter the Markup Fixed">
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-3 control-label">Markup Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="ACTIVE" id="status" <?php if($markup[0]->status =="ACTIVE"){ echo "checked"; } ?>>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Markup Details</button>
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
	<script>
		$(function(){
			<?php if($markup[0]->markup_type =="GENERAL"){ ?>
				$('#specific').hide();
			<?php } ?>
			$('#status').change(function(){
				var current_status = $('#status').val();
				if(current_status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});
		});
		function makup_type_details(value){
			if(value == "SPECIFIC"){
				$('#specific').show();
			}else{
				$('#specific').hide();
			}
		}
	</script>
</body>
</html>
