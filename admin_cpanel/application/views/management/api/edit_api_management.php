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
				<li><a href="<?php echo site_url()."management/api_management_list"; ?>">API Management</a></li>
				<li class="active"><strong>Manage API</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Manage API
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">
							<form id="rootwizard" action="<?php echo site_url()."management/api_management"; ?>" method="post" class="form-wizard form-horizontal form-groups-bordered validate" enctype= "multipart/form-data" >
								<div class="steps-progress"><div class="progress-indicator"></div></div>
								<ul>
									<li class="active"><a href="#tab4" data-toggle="tab"><span>1</span>Api Management</a></li>
									<li ><a href="#tab5" data-toggle="tab"><span>2</span>Domain Management</a></li>
									<li ><a href="#tab6" data-toggle="tab"><span>3</span>Product Management</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab4">
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">API</label>									
											<div class="col-sm-5">
												<select name="api" class="selectboxit">
													<?php if($api!=''){ for($a=0;$a<count($api);$a++){ ?>
													<option value="<?php echo $api[$a]->api_details_id; ?>" data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_alternative_name.")"; ?></option>
													<?php }} ?>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane" id="tab5">
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
									<div class="tab-pane" id="tab6">
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
										<div class="form-group">
											<label class="col-sm-3 control-label">&nbsp;</label>									
											<div class="col-sm-3 pull-right">
												<button type="submit" class="btn btn-success">Manage API Details</button>
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
