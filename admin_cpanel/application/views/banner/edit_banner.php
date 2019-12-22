<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Banner</title>	
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
				<li><a href="<?php echo site_url()."banner/banner_list"; ?>">Banner</a></li>
				<li class="active"><strong>Edit Banner</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit Banner
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."banner/update_banner/".base64_encode(json_encode($banner_list[0]->banner_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label class="col-sm-3 control-label">Banner Type</label>									
									<div class="col-sm-5">										
										<select name="banner_type" class="selectboxit">
											<option value="MAIN_BANNER" <?php if($banner_list[0]->banner_type == "MAIN_BANNER"){ echo "selected"; } ?> data-iconurl="" >MAIN BANNER</option>
											<option value="INNER_BANNER" <?php if($banner_list[0]->banner_type == "INNER_BANNER"){ echo "selected"; } ?>  data-iconurl="" >INNER BANNER</option>
											<option value="SLIDER" <?php if($banner_list[0]->banner_type == "SLIDER"){ echo "selected"; } ?> data-iconurl="" >MAIN SLIDER</option>
											<option value="INNER_SLIDER" <?php if($banner_list[0]->banner_type == "INNER_SLIDER"){ echo "selected"; } ?> data-iconurl="" >INNER SLIDER</option>
											<option value="SEARCH_BANNER" <?php if($banner_list[0]->banner_type == "SEARCH_BANNER"){ echo "selected"; } ?> data-iconurl="" >SEARCH SLIDER</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Banner Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="title" value="<?php echo $banner_list[0]->title;  ?>" data-validate="required" data-message-required="Please enter the Banner Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Banner Image Alternative text</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" name="img_alt_text" value="<?php echo $banner_list[0]->img_alt_text;  ?>" data-validate="required" data-message-required="Please enter the Banner Image Alternative Text">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Banner URL</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-3" name="link" value="<?php echo $banner_list[0]->link;  ?>" data-validate="url" data-message-required="Please enter the proper Banner URL">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Banner Position</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="position" value="<?php echo $banner_list[0]->position;  ?>" data-validate="required,number" data-message-required="Please enter the Banner Position">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Banner Image Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>uploads/banner/<?php echo $banner_list[0]->banner_image; ?>" alt="Banner Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="banner_logo" accept="image/*">
													<input type="file" value="<?php echo $banner_list[0]->banner_image; ?>" name="banner_logo" accept="image/*">
													<input type="hidden" value="<?php echo $banner_list[0]->banner_image; ?>" name="banner_logo_old">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>
							<!--	<div class="form-group">
									<label for="slogan_english" class="col-sm-3 control-label">Banner Slogan(English)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogan_english" name="slogan_english" placeholder="Banner Slogan" data-validate="required" data-message-required="Please enter the Banner Slogan" value="<?php // echo $banner_list[0]->banner_caption; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogan_polish" class="col-sm-3 control-label">Banner Slogan(Polish)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogan_polish" name="slogan_polish" placeholder="Banner Slogan" data-validate="required" data-message-required="Please enter the Banner Slogan" value="<?php //echo $banner_list[0]->banner_caption_polish; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogandesc_english" class="col-sm-3 control-label">Banner Slogan Description(English)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogandesc_english" name="slogandesc_english" placeholder="Banner Slogan Description" data-validate="required" data-message-required="Please enter the Banner Slogan Description" value="<?php// echo $banner_list[0]->caption_description; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogandesc_polish" class="col-sm-3 control-label">Banner Slogan Description(Polish)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogandesc_polish" name="slogandesc_polish" placeholder="Banner Slogan Description" data-validate="required" data-message-required="Please enter the Banner Slogan Description" value="<?php // echo $banner_list[0]->caption_description_polish; ?>">
									</div>
								</div>-->
								<div class="form-group">
									<label class="col-sm-3 control-label">Banner Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="<?php echo $banner_list[0]->status; ?>" id="status" <?php if($banner_list[0]->status){ echo "checked"; }?>>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Banner Details</button>
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
