<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Forgot Password</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
	<!-- This is needed when you send requests via Ajax -->
	<script type="text/javascript"> var baseurl = '<?php echo site_url('login/login_check');?>'; </script>
</head>
<body class="page-body login-page login-form-fall" data-url="<?php echo PROVAB_URL; ?>">
	<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.html" class="logo">
				<img src="<?php echo base_url(); ?>assets/images/logo.png" width="120" alt="" />
			</a>
			
			<p class="description">Enter your email, and we will send the reset link.</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
		<div class="login-progressbar">
			<div></div>
		</div>
		
		<div class="login-form">
			
			<div class="login-content">
				
				<form method="post" role="form" id="form_forgot_password">
					
					<div class="form-forgotpassword-success">
						<i class="entypo-check"></i>
						<h3>Reset email has been sent.</h3>
						<p>Please check your email, reset password link will expire in 24 hours.</p>
					</div>
					
					<div class="form-steps">
						
						<div class="step current" id="step-1">
						
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-mail"></i>
									</div>
									
									<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" />
								</div>
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-info btn-block btn-login"  style="padding: 5px 0px 3px 11px;">
									Complete Registration
									<i class="entypo-right-open-mini"></i>
								</button>
							</div>
						
						</div>
						
					</div>
					
				</form>
				
				
				<div class="login-bottom-links">
					
					<a href="<?php echo site_url('');?>" class="link">
						<i class="entypo-lock"></i>
						Return to Login Page
					</a>
					
					<br />
					
					<a href="<?php echo PROVAB_URL; ?>"><?php echo PROJECT_NAME; ?></a>  - <a href="#">Privacy Policy</a>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
</body>
</html>
