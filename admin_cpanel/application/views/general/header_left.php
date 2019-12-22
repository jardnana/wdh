<script type="text/javascript"> var loggofurl = '<?php echo site_url('login/logoff');?>'; </script>
<div class="row">				
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">					
		<ul class="user-info pull-left pull-none-xsm">					
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/logo_f.png" alt="" class="img-circle" width="150" height="50" /></a><a href="<?php echo site_url();?>">Utravel</a>							
				<ul class="dropdown-menu">
					<!-- Reverse Caret -->
					<li class="caret"></li>								
					<!-- Profile sub-links -->
					<li><a href="<?php echo site_url('dashboard/profile_info'); ?>"><i class="entypo-user"></i>Edit Profile</a></li>
					<li><a href="<?php echo site_url('dashboard/change_password'); ?>"><i class="entypo-mail"></i>Change Password</a></li>
<!--
					<li><a href="<?php echo site_url('dashboard/settings'); ?>"><i class="entypo-mail"></i>Ip Settings</a></li>
					<li><a href="<?php echo site_url('email/email_details'); ?>"><i class="entypo-mail"></i>Inbox</a></li>
					<li><a href="<?php echo site_url('calendar'); ?>"><i class="entypo-calendar"></i>Calendar</a></li>
					<li><a href="<?php echo site_url('search'); ?>"><i class="entypo-clipboard"></i>Search</a></li>
-->
					<li><a href="<?php echo site_url('dashboard/logs_activity'); ?>"><i class="entypo-clipboard"></i>Login Log's</a></li>
				</ul>
			</li>
		</ul>
		<?php if(false){ ?>
		<ul class="user-info pull-left pull-right-xs pull-none-xsm">
			<!-- Raw Notifications -->
			<li class="notifications dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-attention"></i>
					<span class="badge badge-info">2</span>
				</a>	
										
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
			<!-- Message Notifications -->
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
			<!-- Task Notifications -->
			<li class="notifications dropdown" style="display:none;"> 							
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-list"></i>
					<span class="badge badge-warning">1</span>
				</a>							
				<ul class="dropdown-menu">
					<li class="top">
						<p>You have 6 pending tasks</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller">
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">Procurement</span>
										<span class="percent">27%</span>
									</span>
								
									<span class="progress">
										<span style="width: 27%;" class="progress-bar progress-bar-success">
											<span class="sr-only">27% Complete</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">App Development</span>
										<span class="percent">83%</span>
									</span>
									
									<span class="progress progress-striped">
										<span style="width: 83%;" class="progress-bar progress-bar-danger">
											<span class="sr-only">83% Complete</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">HTML Slicing</span>
										<span class="percent">91%</span>
									</span>
									
									<span class="progress">
										<span style="width: 91%;" class="progress-bar progress-bar-success">
											<span class="sr-only">91% Complete</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">Database Repair</span>
										<span class="percent">12%</span>
									</span>
									
									<span class="progress progress-striped">
										<span style="width: 12%;" class="progress-bar progress-bar-warning">
											<span class="sr-only">12% Complete</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">Backup Create Progress</span>
										<span class="percent">54%</span>
									</span>
									
									<span class="progress progress-striped">
										<span style="width: 54%;" class="progress-bar progress-bar-info">
											<span class="sr-only">54% Complete</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">Upgrade Progress</span>
										<span class="percent">17%</span>
									</span>
									
									<span class="progress progress-striped">
										<span style="width: 17%;" class="progress-bar progress-bar-important">
											<span class="sr-only">17% Complete</span>
										</span>
									</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">See all tasks</a>
					</li>				
				</ul>											
			</li>
		</ul>
		<?php } ?>
	</div>
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">					
		<ul class="list-inline links-list pull-right">
			
			<!-- Language Selector -->			
			<li class="dropdown language-selector">
				
				Language: &nbsp;
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
					<img src="<?php echo base_url(); ?>assets/images/flag-uk.png" />
				</a>
				
				<ul class="dropdown-menu pull-right">
					<li class="active">
						<a href="#">
							<img src="<?php echo base_url(); ?>assets/images/flag-uk.png" />
							<span>English</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="sep"></li>
			
			<?php if(false){ ?>			
			<li>
				<a href="#" data-toggle="chat" data-animate="1" data-collapse-sidebar="1">
					<i class="entypo-chat"></i>
					Chat
					
					<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
				</a>
			</li>
			
			<li class="sep"></li>
			<?php } ?>
			<!-- system-selector -->			
			<li class="dropdown system-selector">
				System:&nbsp; 							
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
					<i class="entypo-layout"></i>
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="<?php echo site_url('login/logout');?>">
							<button>Log Out <i class="entypo-lock right"></i></button>
						</a>
					</li>
					<li>
						<form method="post" role="form" id="form_logoff">
							<input type="hidden" name="current_url" id="current_url" value="<?php echo base_url(uri_string()); ?>" />
							<button type="submit" style="margin-left: 12px;"> Log Off <i class="entypo-login"></i></button>
						</form>
					</li>
					<li>
						<a href="">
							<button>Reload <i class="entypo-cw"></i></button>
						</a>
					</li>
				</ul>
				
			</li>
			
		</ul>
	</div>
</div>
<hr />
