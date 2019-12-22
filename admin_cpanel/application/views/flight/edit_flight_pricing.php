<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Edit Flight Price Management</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/github.min.css">   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-clockpicker.min.js"></script>            
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
				<li><a href="<?php echo site_url()."flight/flight_list"; ?>">FLIGHT</a></li>
				<li class="active"><strong>Edit Flight Price</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit Flight Price Management
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>	

						<div class="panel-body">							
							<form method="post" id="price" name="price" action="<?php echo site_url()."flight/update_flight_pricing_data/".base64_encode(json_encode($flight_price_details_id))."/".base64_encode(json_encode($flight_id))."/".base64_encode(json_encode($flight_crs_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<!--<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Currency</label>	
									<div class="col-sm-5">								
									<select name="currency" class="select2" required>
											<option value=""/>
											<?php if($currency_list!=''){ for($ad=0;$ad<count($currency_list);$ad++){ ?>
											<option value="<?php echo $currency_list[$ad]->currency_code; ?>" <?php if($currency_list[$ad]->currency_code == $price_id_info[0]->base_currency){ echo "selected"; } ?>  data-iconurl="" ><?php echo $currency_list[$ad]->currency_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>-->	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Seasons Name</label>									
									<div class="col-sm-5">								
									<select name="seasons_details_id" id="seasons_details_id" class="select2" >
											<option value=""/>
											<?php if($seasons_list!=''){ for($ad=0;$ad<count($seasons_list);$ad++){ ?>
											<option value="<?php echo $seasons_list[$ad]->seasons_details_id; ?>" <?php if($seasons_list[$ad]->seasons_details_id == $price_id_info[0]->seasons_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $seasons_list[$ad]->seasons_name." (".$seasons_list[$ad]->season_date_range.")"; ?></option>
											<?php }} ?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Adult Price</label>									
									<div class="col-sm-5">
										
										<input name="adult_price" id ="adult_price" value="<?php echo $price_id_info[0]->adult_base_fare; ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="2" data-rule-number='true' min="1" type="text" class="form-control"  placeholder="Adult Price" required>

									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Adult Tax</label>									
									<div class="col-sm-5">
										
										<input name="adult_tax" id ="adult_tax" value="<?php echo $price_id_info[0]->adult_total_tax; ?>" onkeypress="return isNumberKey(event)"  maxlength="10" minlength="0" data-rule-number='true' min="0" type="text" class="form-control"  placeholder="Adult tax" required>

									</div>
								</div>
								
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Child Price</label>									
									<div class="col-sm-5">
										
										<input name="child_price" id ="child_price" value="<?php echo $price_id_info[0]->child_base_fare; ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="1" data-rule-number='true' min="1" type="text" class="form-control"  placeholder="Child Price" >

									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Child Tax</label>									
									<div class="col-sm-5">
										
										<input name="child_tax" id ="child_tax" value="<?php echo $price_id_info[0]->child_total_tax; ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="0" data-rule-number='true' min="0" type="text" class="form-control"  placeholder="Child Tax">

									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Infant Price</label>									
									<div class="col-sm-5">
										
										<input name="infant_price" id ="infant_price" value="<?php echo $price_id_info[0]->infant_base_fare; ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="1" data-rule-number='true' min="1" type="text" class="form-control"  placeholder="Infant Price">

									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Infant Tax</label>									
									<div class="col-sm-5">
										
										<input name="infant_tax" id ="infant_tax" value="<?php echo $price_id_info[0]->infant_total_tax; ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="0" data-rule-number='true' min="0" type="text" class="form-control"  placeholder="Infant Tax">

									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Fare Basis Code</label>									
									<div class="col-sm-5">
										
										<input name="fare_code" id ="fare_code" value="<?php echo $price_id_info[0]->fare_basis_code; ?>"    min="0" type="text" class="form-control"  placeholder="Fare Basis Code">

									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Fare Rules</label>									
									<div class="col-sm-9">
										
										<textarea name="fare_rules" id ="fare_rules"   min="0" type="text" class="input-long ckeditor"  placeholder="Fare Rules"><?php echo $price_id_info[0]->fare_rules; ?></textarea>

									</div>
								</div>
								<script>
							      
							              CKEDITOR.replace( 'fare_rules',
							               {
							                filebrowserBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=files',
							                filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=images',
							                filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=flash',
							                filebrowserUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=files',
							                filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=images',
							                filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=flash'
							               });
							               
							        </script>
								<!-- <div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Baggage Allowance(max. Kg)</label>									
									<div class="col-sm-5">
										
										<input name="baggage_info" id ="baggage_info" maxlength="6" minlength="1" data-rule-number='true' min="1" type="number" class="form-control"  placeholder="Max. Baggage Allowance in Kg" required>

									</div>
								</div> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Flight Pricing</button>
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
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
	<script>
		 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }	

	</script>

	
</body>
</html>
