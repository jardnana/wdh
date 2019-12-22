
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Dashboard</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body  id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<!-- <div class="page-container horizontal-menu with-sidebar right-sidebar">-->
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		
		<div class="main-content">		
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
				<hr />
				<h1 class="margin-bottom">Settings</h1>
				<ol class="breadcrumb 2">
					<li><a href="<?php echo site_url()."dashboard/index"; ?>"><i class="entypo-home"></i>Home</a></li>
					<li class="active"><strong>Settings</strong></li>
				</ol><br />
				<form role="form" action="<?php echo site_url()."settings/update_settings"; ?>"  method="post" class="form-horizontal form-groups-bordered validate" >
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">General Site Settings</div>									
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>
								<div class="panel-body">						
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Site title</label>
										<div class="col-sm-5"><input type="text" name="site_title" class="form-control" id="field-1" value="<?php if(isset($settings[0]->site_title)) { echo $settings[0]->site_title; } ?>"></div>
									</div>
					
									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label">Tagline</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-2" name="tag_line" value="<?php if(isset($settings[0]->tag_line)) { echo $settings[0]->tag_line; } ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-3" class="col-sm-3 control-label">Live Site URL</label>										
										<div class="col-sm-5">
											<input type="text" class="form-control" name="site_url" id="field-3" data-validate="required,url" value="<?php if(isset($settings[0]->site_url)) { echo $settings[0]->site_url; } ?>">
										</div>
									</div>					
									<div class="form-group">
										<label for="field-4" class="col-sm-3 control-label">Email address</label>										
										<div class="col-sm-5">
											<input type="text" class="form-control" name="email_address" id="field-4" data-validate="required,email" value="<?php if(isset($settings[0]->email_address)) { echo $settings[0]->email_address; } ?>">
										</div>
									</div>									
									<div class="form-group">
										<label for="field-4" class="col-sm-3 control-label">Contatct Number</label>										
										<div class="col-sm-5"><input type="text" class="form-control" name="contact_number" id="field-4" data-validate="required" value="<?php if(isset($settings[0]->contact_number)) { echo $settings[0]->contact_number; } ?>"></div>
									</div>
									<div class="form-group">
										<label for="field-4" class="col-sm-3 control-label">Contatct Address</label>										
										<div class="col-sm-5"><textarea name="contact_address" class="form-control"><?php if(isset($settings[0]->contact_address)) { echo $settings[0]->contact_address; } ?></textarea></div>
									</div>									
									</div>								
							</div>						
						</div>
					</div>
					<?php if(true){ ?>
					<div class="row">
						<div class="col-md-6">							
							<div class="panel panel-primary" data-collapsed="0">							
								<div class="panel-heading">
									<div class="panel-title">Members Settings</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-5 control-label">Default SubAdmin Role</label>										
										<div class="col-sm-5">										
											<select class="form-control" name="sub_admin_role">
												<option value="Administrator" <?php if(isset($settings[0]->sub_admin_default_role) && $settings[0]->sub_admin_default_role == "Administrator"){ echo "selected"; } ?>>Administrator</option>
											</select>
										</div>
									</div>					
									<div class="form-group">
										<label class="col-sm-5 control-label">New users</label>										
										<div class="col-sm-5">										
											<select class="form-control" name="new_user_activation_method">
												<option value="Email" <?php if(isset($settings[0]->new_user_activation_method) && $settings[0]->new_user_activation_method == "Email"){ echo "selected"; } ?>>Will have to activate their account (via email)</option>
												<option value="Auto" <?php if(isset($settings[0]->new_user_activation_method) && $settings[0]->new_user_activation_method == "Auto"){ echo "selected"; } ?>>Account is automatically activated</option>
											</select>											
										</div>
									</div>					
									<div class="form-group">
										<label for="field-5" class="col-sm-5 control-label">Maximum login attempts</label>										
										<div class="col-sm-5">										
											<input type="text" name="login_attempts" id="field-5" class="form-control" data-validate="required,number" value="<?php if(isset($settings[0]->login_attempts)) { echo $settings[0]->login_attempts; } ?>" />
										</div>
									</div>								
								</div>								
							</div>						
						</div>
						<div class="col-md-6">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">Date and Time Settings</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>								
								<div class="panel-body">					
									<div class="form-group">
										<label for="field-3" class="col-sm-5 control-label">Date format</label>										
										<div class="col-sm-5">										
											<div class="radio radio-replace">
												<input type="radio" id="rd-1" name="date_format" value="date_format_1" <?php if(isset($settings[0]->date_format) && $settings[0]->date_format == "date_format_1"){ echo "checked"; } ?>>
												<label><input type="hidden" class="form-control input-sm form-inline" name="date_format_1_value" value="March 27, 2014" />March 27, 2014</label>
											</div>											
											<div class="radio radio-replace">
												<input type="radio" id="rd-2" name="date_format" value="date_format_2" <?php if(isset($settings[0]->date_format) && $settings[0]->date_format == "date_format_2"){ echo "checked"; } ?>>
												<label><input type="hidden" class="form-control input-sm form-inline" name="date_format_2_value" value="03/27/2014" />03/27/2014</label>
											</div>											
											<div class="radio radio-replace">
												<input type="radio" id="rd-3" name="date_format" value="date_format_3" <?php if(isset($settings[0]->date_format) && $settings[0]->date_format == "date_format_3"){ echo "checked"; } ?>>
												<label><input type="hidden" class="form-control input-sm form-inline" name="date_format_3_value" value="03/27/2014" />2014/03/27</label>
											</div>											
											<div class="radio radio-replace">
												<input type="radio" id="rd-4" name="date_format" value="date_format_4" <?php if(isset($settings[0]->date_format) && $settings[0]->date_format == "date_format_4"){ echo "checked"; } ?>>
												<label>Custom format: <input type="text" class="form-control input-sm form-inline" name="date_format_4_value" value="<?php if(isset($settings[0]->date_format) && $settings[0]->date_format == "date_format_4"){ echo $settings[0]->date_format_value;} ?>" style="width: 70px; display: inline-block;" /></label>
											</div>											
										</div>
									</div>									
								</div>							
							</div>
						</div>
					</div>
					<div class="form-group">
					<?php }if(true){ ?>
						<div class="col-md-6">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">Theme Selection</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>								
								<div class="panel-body">					
									<div class="form-group">
										<label for="field-1" class="col-sm-2 control-label">Select Skin</label>										
										<div class="col-sm-7">
											<div class="icheck-skins">
												<div class="color_theme" id="black" data-color-class="black">
													<input class="theme_color" name="skin_theme_color[]"  type="checkbox" value="black"/>
												</div>
												<div class="color_theme"  id="red" data-color-class="red">
													<input class="theme_color" name="skin_theme_color[]" type="checkbox" value="red" />
												</div>
												<div class="color_theme" id="blue"  data-color-class="blue">
													<input class="theme_color" name="skin_theme_color[]" type="checkbox" value="blue" />
												</div>
												<div class="color_theme" id="yellow"  data-color-class="yellow">
													<input class="theme_color" name="skin_theme_color[]"  type="checkbox" value="yellow" />
												</div>
												<div class="color_theme"  id="white"  data-color-class="white">
													<input class="theme_color" name="skin_theme_color[]" type="checkbox" value="white" />
												</div>
												<div class="color_theme" id="cafe" data-color-class="cafe">
													<input class="theme_color" name="skin_theme_color[]"   type="checkbox" value="cafe" />
												</div>
												<div class="color_theme"  id="purple" data-color-class="purple">
													<input class="theme_color" name="skin_theme_color[]"  type="checkbox" value="purple" />
												</div>
											<input type="hidden" name="theme_colors" id="theme_colors" value="<?php echo $settings[0]->theme_colors; ?>" />
											</div>
										</div>
									</div>									
								</div>							
						
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">Theme Transitions</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>	
								<div class="panel-body">	
								   <div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Transitions</label>									
											<div class="col-sm-8">
												<select name="theme_transition[]" id="theme_transition" class="form-control" multiple>
												 <option value="page-left-in"> page-left-in </option>
												 <option value="page-right-in"> page-right-in </option>
												 <option value="page-fade"> page-fade </option>
												 <option value="page-fade-only"> page-fade-only </option>
												</select>
											</div>
									</div>			
								</div>									
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-primary" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title">Theme Sidebar Settings</div>
									<div class="panel-options">
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									</div>
								</div>	
								<div class="panel-body">	
								   <div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Transitions</label>									
											<div class="col-sm-8">
												<select name="theme_sidebar" id="theme_sidebar" class="form-control" multiple>
												 <option value=""> sidebar-opened</option>
												 <option value="sidebar-collapsed"> sidebar-collapsed</option>
												</select>
											</div>
										</div>			
									</div>	
								</div>
							</div>
					<?php } ?>
					<div class="form-group default-padding">
						<input type="submit" class="btn btn-success" value="Save Changes">
						<input type="reset" class="btn btn-success" value="Reset"/>
					</div>
															
				</form>	
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
		<?php $this->load->view('general/chat');	?>	
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	
	<script>
	<?php if($settings[0]->theme_transitions != '') { 
		$theme_transitions_array = explode(",", $settings[0]->theme_transitions);
		foreach($theme_transitions_array as $theme_transitions){ ?>
			$("#theme_transition option[value='<?php echo $theme_transitions; ?>']").prop("selected", true);
	<?php } } ?>
	
	jQuery(document).ready(function($){  
		var icheck_skins = $(".icheck-skins .color_theme");
		icheck_skins.click(function(ev)	{
			ev.preventDefault();
			$(this).toggleClass('current');
		});
	});
	$(function(){
		var colors =[];
		if($('#theme_colors').val() != '' ) {
			var colorsArray = $('#theme_colors').val().split(",");
			for(var i=0; i < colorsArray.length; i++) {
				$("#"+colorsArray[i]).addClass('current');
				colors.push(colorsArray[i])
			}
		}
		$("input[name='skin_theme_color[]']").bind('click',function() {
			if($( "#"+$(this).val()).hasClass( "current" ) == false) {
				colors.push($(this).val());
				$('#theme_colors').val(colors);
			} else{
				colors.splice($.inArray($(this).val(),colors) ,1);
	            $('#theme_colors').val(colors);
	        }
	   });
	   
	   var site_title = document.getElementById('field-1');
	   var tag_line = document.getElementById('field-2');
	   
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
			}
			
			if(site_title.value < 2 || domain_name.value > 50) {
				site_title.style.border = "1px solid #f52c2c";   
				site_title.focus(); 
				return false; 
			}
		});		
			
		$('input#field-2').keyup(function() {
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
			}
			if(tag_line.value.length < 2 || tag_line.value.length > 50) {
				tag_line.style.border = "1px solid #f52c2c";   
				tag_line.focus(); 
				return false; 
			}
		});	
		$('#settings').submit(function() {
			var filter = /^[a-zA-Z ]*$/;
			if(site_title.value != ''){
				if(!(site_title.value.match(filter))){
					site_title.style.border = "1px solid #f52c2c";   
					site_title.focus(); 
					return false; 
				}
			} else {
				site_title.style.border = "1px solid #f52c2c";   
				site_title.focus(); 
				return false; 
			}
			
			if(site_title.value.length < 2 || site_title.value.length > 50) {
				site_title.style.border = "1px solid #f52c2c";   
				site_title.focus(); 
				return false; 
			}
			if(tag_line.value != ''){
				if(!(tag_line.value.match(filter))){
					tag_line.style.border = "1px solid #f52c2c";   
					tag_line.focus(); 
					return false; 
				}
			} else {
				tag_line.style.border = "1px solid #f52c2c";   
				tag_line.focus(); 
				return false; 
			}
			
			if(tag_line.value.length < 2 || tag_line.value.length > 50) {
				tag_line.style.border = "1px solid #f52c2c";   
				tag_line.focus(); 
				return false; 
			}
		}) ;	
    });		
</script>
	
</body>
</html>

