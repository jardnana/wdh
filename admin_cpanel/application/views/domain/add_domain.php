<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Add Domain</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body  id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."domain/domain_list"; ?>">Domain</a></li>
				<li class="active"><strong>Add New Domain</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Domain
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" id="domain" name="domain" action="<?php echo site_url()."domain/add_domain"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Domain Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="domain_name" name="domain_name" placeholder="Domain Name" data-validate="required" data-message-required="Please enter the Domain Name">
										 <?php echo form_error('domain_name',  '<span for="domain_name" class="validate-has-error">', '</span>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Domain URL</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="domain_url" name="domain_url" placeholder="Domain URL" data-validate="required,url" data-message-required="Please enter the proper Domain URL">
										<?php echo form_error('domain_url',  '<span for="field-2" class="validate-has-error">', '</span>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Domain Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="domain_status" value="ACTIVE" id="domain_status" checked>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Domain Logo Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>assets/images/thumb-1@2x.png" alt="Domain Logo">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" id="domain_logo" name="domain_logo" accept="image/*">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
												<?php echo form_error('domain_logo',  '<span for="field-2" class="validate-has-error">', '</span>'); ?>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Domain</button>
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
			$('#domain_status').change(function(){
				var current_status = $('#domain_status').val();				
				if(current_status == "ACTIVE")
					$('#domain_status').val('INACTIVE');
				else
					$('#domain_status').val('ACTIVE');
			});
			
			var domain_name = document.getElementById('domain_name');			
			$('input#domain_name').keyup(function() {
				var $th = $(this);		
				if($th.val().trim() != ""){
					 var regex = /^[a-zA-Z 0-9]*$/;
					if (regex.test($th.val())) {
						$th.css('border', '1px solid #099A7D');					
					} else {
						$th.css('border', '1px solid #f52c2c');
						return '';
					}
				}else if(domain_name.value.length < 2 || domain_name.value.length > 50) {
					    domain_name.style.border = "1px solid #f52c2c";   
						domain_name.focus(); 
						return false; 
				}
			});	
			var file_upload = true;
			$('#domain').submit(function() {
				// domain Name validation 
				var filter = /^[a-zA-Z ]*$/;
				if(domain_name.value != '')
				{
					if(!(domain_name.value.match(filter)))
					{
						domain_name.style.border = "1px solid #f52c2c";   
						domain_name.focus(); 
						return false; 
					}
				}
				else
				{
					domain_name.style.border = "1px solid #f52c2c";   
					domain_name.focus(); 
					return false; 
				}

				if(domain_name.value.length < 2 || domain_name.value.length > 50) {
					    domain_name.style.border = "1px solid #f52c2c";   
						domain_name.focus(); 
						return false; 
				}
		     });
		     $.fn.checkFileType = function(options) {
				var defaults = {
					allowedExtensions: [],
					success: function() {},
					error: function() {}
				};
				options = $.extend(defaults, options);
				return this.each(function() {
					$(this).on('change', function() {
						var value = $(this).val(),
							file = value.toLowerCase(),
							extension = file.substring(file.lastIndexOf('.') + 1);
						if ($.inArray(extension, options.allowedExtensions) == -1) {
							options.error();
							$(this).focus();
						} else {
							options.success();
						}
					});
				});
			};
			$('#domain_logo').checkFileType({
				allowedExtensions: ['jpg', 'jpeg','png'],
				success: function() {
					file_upload = true;
					// alert('Success');
					 $("#imageflag").val("true");
				},
				error: function() {
					file_upload = false;
					alert('Please Select Valid Image (Ex: jpg,jpeg,png) ');
					 $("#imageflag").val("false");
			   	 
				}
			});
			return false;
		});
	</script>
</body>
</html>
