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
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
					 <?php if($supplier_rights == 1){
					 $url = site_url()."supplier_dashboard";
				 } else {
					  $url = site_url()."dashboard/dashboard";
				 } ?>	
				 				
				<li><a href="<?php echo $url; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."promo/promo_code_list"; ?>">Promo Code List</a></li>
				<li class="active"><strong>Add New Promo Code</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Promo Code
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form id="promo" method="post" action="<?php echo site_url()."promo/add_promo_code"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
							<?php if($supplier_rights == 1) { ?>
							<input type="hidden" name="supplier_rights" id="supplier_rights" value="<?php echo $supplier_rights; ?>" />
							<?php } else { ?>
							<input type="hidden" name="supplier_rights" id="supplier_rights" value="" />
							<?php } ?>
							
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Promo Code</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="promo_code" maxlength="15" name="promo_code" placeholder="Promo Code" data-validate="required" data-message-required="Please enter the promo code">
									</div>
								</div>
								<div class="form-group">
											<label for="promo_type"  class="col-sm-3 control-label">Promo Code Type</label>									
											<div class="col-sm-5">
												<select name="promo_type" id="promo_type" class="selectboxit" data-validate="required" data-message-required="Please select the promo type">
													<option value="" data-iconurl="">Select Promo code Type</option>
													<option value="Promo code by %" data-iconurl="">Promo code by %</option>
													<option value="Promo code by amount" data-iconurl="">Promo code by amount</option>
													<option value="Promo code by spending" data-iconurl="">Promo code by spending</option>
												</select>
												<span for="promo_type" id="promo_type_err" class="validate-has-error"></span>
											</div>
										</div>
								<div class="form-group">
									<label for="discount" id="discount_lbl" name="discount_lbl" class="col-sm-3 control-label">Discount In %</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="discount" maxlength="7" name="discount" placeholder="Discount in %" data-validate="required" data-message-required="Please enter the discount">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Expiry Date</label>									
									<div class="col-sm-5">
										<input type="text" id="exp_date" class="form-control datepicker" maxlength="10" name="exp_date" placeholder="Expiry Date" data-validate="required" data-message-required="Please enter expiry date">
									</div>
								</div>
								
								<div class="form-group"  id="amt" style="display:none;">
									<label for="field-1"  id="amt_lbl" class="col-sm-3 control-label">Amount Range</label>									
									<div class="col-sm-5">
										<input type="text" id="amount" class="form-control" maxlength="10" name="amount" placeholder="" data-validate="required" data-message-required="Please enter amount">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Promo Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="promo_status" id="promo_status" value="INACTIVE" >
										</div>
									</div>
								</div>
						
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Promo Code</button>
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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
	<script>
		$(function(){
			
			$('#promo_status').change(function(){
				var current_status = $('#promo_status').val();
				if(current_status == "ACTIVE")
					$('#promo_status').val('INACTIVE');
				else
					$('#promo_status').val('ACTIVE');
			});
			
			var promo_type_elem = $('#promo_type');
			var discount = document.getElementById('discount');
			var amount = document.getElementById('amount');
			 var regex = /^[0-9]+(\.[0-9]{1,2})?$/;
			
			promo_type_elem.on('change', function(){
				
				if(promo_type_elem.val() == 'Promo code by amount') {
					$('#discount_lbl').html('Discount amount in $');
					$('#discount').attr('placeholder', 'Discount amount in $');
					$('#amt_lbl').html('Amount in range');
					$('#amt').css({'display':'inherit'});
					$('#amount').attr('placeholder','Amount in range');
				
				} else if(promo_type_elem.val() == 'Promo code by spending') {
					$('#discount_lbl').html('Discount amount in $');
					$('#discount').attr('placeholder', 'Discount amount in $');
					$('#amt').css({'display':'inherit'});
					$('#amount').attr('placeholder','Spending amount in $');
					$('#amt_lbl').html('Spending amount in $');
				} else {
					$('#discount_lbl').html('Discount in %');
					$('#discount').attr('placeholder', 'Discount in %');
					$('#amt').css({'display':'none'});
				}
			});
			
			$('#discount').keyup(function() {
				
				var $th = $(this);		
				if($th.val().trim() != ""){
					 var regex = /^[0-9]+(\.[0-9]{1,2})?$/;
					if (regex.test($th.val())) {
						$th.css('border', '1px solid #099A7D');					
					} else {
						// alert("Please use only letters");
						$th.css('border', '1px solid #f52c2c');
						return '';
					}
				}else if(discount.value.length >10) {
					    discount.style.border = "1px solid #f52c2c";   
						discount.focus(); 
						return false; 
				}
			});
			
			
				$('#amount').keyup(function() {
				
				var $th = $(this);		
				if($th.val().trim() != ""){
					 var regex = /^[0-9]+(\.[0-9]{1,2})?$/;
					if (regex.test($th.val())) {
						$th.css('border', '1px solid #099A7D');					
					} else {
						// alert("Please use only letters");
						$th.css('border', '1px solid #f52c2c');
						return '';
					}
				}
				if(amount.value.length >10) {
					    amount.style.border = "1px solid #f52c2c";   
						amount.focus(); 
						return false; 
				}
			});
			
			$('#promo').submit(function(){
			
				 if(promo_type_elem.val() == '') {
					 $('promo_type_err').html("Please select the promo type");
					 $('#promo_type').css('border', '1px solid #099A7D');		
					 return false;
				 }
				
				
				});
				
			
		});
	</script>
</body>
</html>
