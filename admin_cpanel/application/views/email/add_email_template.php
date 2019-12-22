<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Email Template</title>	
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
				<li><a href="<?php echo site_url()."email/email_template_list"; ?>">Email Template</a></li>
				<li class="active"><strong>Add New Email Template</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Email Template
							</div>							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form id="api" method="post" action="<?php echo site_url()."email/update_mail_template/".base64_encode(json_encode($email_template[0]->email_template_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Email Type</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" value="<?php echo $email_template[0]->email_type; ?>" maxlength="50" name="email_type" placeholder="Email Type" data-validate="required" data-message-required="Please enter the API Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Email From</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" value="<?php echo $email_template[0]->email_from; ?>" maxlength="50" name="email_from" placeholder="Email From Address" data-validate="required,email" data-message-required="Please enter the Email Address">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Email From Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-4" value="<?php echo $email_template[0]->email_from_name; ?>" maxlength="50" name="email_from_name" placeholder="Email From Name" data-validate="required" data-message-required="Please enter the Email From Name">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Email CC</label>									
									<div class="col-sm-5">
										<input type="text" id="field-3" class="form-control" value="<?php echo $email_template[0]->email_cc; ?>" maxlength="50" name="email_cc" placeholder="Email CC" data-validate="email" data-message-required="Please enter the proper Email">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Email BCC</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" maxlength="70" value="<?php echo $email_template[0]->email_bcc; ?>" id="field-3" name="email_bcc" placeholder="Email BCC" data-validate="email" data-message-required="Please enter the proper Email">
									</div>
								</div>
								<div class="form-group">
									<label for="field-3" class="col-sm-3 control-label">Email Subject</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" maxlength="150" value="<?php echo $email_template[0]->subject; ?>" name="subject" placeholder="Email Subject" >
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Email Description</label>
									<div class="col-sm-9">							
										<textarea class="form-control ckeditor" name="message"><?php echo $email_template[0]->message ;?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Email Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="<?php echo $email_template[0]->status; ?>" id="status" <?php if($email_template[0]->status == "ACTIVE"){ ?> checked <?php } ?> >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Email Template Details</button>
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
