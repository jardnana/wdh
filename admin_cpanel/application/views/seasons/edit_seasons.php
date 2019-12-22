<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Seasons</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
</head>
<body id="top" oncontextmenu="return false"  class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
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
					  $url = site_url()."dashboard";
				 } ?>	
				 				
				<li><a href="<?php echo $url; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."seasons/seasons_list"; ?>">Seasons</a></li>
				<li class="active"><strong>Edit Seasons</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit Seasons
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" id="tax" name="tax" action="<?php echo site_url()."seasons/update_seasons/".base64_encode(json_encode($seasons_list[0]->seasons_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<div class="col-sm-2">
										<label for="field-1" class="col-sm-12 control-label">Season Name</label>									
									</div>
									<div class="col-sm-5"> 
										 <input type="text" class="form-control" value="<?php echo $seasons_list[0]->seasons_name ?>" name="seasons_name" data-validate="required" data-message-required="Please Enter the Seasons Name" />
									</div>
								</div>	
								
								<div class="form-group">
									<div class="col-sm-2">
										<label for="field-1" class="col-sm-12 control-label">Date Range</label>									
									</div>
									<div class="col-sm-5"> 
										 <input type="text"  data-min-date="<?php echo date('m-d-Y');?>" class="form-control daterange" value="<?php echo $seasons_list[0]->season_date_range ?>" name="season_date_range" data-validate="required" data-message-required="Please Enter the Seasons Name" />
									</div>
								</div>	
								
								<div class="form-group">
									<div class="col-sm-2">
										<label class="col-sm-12 control-label">Status</label>		
									</div>
									<div class="col-sm-5"> 	
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive" style="min-width: 200px;">
											<input type="checkbox" name="status" value="ACTIVE" id="status" checked>
										</div>
									</div>
								</div>	
								<div class="form-group">
									<div class="col-md-2">
										<label class="col-sm-12 control-label"></label>
									</div>
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
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ckeditor/adapters/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
	<script>
		$(function(){
			$('#status').change(function(){
				var status = $('#status').val();
				if(status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});			
			
		});
	</script>
</body>
</html>
