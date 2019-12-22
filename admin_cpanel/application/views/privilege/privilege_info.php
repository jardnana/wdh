<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $this->zaktravel['Header']['MetaTag']; ?>" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | <?php echo $this->zaktravel['roleManagement']['Privilege']; ?></title>	
	<!-- Load Default CSS and JS Scripts -->
	<link rel="stylesheet" href="<?php echo site_url();?>assets/css/_all.css">
	<?php $this->load->view('general/load_css');	?>	
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i><?php echo 'Home'; ?></a></li>
				<li><a href="<?php echo site_url()."roles/roles_list"; ?>"><?php echo 'RolesList'; ?></a></li>
				<li class="active"><strong><?php echo 'PrivilegesInfo'; ?></strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."privilege/add_privilege"; ?>"><?php echo 'AddNewPrivileges'; ?></a></li>
			</ol>
			<?php //echo "<pre>"; print_r($info); echo "</pre>"; ?>
			<div class="row">
			<form action="<?php echo site_url();?>roles/managePrivilege" method="post">
			<?php foreach($info as $parent)
			{ //echo "<pre>"; print_r($parent); echo "</pre>";  ?>
				<div class="col-sm-3">	
					<div class="panel panel-primary panel-body">
						<h4><?php echo $parent['dashboard_name'];?></h4>
						
						<ul class="icheck-list">
							<?php
								foreach($parent['dashboard_details'] as $key=>$child)
								{
									$this->db->select('dashboard_module_id'); 
									$where = array(
											"role_details_id" => $role_id,
											"dashboard_module_details_id" => $child['module_details_id']
									);
									$this->db->where($where);		
									$result=$this->db->get('privilege_details')->result();
									if(!empty($result))
									{
										$checked='checked="checked"';
									}
									else{ $checked='';}
									echo "<li><input tabindex='5' type='checkbox' class='icheck-11' id='minimal-checkbox-2-11' name='privilege_ids[]' value='".$child['module_details_id']." '".$checked."''/> ".' <label for="minimal-checkbox-2-11">'. $child['module_details_name'].'</label></li>';
								}
							?>
						</ul>
					</div>
				</div>	
			<?php } ?>
			<div class="clearfix"></div>
			<div class="col-sm-3">
				<input type="hidden" value="<?php echo $role_id;?>" name="role_id"/>
				<input type="submit" value="<?php echo 'SaveChanges'; ?>" class="btn btn-success"/>
				<a href="<?php echo site_url()."roles/roles_list"; ?>" class="btn btn-success"><?php echo 'Cancel'; ?></a>
			</div>
			</div>
			</form>
			<div class="clearfix"></div>
			
			
			
			
			
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script>
	jQuery(document).ready(function($)
	{
		$('input.icheck-11').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-yellow'
		});
	});
	</script>
	<script src="<?php echo site_url();?>assets/js/icheck.min.js"></script>
</body>
</html>
