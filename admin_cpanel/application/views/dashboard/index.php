<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Admin</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		
		<div class="main-content">
		
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
				
				<div class="panel panel-primary" data-collapsed="0">
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">Admin Management</div>
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-4">
								<a href="<?php echo site_url("roles/roles_list"); ?>">
									<div class="tile-stats tile-brown">
										
										<h3>Roles Management</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url('admin/admin_list'); ?>">		
									<div class="tile-stats tile-green">
										
										<h3>Admin Management</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url('currency'); ?>">			
								<div class="tile-stats tile-purple">
										
										<h3>Currency Management</h3>
									</div>
								</a>					
							</div>
							<!--<div class="col-sm-4">
								<a href="<?php echo site_url('support/support_view'); ?>">			
								<div class="tile-stats tile-cyan">
										
										<h3>Support Ticket</h3>
									</div>
								</a>					
							</div>-->
						
						</div>
					</div>
				</div>
				
				<div class="panel panel-primary" data-collapsed="0">
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">Master File Management</div>
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-4">
								<a href="<?php echo site_url("airport"); ?>">
									<div class="tile-stats tile-brown">										
										<h3>Airport Management</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url('airline'); ?>">		
									<div class="tile-stats tile-green">
										
										<h3>Airline Management</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url('country'); ?>">			
								<div class="tile-stats tile-purple">
										
										<h3>Country Management</h3>
									</div>
								</a>					
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="panel panel-primary" data-collapsed="0">
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">Home Page CMS Section</div>
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					<!-- panel body -->

					<div class="panel-body">
						<div class="row">
							<div class="col-sm-4">
							<a href="<?php echo site_url().'flight_deals/'; ?>">			
								<div class="tile-stats tile-blue">
										
										<h3>Flight Deals</h3>
									</div>
								</a>					
							</div>
						<div class="col-sm-4">
							<a href="<?php echo site_url().'bestprice_deals'; ?>">			
								<div class="tile-stats tile-cyan">
										
										<h3>Our Best Price Deals</h3>
									</div>
								</a>					
							</div>
						 <div class="col-sm-4">
								<a href="<?php echo site_url().'simple_steps'; ?>">			
								<div class="tile-stats tile-red">
										
										<h3>Security Measures</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'recent_search'; ?>">
									<div class="tile-stats tile-yellow">
										
										<h3>Recent Search</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'flight_modules'; ?>">			
								<div class="tile-stats tile-green">
										
										<h3>Flight Modules Details</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'email/edit_mail_template/'; ?>">			
								<div class="tile-stats tile-orange">
										
										<h3>Email Template</h3>
									</div>
								</a>					
							</div>
							<!--<div class="col-sm-4">
								<a href="<?php echo site_url().'hotdeals/hot_deals_list'; ?>">
									<div class="tile-stats tile-blue">
										
										<h3>Hot Deals</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'lastminute/last_minute_list'; ?>">		
									<div class="tile-stats tile-yellow">
										
										<h3>Last Minute Deals</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'earlybooking/early_booking_list'; ?>">			
								<div class="tile-stats tile-red">
										
										<h3>Early Bookings</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'top_hotel_destinations/hotel_destinaitons_list'; ?>">			
								<div class="tile-stats tile-orange">
										
										<h3>Top Hotel Destinations</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'featureddeals/deal_list'; ?>">			
								<div class="tile-stats tile-pink">
										
										<h3>Featured Offers</h3>
									</div>
								</a>					
							</div>

							<div class="col-sm-4">
								<a href="<?php echo site_url().'simple_steps'; ?>">			
								<div class="tile-stats tile-purple">
										
										<h3>Security Measures</h3>
									</div>
								</a>					
							</div>
							<div class="col-sm-4">
								<a href="<?php echo site_url().'travel_education'; ?>">			
								<div class="tile-stats tile-plum">
										
										<h3>Travel Education</h3>
									</div>
								</a>					
							</div>-->
						
						</div>
					</div>
				</div>
				
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<?php // $this->load->view('dashboard/models'); ?>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.css">


</body>
</html>
