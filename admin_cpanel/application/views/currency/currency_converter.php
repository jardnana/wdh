<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | CMS Management</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body id="top" oncontextmenu="return true" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."currency"; ?>">Currency Converter</a></li>
				<li class="active"><strong>Curency List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."currency/add_currency"; ?>">Add New Currency</a> / <a href="#" onclick="update_currency()">Update Currency</a></li>
			</ol>
            <div class="row" id="black_grid" style="overflow-x: scroll;">
				<div id="small_preloader" align="center" style="display:none;"><h2>Updating Currency.....,Please Wait.....</h2></div>
				<table class="table table-bordered datatable" id="city_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Currency Code</th>
							<th>Symbol</th>
							<th>Currency Name</th>
							<th>Value</th>
							<th>Actions</th>
						</tr>
						<tr class="replace-inputs">
							<th>Sl No</th>
							<th>Currency Code</th>
							<th>Symbol</th>
							<th>Currency Name</th>
							<th>Value</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($currency)){ $c=1; foreach($currency as $currencies){?>
						<tr>
							<td><?php echo $c; ?></td>
							<td><?php echo $currencies->currency_code; ?></td>
							<td><?php echo $currencies->country_code; ?></td>
							<td><?php echo $currencies->currency_name; ?></td>
							<td><?php echo $currencies->value; ?></td>
							<td class="center">
								<a href="<?php echo site_url()."currency/edit_currency/".base64_encode(json_encode($currencies->cur_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."currency/delete_currency/".base64_encode(json_encode($currencies->cur_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
                        </tr>
                        <?php $c++;} } ?>
                    </tbody>
                </table>
            </div>
          <!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Chat Module -->
			<?php $this->load->view('general/chat');	?>	
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
			var table = $("#city_list").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
		});		
		function update_currency() {
			if (confirm("Are you sure you want to update Currency?")){
				$.ajax({
					url:'<?php echo site_url(); ?>currency/ConverCurrency_Layer/',
					data: '',
					beforeSend:function(){
						$('#small_preloader').fadeIn('slow');
						$('#black_grid').fadeIn('slow');
					},
					success: function(result){
						$('#black_grid').fadeOut('slow');
						$('#small_preloader').fadeOut('slow');
						if (result == 'success') {
							alert('Currency updated Successfully'); window.location = '<?php echo site_url(); ?>currency';
						}else{
							alert(result); window.location = '<?php echo site_url(); ?>currency';
						}
					}
				});
			}
		}
	</script>
</body>
</html>

