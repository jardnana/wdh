<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | advertisement</title>	
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
				<li><a href="<?php echo site_url()."advertisement/advertisement_list"; ?>">advertisement</a></li>
				<li class="active"><strong>Edit Advertisement</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit Advertisement
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."advertisement/update_advertisement/".base64_encode(json_encode($advertisement_list[0]->advertisement_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label class="col-sm-3 control-label">Advertisement Type</label>									
									<div class="col-sm-5">										
										<select name="advertisement_type" class="selectboxit">
											<option value="LEFT_BANNER" <?php if($advertisement_list[0]->advertisement_type == "LEFT_BANNER"){ echo "selected"; } ?> data-iconurl="" >LEFT BANNER</option>
											<option value="RIGHT_BANNER" <?php if($advertisement_list[0]->advertisement_type == "RIGHT_BANNER"){ echo "selected"; } ?>  data-iconurl="" >RIGHT BANNER</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Advertisement Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="title" value="<?php echo $advertisement_list[0]->title;  ?>" data-validate="required" data-message-required="Please enter the advertisement Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Advertisement Image Alternative text</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" name="img_alt_text" value="<?php echo $advertisement_list[0]->img_alt_text;  ?>" data-validate="required" data-message-required="Please enter the advertisement Image Alternative Text">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Advertisement URL</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-3" name="link" value="<?php echo $advertisement_list[0]->link;  ?>" data-validate="url" data-message-required="Please enter the proper advertisement URL">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Advertisement Position</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="position" value="<?php echo $advertisement_list[0]->position;  ?>" data-validate="required,number" data-message-required="Please enter the advertisement Position">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Advertisement Left Image Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>uploads/advertisement/<?php echo $advertisement_list[0]->advertisement_left_image_name; ?>" alt="advertisement Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="advertisement_left_image" accept="image/*">
													<input type="file" value="<?php echo $advertisement_list[0]->advertisement_left_image_name; ?>" name="advertisement_left_image" accept="image/*">
													<input type="hidden" value="<?php echo $advertisement_list[0]->advertisement_left_image_name; ?>" name="advertisement_left_image_old">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Advertisement Right Image Upload</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput">
												<img src="<?php echo base_url(); ?>uploads/advertisement/<?php echo $advertisement_list[0]->advertisement_right_image_name; ?>" alt="advertisement Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="advertisement_right_image" accept="image/*">
													<input type="file" value="<?php echo $advertisement_list[0]->advertisement_right_image_name; ?>" name="advertisement_right_image" accept="image/*">
													<input type="hidden" value="<?php echo $advertisement_list[0]->advertisement_right_image_name; ?>" name="advertisement_right_image_old">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-group">
                                 <label for="field-1" class="col-sm-3 control-label">Advertisement Description</label>									
									<div class="col-sm-9">
								 <textarea style="" rows="7" cols="15" class="input-long ckeditor" name="description1" id="description1" required ><?php echo $advertisement_list[0]->adv_details; ?></textarea>        
							         </div>
								</div>
							        <script>
							      
							              CKEDITOR.replace( 'description',
							               {
							                filebrowserBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=files',
							                filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=images',
							                filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/browse.php?type=flash',
							                filebrowserUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=files',
							                filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=images',
							                filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/kcfinder/upload.php?type=flash'
							               });
							               
							        </script>
								
							<!--	<div class="form-group">
									<label for="slogan_english" class="col-sm-3 control-label">advertisement Slogan(English)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogan_english" name="slogan_english" placeholder="advertisement Slogan" data-validate="required" data-message-required="Please enter the advertisement Slogan" value="<?php // echo $advertisement_list[0]->advertisement_caption; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogan_polish" class="col-sm-3 control-label">advertisement Slogan(Polish)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogan_polish" name="slogan_polish" placeholder="advertisement Slogan" data-validate="required" data-message-required="Please enter the advertisement Slogan" value="<?php //echo $advertisement_list[0]->advertisement_caption_polish; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogandesc_english" class="col-sm-3 control-label">advertisement Slogan Description(English)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogandesc_english" name="slogandesc_english" placeholder="advertisement Slogan Description" data-validate="required" data-message-required="Please enter the advertisement Slogan Description" value="<?php// echo $advertisement_list[0]->caption_description; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="slogandesc_polish" class="col-sm-3 control-label">advertisement Slogan Description(Polish)</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="slogandesc_polish" name="slogandesc_polish" placeholder="advertisement Slogan Description" data-validate="required" data-message-required="Please enter the advertisement Slogan Description" value="<?php // echo $advertisement_list[0]->caption_description_polish; ?>">
									</div>
								</div>-->
								<div class="form-group">
									<label class="col-sm-3 control-label">advertisement Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="<?php echo $advertisement_list[0]->status; ?>" id="status" <?php if($advertisement_list[0]->status){ echo "checked"; }?>>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update advertisement Details</button>
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
	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
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
