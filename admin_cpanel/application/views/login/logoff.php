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
	<script type="text/javascript"> var pageurl = '<?php echo site_url('login/lock_screen');?>'; </script>
</head>
<body class="page-body login-page is-lockscreen login-form-fall" data-url="<?php echo PROVAB_URL; ?>">
	
	<div class="login-container">
		
		<div class="login-header">			
			<div class="login-content">
				
				<a href="#" class="logo">
					<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="100" />
				</a>
				
				<p class="description">Dear <?php echo PAGE_TITLE; ?>, enter your password to unlock the screen!</p>
				
				<!-- progress bar indicator -->
				<div class="login-progressbar-indicator">
					<h3>0%</h3>
					<span>logging in...</span>
				</div>
			</div>
			
		</div>
		
		<div class="login-form">
			
			<div class="login-content">
				
				<form method="post" role="form" id="form_lockscreen">
					
					<div class="form-group lockscreen-input">
						
						<div class="lockscreen-thumb" style="min-height: 80px;">
							<img src="<?php echo base_url(); ?>assets/images/logo@2x.png" class="img-circle" />
							<div class="lockscreen-progress-indicator">0%</div>
						</div>
						
						<div class="lockscreen-details">
							<h4><?php echo PAGE_TITLE; ?></h4>
							<span data-login-text="logging in...">logged off</span>
						</div>
						
					</div>
					
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-key"></i>
							</div>
							
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
						</div>
					
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block btn-login"  style="padding: 5px 0px 3px 11px;">
							<i class="entypo-login"></i>
							Login In
						</button>
					</div>
					
				</form>
				
				
				<div class="login-bottom-links">
					
					<a href="<?php echo site_url('login/logout');?>" class="link">Sign in using different account <i class="entypo-right-open"></i></a>
					
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
