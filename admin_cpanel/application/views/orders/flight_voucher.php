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
					<?php  $contact_detail_list  = $this->General_Model->address()->row(); 
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
					<table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
						<tbody>
							<tr>
								<td align="left"></td>
								<td align="right" style="font-size:13px; line-height:20px;"></td>
							</tr>
							<tr><td colspan="2" style="border:0px; border-top:1px dashed #CCC;">
								<table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
									<tbody>
										<tr><td width="100%" style="line-height:22px;"><div class="confirmtionltr">Confirmation Letter</div></td></tr>
										<tr><td align="center">
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tbody>
													<tr><td align="left" valign="top">
														<table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
															<tbody>
																<tr><td colspan="2" align="left">
																	<div class="grngv">Hello, <strong><?php echo $Booking->leadpax;?></strong><br />
																	</div>
																</td></tr>
																<tr>
																	<td width="40%" align="left">RESERVATION CODE  :</td>
																	<td width="60%" align="left">
																		<strong><?php if($Booking->booking_no == '') echo '---';else echo $Booking->booking_no;?></strong>
																	</td>
																</tr>
																<tr>
																	<td align="left">STATUS  :</td>
																	<td align="left">
																		<strong><?php echo $Booking->booking_status;?></strong>
																	</td>
																</tr>
															</tbody>
														</table>
													</td><td align="left" valign="top">
														<table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
															<tbody>
																<tr><td colspan="2" align="left">&nbsp;</td></tr>
																<tr>
																	<td width="50%" align="left">&nbsp;</td><td width="50%" align="left">&nbsp;</td>
																</tr>
																<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td></tr>
															</tbody>
														</table>
													</td></tr>
												</tbody>
											</table>
										</td></tr>
										<tr><td style="height:20px;width:100%;"></td></tr>
									<?php 
									
									$travellers 				= json_decode($Booking->TravelerDetails, 1); 
									$flightResponse 			= json_decode(base64_decode($Booking->response), 1);
									//$flightRequest 				= json_decode($Booking->request, 1);
									//echo "<pre/>"; print_r($flightRequest);
									//$flightRequest				= $flightRequest['Search']['request'];
									foreach($flightResponse as $FlightDetails){ 
										for($j=0; $j<count($FlightDetails['segments']); $j++){
											$origin = $this->General_Model->getCityName($FlightDetails['segments'][$j]['Origin']);
											$destination = $this->General_Model->getCityName($FlightDetails['segments'][$j]['Destination']);
											//echo "<pre>"; print_r($Booking); echo "<pre/>";die;
											$dep 				=  date("d\ M\ Y",strtotime($FlightDetails['segments'][$j]['DepartureTime'])).date("h:i",strtotime($FlightDetails['segments'][$j]['DepartureTime']));
											$arv 				=  date("d\ M\ Y",strtotime($FlightDetails['segments'][$j]['ArrivalTime'])).date("h:i",strtotime($FlightDetails['segments'][$j]['ArrivalTime']));
											$segjourney 		= $FlightDetails['segments'][$j]['FlightTime'];
											$segjourney_time 	= floor($segjourney/(60*60))."h ".floor($segjourney%(60*60))."m";
									?>
									<tr><td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
										<table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
											<tbody>
												<tr><td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
													<div class="dterser">
														<div class="colsdets">
															
															DEPARTURE:<?php echo date('d M, H:i', strtotime($FlightDetails['segments'][$j]['DepartureTime'])); ?>
														</div>
														<div class="snotes">Please verify flight times prior to departure</div>
													</div>
												</td></tr>
												<tr class="rowall"><td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
													<div class="padwithbord">
														<div class="leftflitmg">
															<img src="https://www.amadeus.net/static/img/static/airlines/medium/<?php echo $FlightDetails['segments'][$j]['Carrier']; ?>.png" alt="" />
														</div>
														<div class="fligtdetss">
															<span class="sgsmal"><?php echo $FlightDetails['segments'][$j]['FlightNumber']; ?></span> 
														</div>
														<div class="opfligt">
															Duration: <strong><?php echo $segjourney_time; ?></strong>
														</div>
													</div>
												</td>
												<td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">
													
													<?php echo $origin->airport_city."(".$FlightDetails['segments'][$j]['Origin'].")"; ?>
												</td>
												<td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">
													
													<?php echo $destination->airport_city."(".$FlightDetails['segments'][$j]['Destination'].")"; ?>
												</td>
												<td width="25%" rowspan="2" bgcolor="#FFFFFF">
													Aircraft:<br><?php echo $FlightDetails['segments'][$j]['FlightNumber']; ?><br>
													Booking Class: <?php if(isset($FlightDetails['segments'][$j]['CabinClass'])) echo $FlightDetails['segments'][$j]['CabinClass']; else echo 'N/A'; ?>
												</td></tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr><td style="height:20px;width:100%;"></td></tr>
								<?php } } ?>
								<tr><td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
												<tbody>
													<tr><td colspan="4"><div class="detailhed">Traveller Details (Lead Passenger)</div></td></tr>
													<tr class="tablehedt" style="background:#eeeeee">
														<th align="left" valign="top"><strong>S No </strong></th>
														<th align="left" valign="top"><strong>Given Name </strong></th>
														<th align="left" valign="top"><strong>Seats</strong></th>
														<th align="left" valign="top"><strong>Class</strong></th>
														<th align="left" valign="top"><strong>Status</strong></th>
													</tr>
													<?php $i=1; 	
										foreach($travellers['adult'] as $adult_passenger){    //echo "<pre>"; print_r($Booking->AirCreateReservationRes); echo "<pre/>";die();
											if($adult_passenger['gender']=='Male'){ $salutation = 'Mr'; } 
											else { $salutation = 'Ms/Mrs'; }
								?>
													<tr class="tabledat" style="background:#ffffff">
														
														<td><?php echo $i; ?></td>
														<td><?php echo $adult_passenger['surename'].'/'.$adult_passenger['username']." ".$salutation; ?></td>
														<td>Check-In Required</td>
														<td><?php if(isset($flightResponse[0]['segments'][0]['CabinClass'])) echo $flightResponse[0]['segments'][0]['CabinClass']; else echo 'N/A'; ?></td>
														<td><?php echo $Booking->booking_status; ?></td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</td></tr>
										<tr><td style="height:20px;width:100%;"></td></tr>
										<tr><td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
												<tbody>
													<tr><td colspan="2"><div class="detailhed hedbd">Customer Details</div></td></tr>
													<tr>
														<td width="40%" align="left"><strong>Email ID</strong></td>
														<td width="60%" align="left">
															<?php echo $Booking->BILLING_EMAIL;?>
														</td>
													</tr>
													<tr>
														<td align="left"><strong>Mobile Number</strong></td>
														<td align="left"><?php echo $Booking->BILLING_PHONE;?></td>
													</tr>
													<tr>
														<td align="left"><strong>Address</strong></td>
														<td align="left"><?php echo $Booking->BILLING_CITY.", ".$Booking->BILLING_STATE.", ".$travellers['adult'][0]['ContactCountry']." - ".$Booking->BILLING_ZIP; ?></td>
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
<?php $this->load->view('general/footer'); ?>
</div> </section>
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
</html>
