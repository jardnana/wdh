<?php $dashboard_module = $this->General_Model->get_left_menu_details(); ?>
<script type="text/javascript"> var loggofurl = '<?php echo site_url('login/logoff');?>'; </script>
<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->	
	<div class="navbar-inner">	
		<!-- logo -->
		<div class="navbar-brand">
			<a><img src="<?php echo base_url(); ?>assets/images/logo_f.png" width="150"  height="50" alt="" /></a>
		</div>
		<!-- main menu class="opened active" -->
		<ul class="navbar-nav">
			<?php if($dashboard_module!=''){ $i = 0; foreach($dashboard_module as $dashboard_item){ if($i==6){ break;}?>	
				<li <?php  if($i == 0){ ?> class="active opened" <?php } ?>>
					<a href="#">									
						<i class="<?php echo $dashboard_item['dashboard_icon']; ?>"></i>
						<span><?php echo $dashboard_item['dashboard_name']; ?></span>
					</a>
					<?php if($dashboard_item['dashboard_details']!=''){ ?>
					<ul>
						<?php foreach($dashboard_item['dashboard_details'] as $dashboard_list){ ?>
							<li <?php  if($i == 0){ ?> class="active" <?php } ?>>
								<a href="<?php echo site_url().$dashboard_list['module_details_link']; ?>">
									<span><?php echo $dashboard_list['module_details_name']; ?></span>
								</a>
							</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
			<?php $i++; }} ?>
			<!-- Search Bar -->
			<li id="search" class="search-input-collapsed" style="display:none;">
				<!-- add class "search-input-collapsed" to auto collapse search input -->
				<form method="get" action="">
					<input type="text" name="q" class="search-input" placeholder="Search something..."/>
					<button type="submit">
						<i class="entypo-search"></i>
					</button>
				</form>
			</li>
		</ul>
		<!-- notifications and other links -->
		<ul class="nav navbar-right pull-right">
			
			<!-- dropdowns -->
			<li class="dropdown">
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-list"></i>
					<span class="badge badge-info">2</span>
				</a>
				
				<!-- dropdown menu (tasks) -->
				<ul class="dropdown-menu">
					<li class="top">
						<p class="small">
							<a href="#" class="pull-right">Mark all Read</a>
							You have <strong>1</strong> new notifications.
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller">
							<li class="unread notification-success">
								<a href="#">
									<i class="entypo-user-add pull-right"></i>
									<span class="line"><strong>New user registered</strong></span>									
									<span class="line small">30 seconds ago</span>
								</a>
							</li>
							<li class="notification-primary">
								<a href="#">
									<i class="entypo-user pull-right"></i>
									<span class="line">Privacy settings have been changed</span>
									<span class="line small">3 hours ago</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">View all notifications</a>
					</li>				
				</ul>							
			</li>
			<li class="dropdown">
			<li class="notifications dropdown">							
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-mail"></i>
					<span class="badge badge-secondary">200</span>
				</a>							
				<ul class="dropdown-menu">
					<li>
						<ul class="dropdown-menu-list scroller">
							<li class="active">
								<a href="<?php echo site_url('email/email_content/1');?>">
									<span class="image pull-right"><img src="<?php echo base_url(); ?>assets/images/thumb-1@2x.png" width="50px" height="40px" alt="" class="img-circle" /></span>
									<span class="line"><strong> MAILER-DAEMON</strong></span>
									<span class="line desc small">failure notice</span>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('email/email_content/2');?>">
									<span class="image pull-right"><img src="<?php echo base_url(); ?>assets/images/thumb-1@2x.png" width="50px" height="40px" alt="" class="img-circle" /></span>
									<span class="line">MAILER-DAEMON</span>
									<span class="line desc small">failure notice</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="<?php echo site_url('email/email_details');?>">All Messages</a>
					</li>				
				</ul>							
			</li>
			
			<!-- raw links -->
			<li class="dropdown">
				<li>
					<a href="http://www.provab.com/">Live Site</a>
				</li>
			</li>
			<li class="sep"></li>
			<!-- system-selector -->			
			<li class="dropdown system-selector">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
					<i class="entypo-layout"></i>
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="<?php echo site_url('login/logout');?>">
							Log Out <i class="entypo-lock right"></i>
						</a>
					</li>
					<li>
						<form method="post" role="form" id="form_logoff">
							<input type="hidden" name="current_url" value="<?php echo base_url(uri_string()); ?>" />
							Log off <i class="entypo-logout right"></i>
						</form>
					</li>
					<li>
						<a href="">
							Reload <i class="entypo-cw"></i>
						</a>
					</li>
				</ul>
				
			</li>
			<!-- mobile only -->
			<li class="visible-xs">	
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="horizontal-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>
				
			</li>
		</ul>
	</div>
</header>	
