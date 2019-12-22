<!DOCTYPE html>
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
</head>
<body id="top">
	<?php $this->load->view('general/header'); ?>
		<div class="clearfix"></div>
		<div class="alldownsectn">
			<div class="container">
			  <div class="ovrgo">
				  <div class="ordrconfmd">
					<div class="orderbox">
						<div class="tickapt">
							<?php if($booking_global[0]->pnr_no == ''){ ?><span class="iconaptcheck"><img src="<?php echo base_url();?>assets/images/cross.png" alt="" /></span><span class="msgofapt">Oops!! Your booking is failed.</span><?php }else{ ?><span class="iconaptcheck"><img src="<?php echo base_url();?>assets/images/aptcheck.png" alt="" /></span><span class="msgofapt">Congratulation!! Your booking is confirmed.</span><?php } ?>
						</div>
					</div>
					<div class="clearfix"></div> 
					 <div class="splvchr">
						<div class="topalldesc">
						   <?php $data['search_id'] = $search_id;$data['search_data'] = $search_data; $data['rand_id'] = $rand_id; $data['results'] = $results; $this->load->view('global/flight_details',$data);$search_data = json_decode(base64_decode($search_data[0]));$results = json_decode(base64_decode($results[0]),1); ?>
							<div class="col-xs-4 nopadding celtbcel colrcelo">
								<div class="bokkpricesml">
									<div class="travlrs">Travelers: <span class="fa fa-male"></span> <?php echo $search_data[0]->adult; ?> <?php if($search_data[0]->child > 0){ ?>|  <span class="fa fa-child"></span> <?php echo $search_data[0]->child; } ?> <?php if($search_data[0]->child > 0){ ?>|  <span class="fa fa-infant"></span> <?php echo $search_data[0]->infant; } ?></div>
									<div class="travlrs">Reservation Date : <?php echo date('D, d M Y', strtotime($booking_global[0]->booking_date));?></div>
									<div class="travlrs">Booking Number : <?php echo $booking_global[0]->booking_number;?></div>
									<?php if($booking_global[0]->pnr_no!=''){ ?><div class="travlrs">PNR Number : <?php echo $booking_global[0]->pnr_no;?></div><?php } ?>
									<div class="travlrs">Booking Status Number : <?php echo $booking_global[0]->booking_status;?></div>
									<div class="totlbkamnt"> Total Amount : <?php echo $results[0]['PEquivFare_CurrencyCode'][0]; ?>  <?php echo $results[0]['TotalFare']; ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <div class="clearfix"></div> 
				 <?php if($booking_global[0]->pnr_no!=''){ ?> <a class="viewvoucr" href="<?php echo site_url().'booking/voucher_view/'.base64_encode(json_encode($parent_pnr));?>" >View Voucher</a><?php } ?>
			 </div>
			</div>
		</div>
	<?php $this->load->view('general/footer'); ?>
	<?php $this->load->view('general/load_js'); ?>
	<?php $this->load->view('global/script',$data); ?>
</body>
</html>
