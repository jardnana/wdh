<html lang="en">
<head>
	<link rel="icon" href="" type="image/x-icon">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo PAGE_TITLE; ?> | Flight Confirmation</title>
	<?php $this->load->view('general/load_css'); ?>
	<link href="<?php echo base_url(); ?>../assets/css/voucher_flight.css" rel="stylesheet" />
</head>
<body id="top">
	<?php // $this->load->view('general/header'); ?>
		<div class="voucherview" >
			<div class="container">
				<div class="padvochr">
					<div class="topvchr" id='voucher'>
						<div class="rowevcr">
							<div class="col-xs-6 nopad"><div class="vouchrdate">Confirmation Voucher</div></div>
							<div class="col-xs-6 nopad"><a class="printcohr" onclick='PrintDiv()'><div class="fa fa-print"></div>Print</a></div>
						</div>
						<div class="clearfix"></div>
						<div class="secnrowe">
							<div class="col-xs-6 nopad fulmobxs">
								<div class="vouchrlogo"><img src="<?php echo base_url();?>/assets/images/logo_f.png" alt="Utravel Logo" /></div>
							</div>
							<div class="col-xs-6 nopad fulmobxs">
								<div class="fotyv"><span class="hrtofly">Date of Issue: <?php echo date('d-m-Y', strtotime($booking_global[0]->booking_date)); ?></span></div>
								<div class="adrsv2 rightsection">
									<span class="fa fa-phone"></span>
									<div class="ardsofvrPhone"> 12 345 678 900</div>
								</div>
							</div>
						</div>
						
						
						
						<div class="clearfix"></div>
						
						<div class="bodyvchr">
							<div class="rowclor">
							<div class="col-xs-3 nopad">
								<div class="vchrhed">BOOKING PNR <strong><?php echo $booking_global[0]->pnr_no; ?></strong></div>
							</div>
							<div class="col-xs-4 nopad">
								<div class="vchrhed vchrhedpnr">UTRAVEL REF NO <strong><?php echo $booking_global[0]->booking_number; ?></strong></div>
							</div>
							<div class="col-xs-4 nopad" >
								<div class="vchrhed vchrhedpnr">BOOKING STATUS <strong><?php echo $booking_global[0]->booking_status; ?></strong></div>
							</div>
						</div>
						<div class="clearfix"></div>
					   
					   <div class="clearfix"></div>
							 <div class="rowofvcr">
								<div class="rowhedvchr">Passenger Details</div>
								<?php  $traveler_details = json_decode(base64_decode($booking_flights[0]->traveler_details)); // echo '<pre/>';print_r($traveler_details);exit; ?>
								<div class="tblevor">
									<div class="splovchr nonefol">
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh1">Passenger Name </div>
										</div>
										
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh1">Passenger Type</div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh1">Seats </div>
										</div>   
									</div>
									<?php if(isset($traveler_details->saladult)){ foreach($traveler_details->saladult as $key => $adultlist){ ?>
									<div class="splovchr fullnone">
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">PassengerName </div>
											<div class="psngrct"><?php echo $traveler_details->saladult[$key].' '.$traveler_details->fnameadult[$key].' '. $traveler_details->mnameadult[$key].' '. $traveler_details->lnameadult[$key];?></div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Passenger Type</div>
											<div class="psngrct">Adult</div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Seats</div>
											<div class="psngrct">Check In Required</div>
										</div>
									</div>
									<?php  } } if(isset($traveler_details->salchild)){ foreach($traveler_details->salchild as $key => $childlist){ ?>
									<div class="splovchr fullnone">
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">PassengerName </div>
											<div class="psngrct"><?php echo $traveler_details->salchild[$key].' '.$traveler_details->fnamechild[$key].' '. $traveler_details->mnamechild[$key].' '. $traveler_details->lnamechild[$key];?></div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Passenger Type</div>
											<div class="psngrct">Child</div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Seats</div>
											<div class="psngrct">Check In Required</div>
										</div>
									</div>		
									<?php  } } if(isset($traveler_details->salinfant)){ foreach($traveler_details->salinfant as $key => $infantlist){ ?>
									<div class="splovchr fullnone">
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">PassengerName </div>
											<div class="psngrct"><?php echo $traveler_details->salinfant[$key].' '.$traveler_details->fnameinfant[$key].' '. $traveler_details->mnameinfant[$key].' '. $traveler_details->lnameinfant[$key];?></div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Passenger Type</div>
											<div class="psngrct">Infant</div>
										</div>
										<div class="col-xs-4 nopad sidemd">
											<div class="lablefresh">Seats</div>
											<div class="psngrct">Check In Required</div>
										</div>
									</div>									
									<?php  } }?>									
								</div>
							</div>
							
							<div class="clearfix"></div>
							<div class="rowofvcr">
								<div class="rowhedvchr">Flight Details</div>
								<div class="tblevor">
									<?php $data['search_id'] = $search_id;$data['search_data'] = $search_data; $data['rand_id'] = $rand_id; $data['results'] = $results; $this->load->view('global/flight_details',$data);$search_data = json_decode(base64_decode($search_data[0]));$results = json_decode(base64_decode($results[0]),1); ?>
								</div>
							</div>
							<div class="clearfix"></div>
										
										
							<div class="clearfix"></div>
							<div class="rowofvcr">
								<div class="rowhedvchr">Payment Details</div>
								<div class="tblevor">
									<div class="insrvr">
										<div class="col-xs-6 nopad smfull">
											<div class="lablefresh1">Transaction Id</div>
											<div class="psngrct"><?php if($booking_payment[0]->transaction_id != ''){echo $booking_payment[0]->transaction_id; }else { echo '-';}?></div>
										</div>
										
										<div class="col-xs-6 nopad smfull">
											<div class="lablefresh1">Transaction Status</div>
											<div class="psngrct"><?php echo $booking_payment[0]->payment_status;?></div>
										</div>
									</div>
									
									<div class="splovchr">
									
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh">No. of adults</div>
											<div class="psngrct"><?php echo $search_data[0]->adult; ?></div>
										</div>
										
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh">No. of Child</div>
											<div class="psngrct"> <?php echo $search_data[0]->child; ?></div>
										</div>
										
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh">No. of Infant</div>
											<div class="psngrct"><?php echo $search_data[0]->infant; ?> </div>
										</div>
										
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh">Total Amount</div>
											<div class="psngrct"><?php echo BASE_CURRENCY.' ';?><?php echo ceil($booking_payment[0]->amount); ?></div>
										</div>
										
									</div>
									
								</div>
							</div>
							
							 
							<div class="clearfix"></div>
							<?php if($insurance_detail[0]->IsInsuranceAdded == 'true'){ ?>
							<div class="rowofvcr">
								<div class="rowhedvchr">Insurance Details <b>( Travel Guard Policy # <?php echo $insurance_detail[0]->PolicyNumber; ?>  )</b></div>
								<div class="tblevor">
									<div class="insrvr">
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Transaction Id</div>
											<div class="psngrct"><?php if($insurance_detail[0]->transaction_id != ''){echo $insurance_detail[0]->transaction_id; }else { echo '-';}?></div>
										</div>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Policy Id</div>
											<div class="psngrct"><?php echo $insurance_detail[0]->PolicyId; ?></div>
										</div>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Policy Number</div>
											<div class="psngrct"><?php echo $insurance_detail[0]->PolicyNumber; ?></div>
										</div>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Product Name</div>
											<div class="psngrct"><?php echo $insurance_detail[0]->ProductName; ?></div>
										</div>
										
									</div>
									<div class="insrvr">
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Plan Description</div>
											<div class="psngrct"><?php echo $insurance_detail[0]->PlanDescription ; ?></div>
										</div>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1"> Primary Insured</div>
											<div class="psngrct"><?php echo $insurance_detail[0]->PrimaryInsured ; ?></div>
										</div>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Is Insurance Added</div>
											<div class="psngrct">YES</div>
										</div>
										<?php if(false){ ?>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Total Premium Amount</div>
											<div class="psngrct"><?php echo BASE_CURRENCY.' ';?><?php echo ceil($insurance_detail[0]->total_premium_amount); ?></div>
										</div>
										<?php } ?>
										<div class="col-xs-3 nopad smfull">
											<div class="lablefresh1">Total Premium Amount</div>
											<div class="psngrct"><?php echo BASE_CURRENCY.' ';?><?php echo ceil($insurance_detail[0]->total_premium_amount); ?></div>
										</div>
									</div>
									
									<div class="splovchr">
										<div class="col-xs-12 nopad smfull">
											<div class="lablefresh">Insurance Policy Link</div>
											<div class="psngrct"><a href="<?php echo $insurance_detail[0]->policy_lookup_link; ?>" target="_blank">Click Here See your Insurance Policy details</a></div>
										</div>
										
									</div>
									
								</div>
							</div>
							<?php } ?>
							<div class="clearfix"></div>
							 <?php $TERMS_CONDITIONS = $this->General_Model->get_static_content_details('TERMS_CONDITIONS'); if(!empty($TERMS_CONDITIONS)){ ?>
							<div class="rowofvcr">
								<div class="rowhedvchr"><?php echo $TERMS_CONDITIONS->title;  ?></div>
								<div class="tblevor">
									<div class="temsv">
										<?php echo $TERMS_CONDITIONS->content;  ?>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>	
						</div>
						<div class="clearfix"></div>
						<div class="footev"></div>
						
					</div>
				</div>
			</div>
		</div>

<?php // $this->load->view('general/footer'); ?>
	<?php $this->load->view('general/load_js'); ?>
	<?php $this->load->view('global/script',$data); ?>
	<script type="text/javascript">
		 $(document).ready(function() {
			$(".tooltipv").tooltip();
		 });

		function PrintDiv() {    
		   var voucher = document.getElementById('voucher');
		   var popupWin = window.open('', '_blank', 'width=600,height=600');
		   popupWin.document.open();
		   popupWin.document.write('<html><head><link href="<?php echo base_url();?>/assets/css/bootstrap.css" rel="stylesheet" media="all"><link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet"><link href="<?php echo base_url();?>/assets/css/media.css" rel="stylesheet" media="all" ><link href="<?php echo base_url();?>/assets/css/voucher_flight.css" rel="stylesheet"><link href="<?php echo base_url();?>/assets/css/font-awesome.min.css" rel="stylesheet" media="all" ><style>@media print { .col-xs-1,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9,.col-xs-10,.col-xs-11 {float: left;}.col-xs-1 {width: 8.333333333333332%;}.col-xs-2 {width: 16.666666666666664%;}.col-xs-3 {width: 25%;}.col-xs-4 {width: 33.33333333333333%;}.col-xs-5 {width: 41.66666666666667%;}.col-xs-6 {width: 50%;}.col-xs-7 {width: 58.333333333333336%;}.col-xs-8 {width: 66.66666666666666%;}.col-xs-9 {width: 75%;}.col-xs-10 {width: 83.33333333333334%;}.col-xs-11 {width: 91.66666666666666%;}.col-xs-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;} }</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
		   popupWin.document.close();
		}
	</script>
</body>
</html>
