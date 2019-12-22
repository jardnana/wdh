<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Header Menu</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."header/header_list"; ?>">Header</a></li>
				<li class="active"><strong>Header Menu List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."header/add_header"; ?>">Add New Header Menu</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Menu Name</th>
							<th>Menu Type</th>
							<th>Menu URL</th>
							<th>Menu Level</th>
							<th>Position</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Menu Name</th>
							<th>Menu Type</th>
							<th>Menu URL</th>
							<th>Menu Level</th>
							<th>Position</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($header_list!=''){ for($a=0;$a<count($header_list);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $header_list[$a]->header_name; ?></td>
							<td><?php echo $header_list[$a]->link_type; ?></td>
							<td><?php echo $header_list[$a]->link; ?></td>
							<td><?php echo $header_list[$a]->menu_level; ?></td>
							<td><?php echo $header_list[$a]->position; ?></td>
							<td>
								<?php if($header_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($header_list[$a]->status == "ACTIVE"){ ?>
									<a href="<?php echo site_url()."header/inactive_header/".base64_encode(json_encode($header_list[$a]->header_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."header/active_header/".base64_encode(json_encode($header_list[$a]->header_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."header/edit_header/".base64_encode(json_encode($header_list[$a]->header_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."header/delete_header/".base64_encode(json_encode($header_list[$a]->header_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
								<?php if($header_list[$a]->menu_level !='0'){ ?>
									<a onclick="view_menu_details('<?php echo $header_list[$a]->header_details_id; ?>','<?php echo $header_list[$a]->menu_level; ?>')" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-check"></i>View Menu</a>
								<?php } ?>
							</td>
						</tr>
					<?php }} ?>												
					</tbody>
				</table>
			</div>
			<div class="row" id="sub_menu"></div>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li class="active"><strong>Logo Management</strong></li>
				<!--<li class="active" style="float:right;"><a href="<?php echo site_url()."header/add_logo"; ?>">Add New Logo</a></li>-->
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Logo Name</th>
							<th>Logo</th>
							<th>Logo Url</th>
							<th>Start Date</th>
							<th>End Date</th>
						</tr>
					</thead>
					<tbody>
					<?php if($logo_list!=''){ for($a=0;$a<count($logo_list);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $logo_list[$a]->logo_name; ?></td>
							<td class="center" style="background-color: burlywood;"><a href="<?php echo base_url(); ?>uploads/logo/<?php echo $logo_list[$a]->logo_image; ?>" download><img src="<?php echo base_url(); ?>uploads/logo/<?php echo $logo_list[$a]->logo_image; ?>" alt="Domain Logo" width="300" height="50"></a></td>
							<td><?php echo $logo_list[$a]->logo_url; ?></td>
							<td><?php echo $logo_list[$a]->logo_start_date; ?></td>
							<td><?php echo $logo_list[$a]->logo_end_date; ?></td>
						</tr>
					<?php }} ?>												
					</tbody>
				</table>
			</div>
			
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			var table = $("#api_list").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
		});
		function view_menu_details(header_id, menu_level){
			$.ajax({  // ajax call starts
				  url: "<?php echo site_url(); ?>header/view_menu_details/"+header_id+"/"+menu_level,
				  success: function(data){
						$('#sub_menu').show();
						$('#sub_menu').html(data);
				  }      
			});	
		}
	</script>
</body>
</html>
