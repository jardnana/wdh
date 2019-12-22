<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Manage API</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
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
				<li><a href="<?php echo site_url()."management/site_management"; ?>">Site Management</a></li>
				<li class="active"><strong>Manage Site</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Manage Site
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">
							<form id="rootwizard" action="<?php echo site_url()."management/site_management"; ?>" method="post" action="" class="form-wizard form-horizontal form-groups-bordered validate" enctype= "multipart/form-data" >
								<div class="steps-progress"><div class="progress-indicator"></div></div>
								<ul>
									<li class="active"><a href="#tab1" data-toggle="tab"><span>1</span>Block List</a></li>
									<li ><a href="#tab2" data-toggle="tab"><span>2</span>Domain</a></li>
									<li ><a href="#tab3" data-toggle="tab"><span>3</span>Product</a></li>
									<li ><a href="#tab4" data-toggle="tab"><span>4</span>API</a></li>
									<li ><a href="#tab5" data-toggle="tab"><span>5</span>User Type</a></li>
									<li ><a href="#tab6" data-toggle="tab"><span>6</span>User</a></li>
									<li ><a href="#tab7" data-toggle="tab"><span>7</span>Payment API</a></li>
									<li ><a href="#tab8" data-toggle="tab"><span>8</span>Country</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Block List</label>									
											<div class="col-sm-5">
												<select name="block_list" class="selectboxit">
													<?php if($blocklist!=''){ for($a=0;$a<count($blocklist);$a++){ ?>
													<option value="<?php echo $blocklist[$a]->block_list_id; ?>" data-iconurl=""><?php echo $blocklist[$a]->block_list_name; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab2">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Domain</label>									
											<div class="col-sm-5">
												<select name="doamin[]" class="select2" multiple required>
													<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
													<option value="<?php echo $domain[$d]->domain_details_id; ?>" data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab3">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Product</label>									
											<div class="col-sm-5">
												<select name="product[]" class="select2" multiple required>
													<?php if($product!=''){ for($p=0;$p<count($product);$p++){ ?>
													<option value="<?php echo $product[$p]->product_details_id; ?>" data-iconurl=""><?php echo $product[$p]->product_name; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>	
									</div>
									<div class="tab-pane" id="tab4">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">API</label>									
											<div class="col-sm-5">
												<select name="api[]" class="select2" multiple required>
													<?php if($api!=''){ for($a=0;$a<count($api);$a++){ ?>
													<option value="<?php echo $api[$a]->api_details_id; ?>" data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_alternative_name.")"; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab5">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">User Type</label>									
											<div class="col-sm-5">
												<select name="user_type[]" class="select2" multiple required>
													<?php if($user_type!=''){ for($a=0;$a<count($user_type);$a++){ ?>
													<option value="<?php echo $user_type[$a]->user_type_id; ?>" data-iconurl=""><?php echo $user_type[$a]->user_type_name; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab6">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Users</label>									
											<div class="col-sm-5">
												<select name="users[]" class="select2" multiple required>
													<?php if($user_list['user_info']!=''){ for($a=0;$a<count($user_list['user_info']);$a++){ ?>
													<option value="<?php echo $user_list['user_info'][$a]->user_details_id; ?>" data-iconurl=""><?php echo str_replace("-"," ",$user_list['user_info'][$a]->user_name); ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab7">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Payment API</label>									
											<div class="col-sm-5">
												<select name="paymnet[]" class="select2" multiple required>
													<?php if($payment!=''){ for($a=0;$a<count($payment);$a++){ ?>
													<option value="<?php echo $payment[$a]->payment_api_details_id; ?>" data-iconurl=""><?php echo $payment[$a]->api_name ." (".$payment[$a]->api_alternative_name.")"; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab8">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Country</label>									
											<div class="col-sm-5">
												<select name="country[]" class="select2" multiple required>
													<?php if($country!=''){ for($p=0;$p<count($country);$p++){ ?>
													<option value="<?php echo $country[$p]->country_id; ?>" data-iconurl=""><?php echo $country[$p]->country_name; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
										<div class="form-group">
											<label class="col-sm-3 control-label">&nbsp;</label>									
											<div class="col-sm-3 pull-right">
												<button type="submit" class="btn btn-success">Manage Site</button>
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
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.wizard.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
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
