<html>
    <head>
        <title><?php if(PAGE_TITLE != '') echo PAGE_TITLE." | "; ?>Flight Voucher</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
		<?php $this->load->view('general/load_css');	?>

<link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen">
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> sidebar-collapsed">
<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
<div class='main-content'>
<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
<section id='content'><div class='container'>    
	<div class="full marintopcnt contentvcr" id="voucher">
		<div class="container"><div class="container offset-0">
			<div class="centervoucher2">
				<div class="col-md-12">
					<div class="alliconfrmt"><a class="tooltipv iconsofvcr icon icon-print" title="Print Voucher" onclick="PrintDiv();"></a></div>
				</div>
				<div class="clear"></div>
				<div class="col-md-6">
					<div class="vocrlogo">
						<img src="<?php echo base_url(); ?>assets/images/logo (2).png" alt="Fly 2 Escape" />
					</div>
				</div>
				<div class="col-md-6">
					<?php $contact_detail_list  = $this->Booking_Model->get_contactus_detail_list(); 
					if($contact_detail_list!=''){?> 
						<div class="scont">  <span class="addresof clrimp">
							<?php $variable_exploded = explode(", ", $contact_detail_list->address);
							foreach($variable_exploded as $var_add){
								echo $var_add."<br/>";
							}
							?>
						</span> </div>
						<div class="scont">  <span class="addresof clrimp"><?php echo wordwrap($contact_detail_list->contact_number , 3 , ' ' , true );?></span> </div>
						<div class="scont"><span class="addresof2 clrimp"><?php echo $contact_detail_list->email_id;?></span> 
					</div>
					<?php }else {?>
						<div class="scont">  <span class="addresof">No.46, Imyown Street,<br>
						your address Imyown Street<br>G.R.A. Ikeja. </span> </div>
						<div class="scont"> <span class="fa fa-phone"></span> 
						<span class="addresof ">234 567 8900</span>
					</div>
					<div class="scont">  
						<span class="addresof2">info@fly2escape.com</span> 
					</div>
				<?php } ?>
				</div>
				<div class="clear"></div><br />
				<div class="col-md-12">
				<?php //echo "<pre>"; print_r($Booking); exit;?>
					<table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
						<tbody>
							<tr>
								<td align="left"></td>
								<td align="right" style="font-size:13px; line-height:20px;"></td>
							</tr>
							<tr><td colspan="2" style="border:0px; border-top:1px dashed #CCC;">
								<table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
									<tbody>
										<tr><td width="100%" style="line-height:22px;text-align:center;color:#333333"><div class="confirmtionltr"><strong>Confirmation Letter</strong></div></td></tr>
										<br/>
										<tr><td align="center">
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tbody>
													<tr><td width="50%" align="left" valign="top">
														<table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
															<tbody>
															<br/>
																<tr><td colspan="2" align="left">
																	<div class="grngv ">Hello, <strong style="font-size:18px;"><?php echo $Booking->billing_first_name.'&nbsp;'.$Booking->billing_last_name;?></strong><br />
																	</div>
																</td></tr>
																<tr>
																	<td class="colsdets" width="50%" align="left">Confirmation Number  :</td>
																	<td class="colsdets" width="50%" align="left">
																		<strong><?php echo $Booking->pnr_no;?></strong>
																	</td>
																</tr>
																<tr>
																	<td class="colsdets" width="50%" align="left">Booking Status  :</td>
																	<td class="colsdets" width="50%" align="left">
																		<strong><?php echo $Booking->booking_status;?></strong>
																	</td>
																</tr>
															</tbody>
														</table>
													</td></tr>
												</tbody>
											</table>
										</td></tr>
									<?php
									$sightseen = $this->General_Model->get_ExcursionBooking_det($Booking->booking_sightseen_id)->result();
									$dep = strtotime($sightseen[0]->service_start_date);
									$arv = strtotime($sightseen[0]->service_end_date);
									$absDateDiff = abs($arv - $dep);
									$nights = floor($absDateDiff / (60 * 60 * 24));
									?>
									<tr><td align="center" bgcolor="#ffffff" class="padding1" >
										<table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
											<tbody>
												<tr><td colspan="4" bgcolor="#FFFFFF" >
												<div class="colsdets">
													<div class="portnme"><span style="margin-right:377px">sightseen:</span><?php echo $sightseen[0]->ticket_name; ?></div>
													
													<div class="portnme"><span style="margin-right:316px"> Service Starts On:</span> <?php echo date('d M Y', strtotime($sightseen[0]->service_start_date)); ?>  </div>
													
													<div class="portnme"> <span style="margin-right:379px">Ends On:</span> <?php echo date('d M Y', strtotime($sightseen[0]->service_end_date)); ?></div>
													
													<div class="portnme textcntr"><span style="margin-right:400px">Nights:</span><?php echo $sightseen[0]->ticket_modality.", ".$nights. ' night(s)'; ?></div>
												</div>
												</td></tr>
											</tbody>
										</table>
									</td>
								</tr>
									<tr><td align="center" bgcolor="#ffffff" class="padding1" >
										<table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
											<tbody>
												<tr><td colspan="4" bgcolor="#FFFFFF">
												<div class="colsdets">
													 <div class="portnme"> <span style="margin-right:375px">Travellers:</span><?php echo $sightseen[0]->adult; ?> Adult | <?php echo $sightseen[0]->child; ?> Child(ren)</div>
													<div class="totlbkamnt"> Total Amount:<span style="margin-left:354px"><?php echo $_SESSION['currency']." ".number_format(($Booking->amount * $_SESSION['currency_value']), 2, '.', '')?></span></div>
												</div>
												</td></tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr><td style="height:20px;width:100%;"></td></tr>
								<tr><td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
												<tbody>
													<tr><td colspan="4"><div class="detailhed" style="line-height:25px"><strong>Traveller Details</strong> (Lead Passenger)</div></td></tr>
													<tr style="background:#eeeeee;line-height:35px">
														<th align="left" valign="top"><strong>S No </strong></th>
														<th align="left" valign="top"><strong>Given Name </strong></th>
														
														<th align="left" valign="top"><strong>Status</strong></th>
													</tr>
													<?php 
													$travellers = json_decode($Booking->traveler_info, 1);
													if (isset($travellers['adult']) && !empty($travellers['adult'])) {
														foreach ($travellers['adult'] as $key => $adult_details) { ?>
															<tr style="background:#ffffff;line-height:30px;top:25px">
																<td class="col-xs-4"><span class="labltbl"><?php echo $adult_details['username']." ".$adult_details['surename']; ?></span></td>
																<td class="col-xs-4"><span class="labltbl">ADT</span></td>
																<td class="col-xs-4"><span class="labltbl"><?php echo $Booking->booking_status; ?></span></td>
															</tr>
													<?php } } if (isset($travellers['child']) && !empty($travellers['child'])) {
														foreach ($travellers['child'] as $key => $child_details) { ?>
														<tr style="background:#ffffff;line-height:30px;top:25px">
															<td class="col-xs-4"><span class="labltbl"><?php echo $child_details['username']." ".$child_details['surename']; ?></span></td>
															<td class="col-xs-4"><span class="labltbl">CHD</span></td>
															<td class="col-xs-4"><span class="labltbl"><?php echo $Booking->booking_status; ?></span></td>
														</tr>
													<?php } } ?>
												</tbody>
											</table>
										</td></tr>
										<tr><td style="height:20px;width:100%;"></td></tr>
										<tr><td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
												<tbody>
													<tr><td colspan="2"><div class="detailhed" style="background:#eeeeee;line-height:34px;color:#313131"><strong>Customer Details</strong></div></td></tr>
													<tr class="colsdets">
														<td width="20%" align="left" >Email ID</td>
														<td width="80%" align="left" >
															<?php echo $Booking->billing_email;?>
														</td>
													</tr>
													<tr class="colsdets">
														<td align="left" >Mobile Number</td>
														<td align="left" ><?php echo $Booking->billing_phone;?></td>
													</tr>
													<tr class="colsdets">
														<td align="left" >Address</td>
														<td align="left" ><?php 
														echo $Booking->billing_city.", ".$Booking->billing_state.", ".$Booking->billing_country." - ".$Booking->billing_zip; ?></td>
													</tr>
												</tbody>
											</table>
										</td></tr>
									</tbody>
								</table>
							</td></tr>
							<tr><td style="height:20px;width:100%;"></td></tr>
							
							<tr><td></td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div></div>
	</div>
<?php //$this->load->view('footer'); ?>
</div> </section>
        </div>
		</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
});

function PrintDiv() {    
   var voucher = document.getElementById('voucher');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
   popupWin.document.close();
}
</script>
     <?php $this->load->view('general/load_js.php'); ?>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
    </script>
        <style>
    .colsdets{
    	line-height: 25px;
    }
    </style>
</html>
