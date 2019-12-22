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
	<!-- This is needed when you send requests via Ajax -->
	<script type="text/javascript"> var baseurl = '<?php echo site_url('login/login_check');?>'; </script>
</head>
<body class="page-body login-page login-form-fall" data-url="<?php echo PROVAB_URL; ?>">
	<div class="login-container">		
		<div class="login-header login-caret">			
			<div class="login-content">				
				<a href="index.html" class="logo">
					<img src="<?php echo base_url(); ?>assets/images/logo@2x.png" width="120" alt="" />
				</a>				
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
				<div class="error-symbol" style="font-size: 70px;"><i class="entypo-attention"></i></div>			
				<div class="form-login-error" style="display:block;"><h3>404 : Page Not Found</h3></div>
				<div class="login-bottom-links"><a href="<?php echo PROVAB_URL; ?>"><?php echo PROJECT_NAME; ?></a>  - <a href="#">Privacy Policy</a></div>
			</div>
		</div>
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
</body>
</html>
