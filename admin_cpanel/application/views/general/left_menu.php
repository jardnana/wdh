<?php $dashboard_module = $this->General_Model->get_left_menu_details(); ?>
		<div class="sidebar-menu  lee-sidebar lee-animated-sidebar">
        <div class="theiaStickySidebar">
			<header class="logo-env">				
				<!-- logo -->
				<div class="logo">
					<a href="<?php echo site_url('dashboard/dashboard'); ?>">
						<img class="logo_image" src="<?php echo base_url(); ?>assets/images/logo.png"  alt="" />
					</a>
				</div>			
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>
			</header>
			<ul id="main-menu" class="">
				<!-- add class "multiple-expanded" to allow multiple submenus to open -->
				<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
				<!-- Search Bar -->
				<li id="search"  style="display:none;">
					<form method="get" action="">
						<input type="text" name="q" class="search-input" placeholder="Search something..."/>
						<button type="submit">
							<i class="entypo-search"></i>
						</button>
					</form>
				</li>
				<?php if($dashboard_module!=''){ $i = 0; foreach($dashboard_module as $dashboard_item){ ?>	
					<li <?php  if($i == 0){ ?> class="active opened" <?php } ?>>
						<a href="#">									
							<i class="<?php echo $dashboard_item['dashboard_icon']; ?>"></i>
							<span><?php echo $dashboard_item['dashboard_name']; ?></span>
						</a>
						<?php if($dashboard_item['dashboard_details']!=''){ ?>
						<ul>
							<?php foreach($dashboard_item['dashboard_details'] as $dashboard_list){ ?>
								<li <?php  if($i == 0){ ?> class="active" <?php } ?>>
									<a href="<?php echo site_url().$dashboard_list['module_details_link']; ?>" >
										<span><?php echo $dashboard_list['module_details_name']; ?></span>
									</a>
								</li>
							<?php } ?>
						</ul>
						<?php } ?>
					</li>
				<?php $i++; }} ?>
			</ul>
		</div>   
         </div>
