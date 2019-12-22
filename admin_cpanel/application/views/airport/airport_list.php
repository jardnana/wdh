<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Airport</title>	
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
				<li><a href="<?php echo site_url()."airport"; ?>">airport</a></li>
				<li class="active"><strong>Airport List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."airport/add_airport"; ?>">Add New Airport</a></li>
			</ol>
			  <div class="col-md-12">
				<select name="country" class="" onchange="display_airport(this.value)">
					<?php if($countyr_list!=''){ for($d=0;$d<count($countyr_list);$d++){ ?>
					<option value="<?php echo str_replace(" ","-",$countyr_list[$d]->country); ?>" <?php if(str_replace(" ","-",$countyr_list[$d]->country) == $country){ echo "selected"; } ?> data-iconurl=""><?php echo $countyr_list[$d]->country; ?></option>
						<?php }} ?>
				</select>
			</div>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="airport_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Airport Name</th>
							<th>Airport Code</th>
							<th>Airport City</th>
							<th>Country</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Airport Name</th>
							<th>Airport Code</th>
							<th>Airport City</th>
							<th>Country</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($airport_list!=''){ for($a=0;$a<count($airport_list);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $airport_list[$a]->airport_name; ?></td>
							<td><?php echo $airport_list[$a]->airport_code; ?></td>
							<td><?php echo $airport_list[$a]->airport_city; ?></td>
							<td><?php echo $airport_list[$a]->country; ?></td>
							<td>
								<?php if($airport_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-red btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($airport_list[$a]->status == "ACTIVE"){ ?>
									<a href="<?php echo site_url()."airport/inactive_airport/".base64_encode(json_encode($airport_list[$a]->airport_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."airport/active_airport/".base64_encode(json_encode($airport_list[$a]->airport_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."airport/edit_airport/".base64_encode(json_encode($airport_list[$a]->airport_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."airport/delete_airport/".base64_encode(json_encode($airport_list[$a]->airport_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
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
			var table = $("#airport_list").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
		});	
		function display_airport(country_name)
		{
			if(country_name != ''){
				window.location = '<?php echo site_url();?>airport/index/'+country_name;
			}
		}	
	</script>
</body>
</html>
