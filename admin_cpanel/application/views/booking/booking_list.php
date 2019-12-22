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
				<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
					<li class="active">
						<a href="#ALL" data-toggle="tab">
							<span class="visible-xs"><i class="entypo-home"></i></span>
							<span class="hidden-xs">ALL</span>
						</a>
					</li>
					<li>
						<a href="#CONFIRMED" data-toggle="tab">
							<span class="visible-xs"><i class="entypo-user"></i></span>
							<span class="hidden-xs">CONFIRMED</span>
						</a>
					</li>
					<li>
						<a href="#FAILED" data-toggle="tab">
							<span class="visible-xs"><i class="entypo-user"></i></span>
							<span class="hidden-xs">FAILED</span>
						</a>
					</li>
					<li>
						<a href="#PROCESS" data-toggle="tab">
							<span class="visible-xs"><i class="entypo-mail"></i></span>
							<span class="hidden-xs">PROCESS</span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="ALL">
						<table class="table table-bordered datatable" id="booking_list1">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</thead>					
							<tbody>
									<?php  if (!empty($booking_list)) {
										$c = 1;
										foreach ($booking_list as $ab) { $traveler_details = json_decode(base64_decode($ab->traveler_details)); // echo '<pre/>';print_r($traveler_details->fnameadult[0]);exit;?>
										
										<tr>
											<td><?php echo $c; ?></td>
											<td>FLIGHT</td>
											<td><?php echo $traveler_details->fnameadult[0]." ".$traveler_details->lnameadult[0]; ?></td> 
											<td><?php echo $ab->pnr_no; ?></td>
											<td><?php echo $ab->booking_number; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->api_price; ?></td>
											<td><?php echo CURR_ICON.''.$ab->admin_markup; ?></td>
											<td><?php if($ab->payment_mode == ''){ echo "COD"; }else{ echo $ab->payment_mode; } ?></td>
											<td><?php echo $ab->booking_date; ?></td>
											<td><?php echo $ab->booking_status; ?></td>
											<td><?php echo $ab->PolicyId; ?></td>
											<td><?php echo $ab->PolicyNumber; ?></td>
											<td><?php echo $ab->ProductName; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_premium_amount; ?></td>
											<td><?php echo $ab->PrimaryInsured; ?></td>
											<td>
											
											<a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
											<?php if($ab->booking_status == 'CONFIRMED') { ?>
											<a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($ab->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
												<span class="glyphicon glyphicon-remove-circle"></span>
											</a>
											<?php } ?>
											<a href="<?php echo site_url().'booking/view_traveller_info/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Traveller Details' target="_blank">
												<span class="glyphicon glyphicon-user"></span>
											</a>
											<a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
												<span class="glyphicon glyphicon-briefcase"></span>
											</a>
											
											<div class="rndpopup" id="rndpopup<?php echo $c; ?>" style="display:none">
												<div class="formcont">
														<form action="<?php echo base_url()?>booking/email_voucher" method="post"> 
															<div class="labname">Enter Your Email ID</div>
																<div style="padding:0px 10px 0px 10px">
																	<input id="email" class="form-control logpadding" type="text" required="" placeholder="Email ID" name="email" aria-required="true">
																</div>
																<input type="hidden" name="pnr_no" value="<?php echo $ab->pnr_no; ?>">
																<input type="hidden" name="parent_pnr1" value="<?php echo base64_encode(json_encode($ab->parent_pnr));?>">
															<button class="viwedetsb mrgspe" type="submit">Submit</button>
														</form>
												</div>
											</div>
											<a id="btnclick<?php echo $c; ?>" class="btnclick btn btn-primary btn-xs has-tooltip" title="Mail Voucher"><span class="glyphicon glyphicon-envelope"></span> </a>   
										</td>
									</tr>
									<?php $c++; }  } ?>
								</tbody>
							<tfoot>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="tab-pane" id="CONFIRMED">
							<table class="table table-bordered datatable" id="booking_list2">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</thead>					
							<tbody>
									<?php  if (!empty($booking_list)) {
										$c = 1; $total_amount = 0;
										foreach ($booking_list as $ab) { if($ab->booking_status == "CONFIRMED"){ $traveler_details = json_decode(base64_decode($ab->traveler_details)); // echo '<pre/>';print_r($traveler_details->fnameadult[0]);exit;?>
										
										<tr>
											<td><?php echo $c; ?></td>
											<td>FLIGHT</td>
											<td><?php echo $traveler_details->fnameadult[0]." ".$traveler_details->lnameadult[0]; ?></td> 
											<td><?php echo $ab->pnr_no; ?></td>
											<td><?php echo $ab->booking_number; ?></td>
											<td><?php $total_amount += $ab->total_amount;  echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->api_price; ?></td>
											<td><?php echo CURR_ICON.''.$ab->admin_markup; ?></td>
											<td><?php if($ab->payment_mode == ''){ echo "COD"; }else{ echo $ab->payment_mode; } ?></td>
											<td><?php echo $ab->booking_date; ?></td>
											<td><?php echo $ab->booking_status; ?></td>
											<td><?php echo $ab->PolicyId; ?></td>
											<td><?php echo $ab->PolicyNumber; ?></td>
											<td><?php echo $ab->ProductName; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_premium_amount; ?></td>
											<td><?php echo $ab->PrimaryInsured; ?></td>
											<td>
											
											<a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
											<?php if($ab->booking_status == 'CONFIRMED') { ?>
											<a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($ab->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
												<span class="glyphicon glyphicon-remove-circle"></span>
											</a>
											<?php } ?>
											<a href="<?php echo site_url().'booking/view_traveller_info/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Traveller Details' target="_blank">
												<span class="glyphicon glyphicon-user"></span>
											</a>
											<a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
												<span class="glyphicon glyphicon-briefcase"></span>
											</a>
											
											<div class="rndpopup" id="rndpopup<?php echo $c; ?>" style="display:none">
												<div class="formcont">
														<form action="<?php echo base_url()?>booking/email_voucher" method="post"> 
															<div class="labname">Enter Your Email ID</div>
																<div style="padding:0px 10px 0px 10px">
																	<input id="email" class="form-control logpadding" type="text" required="" placeholder="Email ID" name="email" aria-required="true">
																</div>
																<input type="hidden" name="pnr_no" value="<?php echo $ab->pnr_no; ?>">
																<input type="hidden" name="parent_pnr1" value="<?php echo base64_encode(json_encode($ab->parent_pnr));?>">
															<button class="viwedetsb mrgspe" type="submit">Submit</button>
														</form>
												</div>
											</div>
											<a id="btnclick<?php echo $c; ?>" class="btnclick btn btn-primary btn-xs has-tooltip" title="Mail Voucher"><span class="glyphicon glyphicon-envelope"></span> </a>   
										</td>
									</tr>
									<?php $c++; } }  } ?>
								</tbody>
							<tfoot>
								<tr>
									<th><?php echo count($booking_list); ?></th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th><?php echo $total_amount; ?></th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</tfoot>
						</table>					
					</div>
					<div class="tab-pane" id="FAILED">
							<table class="table table-bordered datatable" id="booking_list3">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</thead>					
							<tbody>
									<?php  if (!empty($booking_list)) {
										$c = 1;
										foreach ($booking_list as $ab) { if($ab->booking_status == ""){ $traveler_details = json_decode(base64_decode($ab->traveler_details)); // echo '<pre/>';print_r($traveler_details->fnameadult[0]);exit;?>
										
										<tr>
											<td><?php echo $c; ?></td>
											<td>FLIGHT</td>
											<td><?php echo $traveler_details->fnameadult[0]." ".$traveler_details->lnameadult[0]; ?></td> 
											<td><?php echo $ab->pnr_no; ?></td>
											<td><?php echo $ab->booking_number; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->api_price; ?></td>
											<td><?php echo CURR_ICON.''.$ab->admin_markup; ?></td>
											<td><?php if($ab->payment_mode == ''){ echo "COD"; }else{ echo $ab->payment_mode; } ?></td>
											<td><?php echo $ab->booking_date; ?></td>
											<td><?php echo $ab->booking_status; ?></td>
											<td><?php echo $ab->PolicyId; ?></td>
											<td><?php echo $ab->PolicyNumber; ?></td>
											<td><?php echo $ab->ProductName; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_premium_amount; ?></td>
											<td><?php echo $ab->PrimaryInsured; ?></td>
											<td>
											
											<a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
											<?php if($ab->booking_status == 'CONFIRMED') { ?>
											<a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($ab->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
												<span class="glyphicon glyphicon-remove-circle"></span>
											</a>
											<?php } ?>
											<a href="<?php echo site_url().'booking/view_traveller_info/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Traveller Details' target="_blank">
												<span class="glyphicon glyphicon-user"></span>
											</a>
											<a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
												<span class="glyphicon glyphicon-briefcase"></span>
											</a>
											
											<div class="rndpopup" id="rndpopup<?php echo $c; ?>" style="display:none">
												<div class="formcont">
														<form action="<?php echo base_url()?>booking/email_voucher" method="post"> 
															<div class="labname">Enter Your Email ID</div>
																<div style="padding:0px 10px 0px 10px">
																	<input id="email" class="form-control logpadding" type="text" required="" placeholder="Email ID" name="email" aria-required="true">
																</div>
																<input type="hidden" name="pnr_no" value="<?php echo $ab->pnr_no; ?>">
																<input type="hidden" name="parent_pnr1" value="<?php echo base64_encode(json_encode($ab->parent_pnr));?>">
															<button class="viwedetsb mrgspe" type="submit">Submit</button>
														</form>
												</div>
											</div>
											<a id="btnclick<?php echo $c; ?>" class="btnclick btn btn-primary btn-xs has-tooltip" title="Mail Voucher"><span class="glyphicon glyphicon-envelope"></span> </a>   
										</td>
									</tr>
									<?php $c++; }} } ?>
								</tbody>
							<tfoot>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="tab-pane" id="PROCESS">
							<table class="table table-bordered datatable" id="booking_list4">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</thead>					
							<tbody>
									<?php  if (!empty($booking_list)) {
										$c = 1;
										foreach ($booking_list as $ab) {if($ab->booking_status == "PROCESS"){ $traveler_details = json_decode(base64_decode($ab->traveler_details)); // echo '<pre/>';print_r($traveler_details->fnameadult[0]);exit;?>
										
										<tr>
											<td><?php echo $c; ?></td>
											<td>FLIGHT</td>
											<td><?php echo $traveler_details->fnameadult[0]." ".$traveler_details->lnameadult[0]; ?></td> 
											<td><?php echo $ab->pnr_no; ?></td>
											<td><?php echo $ab->booking_number; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_amount; ?></td>
											<td><?php echo CURR_ICON.''.$ab->api_price; ?></td>
											<td><?php echo CURR_ICON.''.$ab->admin_markup; ?></td>
											<td><?php if($ab->payment_mode == ''){ echo "COD"; }else{ echo $ab->payment_mode; } ?></td>
											<td><?php echo $ab->booking_date; ?></td>
											<td><?php echo $ab->booking_status; ?></td>
											<td><?php echo $ab->PolicyId; ?></td>
											<td><?php echo $ab->PolicyNumber; ?></td>
											<td><?php echo $ab->ProductName; ?></td>
											<td><?php echo CURR_ICON.''.$ab->total_premium_amount; ?></td>
											<td><?php echo $ab->PrimaryInsured; ?></td>
											<td>
											
											<a href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="_blank">
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
											<?php if($ab->booking_status == 'CONFIRMED') { ?>
											<a onclick="return confirm('Are you sure  ?')" href="<?php echo site_url(); ?>booking/cancel/<?php echo base64_encode(json_encode($ab->parent_pnr));?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
												<span class="glyphicon glyphicon-remove-circle"></span>
											</a>
											<?php } ?>
											<a href="<?php echo site_url().'booking/view_traveller_info/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Traveller Details' target="_blank">
												<span class="glyphicon glyphicon-user"></span>
											</a>
											<a href="<?php echo site_url().'booking/view_billing_details/'.base64_encode(json_encode($ab->parent_pnr)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Billing and Card Details' target="_blank">
												<span class="glyphicon glyphicon-briefcase"></span>
											</a>
											
											<div class="rndpopup" id="rndpopup<?php echo $c; ?>" style="display:none">
												<div class="formcont">
														<form action="<?php echo base_url()?>booking/email_voucher" method="post"> 
															<div class="labname">Enter Your Email ID</div>
																<div style="padding:0px 10px 0px 10px">
																	<input id="email" class="form-control logpadding" type="text" required="" placeholder="Email ID" name="email" aria-required="true">
																</div>
																<input type="hidden" name="pnr_no" value="<?php echo $ab->pnr_no; ?>">
																<input type="hidden" name="parent_pnr1" value="<?php echo base64_encode(json_encode($ab->parent_pnr));?>">
															<button class="viwedetsb mrgspe" type="submit">Submit</button>
														</form>
												</div>
											</div>
											<a id="btnclick<?php echo $c; ?>" class="btnclick btn btn-primary btn-xs has-tooltip" title="Mail Voucher"><span class="glyphicon glyphicon-envelope"></span> </a>   
										</td>
									</tr>
									<?php $c++; } } } ?>
								</tbody>
							<tfoot>
								<tr>
									<th>S.No</th>
									<th>Module</th>
									<th>Name</th>
									<th>Confirmation No.</th>
									<th>Booking Id</th>
									<th>Amount</th>
									<th>Selling Price</th>
									<th>Net Price</th>
									<th>Profit</th>
									<th>Payment Mode</th>
									<th>Booking Date</th>
									<th>Booking Status</th>
									<th>Policy Id</th>
									<th>Policy Number</th>
									<th>Product Name</th>
									<th>Premium Amount</th>
									<th>Primary Insured</th>
									<th>Actions</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
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
		<?php $c = 0; foreach ($booking_list as $ab) { ?>
		 $('#btnclick<?php echo $c; ?>').click(function() {
			$('#rndpopup<?php echo $c; ?>').fadeIn();
		});
		 $('#rndpopup<?php echo $c; ?>').click(function() {
			$('#rndpopup<?php echo $c; ?>').fadeOut();
		});
		 <?php $c++; } ?>

		 $( ".formcont" ).click(function( e) {
	  e.stopPropagation();
	});

		
	 });

</script>
	<script type="text/javascript">
		jQuery(document).ready(function($){	
			var table = $("#booking_list1").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
			
			var table = $("#booking_list2").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
			
			var table = $("#booking_list3").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"oTableTools": {
				},
			});
			table.columnFilter({
				"sPlaceHolder" : "head:after"
			});
			
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
