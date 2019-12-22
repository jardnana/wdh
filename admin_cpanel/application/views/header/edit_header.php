<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Header Menu</title>	
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
				<li><a href="<?php echo site_url()."header/header_list"; ?>">Header Menu</a></li>
				<li class="active"><strong>Add New Header</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Header Menu
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."header/update_header/".base64_encode(json_encode($header_list[0]->header_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Header Menu Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="menu_name" value="<?php echo $header_list[0]->header_name; ?>" data-validate="required" data-message-required="Please enter the Menu Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Menu Link Type</label>									
									<div class="col-sm-5">										
										<select name="menu_type" class="selectboxit">
											<option value="INTERNAL" <?php if($header_list[0]->link_type == "INTERNAL"){ ?> selected <?php } ?> data-iconurl="">INTERNAL</option>
											<option value="EXTERNAL" <?php if($header_list[0]->link_type == "EXTERNAL"){ ?> selected <?php } ?> data-iconurl="">EXTERNAL</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Header URL</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-3" name="menu_url" value="<?php echo $header_list[0]->link; ?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Menu Level</label>									
									<div class="col-sm-5">										
										<select name="menu_level" class="selectboxit">
											<option value="0" <?php if($header_list[0]->menu_level == "0"){ ?> selected <?php } ?> data-iconurl="">0</option>
											<option value="1" <?php if($header_list[0]->menu_level == "1"){ ?> selected <?php } ?> data-iconurl="">1</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Menu Position</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-p" name="position" value="<?php echo $header_list[0]->position; ?>" data-validate="required" data-message-required="Please enter the Menu Position">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Menu Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="menu_status" value="<?php echo $header_list[0]->status; ?>" id="menu_status" <?php if($header_list[0]->status == "ACTIVE"){ ?> checked <?php } ?>>
										</div>
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Menu Details</button>
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
			$('#menu_status').change(function(){
				var current_status = $('#menu_status').val();
				if(current_status == "ACTIVE")
					$('#menu_status').val('INACTIVE');
				else
					$('#menu_status').val('ACTIVE');
			});
		});
	</script>
</body>
</html>
