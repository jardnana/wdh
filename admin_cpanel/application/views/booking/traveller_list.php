<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Booking</title>
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
				<li><a href="<?php echo site_url()."booking/orders"; ?>">Booking</a></li>
				<li class="active"><strong>Booking List</strong></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="booking_list4">
				
					<thead>
						<tr>
                            <th>S.No</th>
                            <th>Module</th>
                            <th>Confirmation No.</th>
                            <th>Booking Id</th>
                            <th>Gender</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>Actions</th>
                        </tr>
					</thead>					
                    <tbody>
                            <?php  if (!empty($traveler_details)) {
                                $c = 1;
                                for($a=0;$a<count($traveler_details->saladult);$a++){ ?>
                                <tr>
                                    <td><?php echo $a; ?></td>
                                    <td>FLIGHT</td>
                                    <td><?php echo $booking_list[0]->pnr_no; ?></td> 
                                    <td><?php echo $booking_list[0]->booking_number; ?></td> 
                                    <td><?php echo $traveler_details->genderadult[$a]; ?></td> 
                                    <td><?php echo $traveler_details->fnameadult[$a]; ?></td>
                                    <td><?php echo $traveler_details->mnameadult[$a]; ?></td>
                                    <td><?php echo $traveler_details->lnameadult[$a]; ?></td>
                                    <td><?php echo $traveler_details->dobmadult[$a]."-".$traveler_details->dobdadult[$a]." ".$traveler_details->dobyadult[$a]; ?></td>
                                    <td>
                                    
                                    <a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($booking_list[0]->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <?php if($booking_list[0]->booking_status == 'CONFIRMED') { ?>
                                    <a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($booking_list[0]->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                                        <span class="glyphicon glyphicon-remove-circle"></span>
                                    </a>
                                    <?php } ?>
                                    <a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($booking_list[0]->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
                                        <span class="glyphicon glyphicon-briefcase"></span>
                                    </a>
                                </td>
                            </tr>
                            <?php  } } ?>
                            <?php  if (!empty($traveler_details->salchild[0])) {
                                $c = 1;
                                for($a=0;$a<count($traveler_details->salchild);$a++){ ?>
                                <tr>
                                    <td><?php echo $a+1; ?></td>
                                    <td>FLIGHT</td>
                                    <td><?php echo $booking_list[0]->pnr_no; ?></td> 
                                    <td><?php echo $booking_list[0]->booking_number; ?></td> 
                                    <td><?php echo $traveler_details->genderchild[$a]; ?></td> 
                                    <td><?php echo $traveler_details->fnamechild[$a]; ?></td>
                                    <td><?php echo $traveler_details->mnamechild[$a]; ?></td>
                                    <td><?php echo $traveler_details->lnamechild[$a]; ?></td>
                                    <td><?php echo $traveler_details->dobmchild[$a]."-".$traveler_details->dobdchild[$a]." ".$traveler_details->dobychild[$a]; ?></td>
                                    <td>
                                    
                                    <a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($booking_list[0]->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <?php if($booking_list[0]->booking_status == 'CONFIRMED') { ?>
                                    <a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($booking_list[0]->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                                        <span class="glyphicon glyphicon-remove-circle"></span>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php  } } ?>
                            <?php  if (!empty($traveler_details->genderinfant[0])) {
                                $c = 1;
                                for($a=0;$a<count($traveler_details->genderinfant);$a++){ ?>
                                <tr>
                                    <td><?php echo $a; ?></td>
                                    <td>FLIGHT</td>
                                    <td><?php echo $booking_list[0]->pnr_no; ?></td> 
                                    <td><?php echo $booking_list[0]->booking_number; ?></td> 
                                    <td><?php echo $traveler_details->genderinfant[$a]; ?></td> 
                                    <td><?php echo $traveler_details->fnameinfant[$a]; ?></td>
                                    <td><?php echo $traveler_details->mnameinfant[$a]; ?></td>
                                    <td><?php echo $traveler_details->lnameinfant[$a]; ?></td>
                                    <td><?php echo $traveler_details->dobminfant[$a]."-".$traveler_details->dobdinfant[$a]." ".$traveler_details->dobyinfant[$a]; ?></td>
                                    <td>
                                    
                                    <a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($booking_list[0]->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <?php if($booking_list[0]->booking_status == 'CONFIRMED') { ?>
                                    <a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($booking_list[0]->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                                        <span class="glyphicon glyphicon-remove-circle"></span>
                                    </a>
                                    <?php } ?>
                                    <a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($booking_list[0]->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
                                        <span class="glyphicon glyphicon-briefcase"></span>
                                    </a>
                                </td>
                            </tr>
                            <?php  } } ?>
                        </tbody>
						<tfoot>
						<tr>
                           <th>S.No</th>
                            <th>Module</th>
                            <th>Confirmation No.</th>
                            <th>Booking Id</th>
                            <th>Gender</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>Actions</th>
                        </tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
			<?php $this->load->view('general/footer');	?>				
		</div>				
	</div>

	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
   
	<?php $this->load->view('general/load_js.php'); ?>
	
   <script>
	$(document).ready(function(){ 
		 $( ".formcont" ).click(function( e) {
		e.stopPropagation();
	});

		
	 });

</script>
	<script type="text/javascript">
		jQuery(document).ready(function($){	
			var table = $("#booking_list4").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
		});	
	</script>
 

</body>
</html>
