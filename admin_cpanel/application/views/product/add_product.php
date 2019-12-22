<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Add Product</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
		
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/index"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."product/product_list"; ?>">Product</a></li>
				<li class="active"><strong>Add New Product</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Product
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form  id="product" method="post" action="<?php echo site_url()."product/add_product"; ?>" class="form-horizontal form-groups-bordered validate">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Product Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="product_name" placeholder="Product Name" data-validate="required" data-message-required="Please enter the Product Name">
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">Product Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="product_status" value="ACTIVE" id="product_status" checked>
										</div>
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add</button>
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
	<script>
		$(function(){
			$('#product_status').change(function(){
				var current_status = $('#product_status').val();
				if(current_status == "ACTIVE")
					$('#product_status').val('INACTIVE');
				else
					$('#product_status').val('ACTIVE');
			});
			
			var product_name = document.getElementById('field-1');			
			$('input#field-1').keyup(function() {
				var $th = $(this);		
				if($th.val().trim() != ""){
					 var regex = /^[a-zA-Z ]*$/;
					if (regex.test($th.val())) {
						$th.css('border', '1px solid #099A7D');					
					} else {
						// alert("Please use only letters");
						$th.css('border', '1px solid #f52c2c');
						return '';
					}
				}else if(product_name.value.length < 2 || product_name.value.length > 50) {
					    product_name.style.border = "1px solid #f52c2c";   
						product_name.focus(); 
						return false; 
				}
			});	
			
			$('#product').submit(function() {
				// Product Name validation 
				var filter = /^[a-zA-Z ]*$/;
				if(product_name.value != '')
				{
					if(!(product_name.value.match(filter)))
					{
						product_name.style.border = "1px solid #f52c2c";   
						product_name.focus(); 
						return false; 
					}
				}
				else
				{
					product_name.style.border = "1px solid #f52c2c";   
					product_name.focus(); 
					return false; 
				}

				if(product_name.value.length < 2 || product_name.value.length > 50) {
					    product_name.style.border = "1px solid #f52c2c";   
						product_name.focus(); 
						return false; 
				}
				
		     });
		});
	</script>
</body>
</html>
