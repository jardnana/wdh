<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Login</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
	<!-- This is needed when you send requests via Ajax -->
	<script type="text/javascript"> var baseurl = '<?php echo site_url('login/login_check');?>'; </script>
</head>
<body class="page-body login-page login-form-fall" data-url="<?php echo PROVAB_URL; ?>">
	<div class="login-container">		
		<div class="login-header login-caret">			
			<div class="login-content">
				<a href="<?php echo site_url();?>" class="logo"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" /></a>
				<p class="description">Dear user, log in to access the admin area!</p>				
				<!-- progress bar indicator -->
				<div class="login-progressbar-indicator">
					<h3>43%</h3>
					<span>logging in...</span>
				</div>
			</div>
		</div>
		<div class="login-progressbar"><div></div></div>		
		<div class="login-form">			
			<div class="login-content">				
				<div class="form-login-error"><h3>Invalid login</h3><p>Ente proper login and password.</p></div>
				<form method="post" role="form" id="form_login">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="entypo-user"></i></div>
							<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
						</div>						
					</div>					
					<div class="form-group">						
						<div class="input-group">
							<div class="input-group-addon"><i class="entypo-key"></i></div>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
						</div>
					</div>					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block btn-login" style="padding: 5px 0px 3px 11px;"><i class="entypo-login"></i>Login In</button>
					</div>
					<?php if(false){ ?>
						<!-- Implemented in v1.1.4 -->
						<div class="form-group"><em>- or -</em></div>
						<div class="form-group">
							<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">Login with Facebook<i class="entypo-facebook"></i></button>
						</div>
						You can also use other social network buttons
						<div class="form-group">					
							<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">Login with Twitter<i class="entypo-twitter"></i></button>						
						</div>					
						<div class="form-group">					
							<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">Login with Google+<i class="entypo-gplus"></i></button>						
						</div>
					<?php } ?>
				</form>
				
				
				<div class="login-bottom-links">
					
					<a href="<?php echo site_url('login/forgot_password');?>" class="link">Forgot your password?</a>
					
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
