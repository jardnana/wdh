<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Add Flash</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
</head>
<body id="top" oncontextmenu="return false" class="thebg page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flash/flash_list"; ?>">Flash</a></li>
				<li class="active"><strong>Add New Flash</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New flash
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."flash/update_flash/".base64_encode(json_encode($flash_list[0]->flash_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flash Title</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="flash_title" value="<?php echo $flash_list[0]->flash_title; ?>" placeholder="Flash Title" data-validate="required" data-message-required="Please enter the Flash Title">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flash Type</label>									
									<div class="col-sm-5">
										<select onchange="flash_type_type_details(this.value)" name="flash_type" class="select2" required>
											<option value="GENERAL" <?php if($flash_list[0]->flash_type =="GENERAL"){ echo "selected"; } ?> data-iconurl="">GENERAL</option>
											<option value="CITY" <?php if($flash_list[0]->flash_type =="CITY"){ echo "selected"; } ?> data-iconurl="">CITY</option>
										</select>
									</div>
								</div>
								<div class="form-group" id="city_details">
									<label for="field-3" class="col-sm-3 control-label">City/Airport Code</label>									
									<div class="col-sm-5">
										<input type="text" id="city_name" name="city_name" class="form-control" placeholder="Type City Name" value="<?php echo $flash_list[0]->city_name; ?>"  required />
										<input type="hidden" id="city_name_id" value="" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Fash Description</label>
									<div class="col-sm-9">							
										<textarea class="form-control ckeditor" name="description"><?php echo $flash_list[0]->description; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flash Duration ion Seconds</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="duration" placeholder="Flash duration in Seconds" value="<?php echo $flash_list[0]->duration; ?>" data-validate="required,number" data-message-required="Please enter the Flash duration in Seconds">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flash Link</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="link" value="<?php echo $flash_list[0]->link; ?>" placeholder="Flash Link" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Flash Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="flash_status" value="<?php echo $flash_list[0]->status; ?>" id="footer_status" <?php if($flash_list[0]->status == "ACTIVE"){ ?> checked <?php } ?> >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Flash Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
			<!-- flash -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ckeditor/adapters/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script>
		$(function(){
			<?php if($flash_list[0]->flash_type =="GENERAL"){ ?>
			$('#city_details').hide();
			<?php } ?>
			$('#flash_status').change(function(){
				var current_status = $('#flash_status').val();
				if(current_status == "ACTIVE")
					$('#flash_status').val('INACTIVE');
				else
					$('#flash_status').val('ACTIVE');
			});
			$("#city_name").autocomplete({
				source: "<?php echo site_url(); ?>flight_deals/get_airports_code",
				minLength: 2, //search after two characters
				autoFocus: true, // first item will automatically be focused
			});
		});
		
		function flash_type_type_details(value){
			if(value == "CITY"){
				$('#city_details').show();
			}else{
				$('#city_details').hide();
			}
		}
	</script>
</body>
</html>
