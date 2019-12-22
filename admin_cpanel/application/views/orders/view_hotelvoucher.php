<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Fly2Escape</title>
        <?php $this->load->view('general/load_css'); ?>
        <link href="<?php echo base_url(); ?>assets/css/backslider.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo base_url(); ?>assets/css/backslider2.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body id="top">
        <?php //$this->load->view('general/header_menu'); ?>     
        <div class="allpagewrp">
            <div class="rltvht"> <?php //$this->load->view('general/header'); ?></div>
            <div class="clearfix"></div>
            <div class="contentsec margtop">
                <div class="container">
			<div class="ovrgo">
			<div class="centervocr">
				<table class="mvchr">
					<tr>
						<td>
							<table class="insideone">
								<tr>
									<td class="thrty">
										<div class="logovcr">
											<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Travel Agency Logo" class="logo">
										</div>
									</td>
									<td class="thrty">
										<span class="faprnt fa fa-print" style="display:none;"></span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><div class="bighedingv">Confirmation Letter</div></td>
					</tr>
					
					<tr>
						<td>
							<div class="grngv">Hello, <?php echo $result1[0]->leadpax; ?><br />
								<p>Please check on your hotel dates and take quick contact with your host to discuss all the details of your arrival.</p>
							</div>
						</td>
					</tr>

			<?php
			$sightseen = $this->Profile_Model->get_HotelBooking_det($result[0]->id)->result();
			$hotelname = $this->Profile_Model->get_booked_hotelname($sightseen[0]->hotel_code);
			$hotel_voucherdate = explode(' ',$result1[0]->voucher_date);
			$hotelvoucher_date = $hotel_voucherdate[0];
			?>
					<tr>
						<td>
							<table class="insideone celpad5">
								<!--<tr>
									<td class="col-xs-4"><span class="labltbl">Hotel Name </span></td>
									<td><span class="ansrlbl"><?php //echo $hotelname->Name; ?></span></td>
								</tr>
								<tr>
									<td class="col-xs-4"><span class="labltbl">Room Type </span></td>
									<td><span class="ansrlbl"><?php //echo $sightseen[0]->room_type; ?></span></td>
								</tr>
								<tr>
									<td class="col-xs-4"><span class="labltbl">Inclusion </span></td>
									<td><span class="ansrlbl"><?php //echo $sightseen[0]->inclusion; ?></span></td>
								</tr>-->
								<tr>
									<td><span class="labltbl">Status  </span></td>
									<td><span class="ansrlbl"><?php echo $sightseen[0]->status_value; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Pnr No  </span></td>
									<td><span class="ansrlbl"><?php echo $result1[0]->pnr_no; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Check In  </span></td>
									<td><span class="ansrlbl"><?php echo $sightseen[0]->check_in; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Check Out </span></td>
									<td><span class="ansrlbl"><?php echo $sightseen[0]->check_out; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Booked Date </span></td>
									<td><span class="ansrlbl"><?php echo $hotelvoucher_date; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Total Cost</span></td>
									<td><span class="ansrlbl"> <?php echo $_SESSION['currency']." ".number_format(($sightseen[0]->total_cost * $_SESSION['currency_value']), 2, '.', ''); ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Transaction Status </span></td>
									<td><span class="ansrlbl"><?php echo $result[0]->payment_status; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Transaction ID </span></td>
									<td><span class="ansrlbl"><?php echo $result[0]->transaction_id; ?></span></td>
								</tr>
							</table>
						</td>
					</tr>
			<?php
					$booking_hotel1 		= $this->Hotel_Model->get_hotelbedshotel_details_image($result[0]->hotel_code)->row();
					$hotel_contact = $this->Hotel_Model->get_phone_numbers($booking_hotel1->HotelCode);
					$star = $booking_hotel1->CategoryCode;
					if (Is_numeric($star[0])) {
						$star_rating = $star[0];
					} else {
						$star_rating = '0';
					}
					//$booking_hotel1 		= $this->Hotel_Model->get_hotel_detail_list1($result[0]->hotel_code, $result[0]->room_code);
					//$sightseen = $this->Excursion_Model->getBookingSightTemp($result[0]->ref_id)->result();
					$dep =  strtotime($_SESSION['hotel_checkin']);
					$arv = strtotime($_SESSION['hotel_checkout']);
					$absDateDiff = abs($arv - $dep);
					$nights = floor($absDateDiff / (60 * 60 * 24));
			
			?>
			<tr>
				<td>
					<div class="ontypsec">
																		<div class="allboxflt">
																				<div class="col-xs-7 nopadding secmoddiv">
																					<div class="jetimg"><img src="<?php  echo $booking_hotel1->thumb_image; ?>" alt="" /></div>
																					<div class="alldiscrpo"> 
																						<span class="sgsmal"></span>
																					</div>
																				</div>
																				<div class="col-xs-5 nopadding secmoddiv">
																					<div class="col-xs-2"></div>
																					<div class="col-xs-10">
																						<br/><br/>
																						<span class="airlblxl"><strong><?php echo $booking_hotel1->Name; ?></strong></span>
																						<div class="starrting"><?php  $category_des=$this->Hotel_Model->get_category_details_list($star);
												$categoryarray=json_decode(json_encode($category_des),1); echo $categoryarray['category_details_list_code'].' - '.$categoryarray['category_details_list_description'];?>
												
																													<!--<img alt="" src="<?php echo base_url(); ?>assets/images/bigrating-<?php echo $star_rating; ?>.png">-->
																												</div>
																						<div class="clearfix"></div> <div class="clearfix"></div> <div class="clearfix"></div> 
																						<span class="portnme">
																							<strong>Checkin Date : </strong><?php echo date('M/d/Y', strtotime($_SESSION['hotel_checkin'])); ?> and <strong>Checkout Date: </strong><?php echo date('M/d/Y', strtotime($_SESSION['hotel_checkout'])); ?> <br/>(12PM to 12PM)
																						</span>
																					</div>
																				</div>
																			</div>
																		</div> 
																
					<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs">Travelers: 
																	<span class="fa fa-male"></span> <?php echo $_SESSION['adult_payment']; ?> | <span class="fa fa-child"></span> <?php echo $_SESSION['child_payment']; ?></div>
																	<!--<div class="totlbkamnt"> Total Amount <br /><?php //echo $_SESSION['currency'] . ' ' . (($result[0]->amount) * $_SESSION['currency_value']); ?></div>-->
																</div>
															</div>
														
				</td>
			</tr>
					<tr>
						<td><div class="pagesubhdngv">Customer Details</div></td>
					</tr>
					<tr>
						<td>
							<table class="insideone celpad5">
								<tr>
									<td class="col-xs-4"><span class="labltbl">Email ID </span></td>
									<td><span class="ansrlbl"><?php echo $sightseen[0]->contact_email; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Mobile Number  </span></td>
									<td><span class="ansrlbl"><?php echo $sightseen[0]->contact_mobile_number; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Address </span></td>
									<td><span class="ansrlbl"><?php echo $result[0]->contact_city_name; ?>, <?php echo $result[0]->contact_state_name; ?>- <?php echo $result[0]->contact_zip_code; ?></span></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><div class="pagesubhdngv">Hotel Details</div></td>
					</tr>
					<tr>
						<td>
							<table class="insideone celpad5">
								<tr>
									<td class="col-xs-4"><span class="labltbl">Name </span></td>
									<td><span class="ansrlbl"><?php echo $booking_hotel1->Name; ?></span></td>
								</tr>
								<tr>
									<td class="col-xs-4"><span class="labltbl">Destination </span></td>
									<td><span class="ansrlbl"><?php echo $booking_hotel1->DestinationName; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Email Id  </span></td>
									<td><span class="ansrlbl"><?php echo $booking_hotel1->Email; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Address </span></td>
									<td><span class="ansrlbl"><?php echo $booking_hotel1->cityName; ?>, <?php echo $booking_hotel1->Address; ?>, <?php echo $booking_hotel1->CountryName; ?> - <?php echo $booking_hotel1->PostalCode; ?></span></td>
								</tr>
								<tr>
									<td><span class="labltbl">Contact on </span></td>
									<td>
										<?php foreach($hotel_contact as $hcontactnum){ ?>
											<span class="ansrlbl"><?php echo ucfirst($hcontactnum->phone_type)." : ".$hcontactnum->phone_number; ?></span><br/>
										<?php } ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><div class="pagesubhdngv">Passenger Details</div></td>
					</tr>
					<tr>
						<td>
							<table class="insideone celpad5">
							<?php 
							$room_type = explode('<br>', $result[0]->room_type);
							$board_type = explode('<br>', $result[0]->board_type);
							$travellers = unserialize($result[0]->passenger_details); 
							//echo "<pre/>".count($travellers);print_r($travellers);
							$room = array(); $room[1] = array(); $room[2] =array(); $room[3] = array();
							$room_data = explode('|', $result[0]->room_passengers);
							$adult_data = json_decode(base64_decode($room_data[1]));
							$child_data = json_decode(base64_decode($room_data[2]));
							$child_age = json_decode(base64_decode($room_data[3]));
							$child_ages = array();
							foreach($child_age as $age){
								foreach($age as $ageval){
									$child_ages[] = $ageval;
								}
							}
							$childage =0;
							//echo $_SESSION['rooms']; print_r($_SESSION['adults']); print_r($_SESSION['children']); 
							for($tr=0; $tr<count($travellers); $tr++){
								if($travellers[$tr]['type'] == 'Adult'){
									if(isset($adult_data[0]) && (count($room[1]) < $adult_data[0])){
										$room[1][] = $travellers[$tr];
									} else if(isset($adult_data[1]) && (count($room[2]) < $adult_data[1])){
										$room[2][] = $travellers[$tr];
									} else if(isset($adult_data[2]) && (count($room[3]) < $adult_data[2])){
										$room[3][] = $travellers[$tr];
									}
								} else if($travellers[$tr]['type'] == 'Child'){
									if(isset($adult_data[0]) && isset($child_data[0]) && (count($room[1]) < ($adult_data[0]+$child_data[0]))){
										if(isset($child_ages[$childage])){
											$travellers[$tr]['age'] = $child_ages[$childage];
										}
										$room[1][] = $travellers[$tr];
									} else if(isset($adult_data[1]) && isset($child_data[1]) && (count($room[2]) < ($adult_data[1]+$child_data[1]))){
										if(isset($child_ages[$childage])){
											$travellers[$tr]['age'] = $child_ages[$childage];
										}
										$room[2][] = $travellers[$tr];
									} else if(isset($adult_data[2]) && isset($child_data[2]) && (count($room[3]) < ($adult_data[2]+$child_data[2]))){
										if(isset($child_ages[$childage])){
											$travellers[$tr]['age'] = $child_ages[$childage];
										}
										$room[3][] = $travellers[$tr];
									}
									$childage++; 
								} else { }
							}
							for($room_trav=0; $room_trav < count($room); $room_trav++){
								if(!empty($room[($room_trav+1)])){
							?>
							<tr><th colspan="3">Room <?php echo $room_trav+1; ?> (<?php echo $room_type[($room_trav)].' - '.$board_type[($room_trav)]; ?>) Passengers</th></tr>
							<tr>
								<td class="col-xs-4"><span class="ansrlbl">Passenger Name </span></td>
								<td class="col-xs-4"><span class="ansrlbl">Passenger Type </span></td>
								<td class="col-xs-4"><span class="ansrlbl">Status </span></td>
							</tr>
							<?php for($i=0; $i < count($room[($room_trav+1)]); $i++){
								//print_r($travellers[$i]);
							if (($room[($room_trav+1)][$i]['type']=='Adult') && !empty($room[($room_trav+1)][$i]['type'])) { ?>
							<tr>
								<td class="col-xs-4"><span class="labltbl"><?php echo $room[($room_trav+1)][$i]['username']." ".$room[($room_trav+1)][$i]['surename']; ?></span></td>
								<td class="col-xs-4"><span class="labltbl">ADT</span></td>
								<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
							</tr>
							<?php } } //}
							for($i=0; $i < count($room[($room_trav+1)]); $i++){
							if (($room[($room_trav+1)][$i]['type']=='Child') && !empty($room[($room_trav+1)][$i]['type'])) {
							//foreach ($travellers['child'] as $key => $child_details) { ?>
							<tr>
								<td class="col-xs-4"><span class="labltbl"><?php echo $room[($room_trav+1)][$i]['username']." ".$room[($room_trav+1)][$i]['surename']; ?></span></td>
								<td class="col-xs-4"><span class="labltbl">CHD (<?php echo $room[($room_trav+1)][$i]['age']; ?> Years old)</span></td>
								<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
							</tr>
							<?php } } } } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td><div class="pagesubhdngv">Cancellation Policies</div></td>
					</tr>
					<tr>
						<td>
							<table class="insideone celpad5">
								<tr>
									<td>
										<?php echo $sightseen[0]->cancel_policy; ?>
										(*)Date and Time Depends on Hotel Destination.
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><div class="pagesubhdngv">Payable Through</div></td>
					</tr>
					<tr>
						<td>
							<table class="insideone celpad5">
								<tr>
									<td>
										Payable through <?php echo $result[0]->supplier_name;  ?>, acting as agent for the service operating company, details of which can be provided upon request. VAT: <?php echo $result[0]->vat_number;  if($result[0]->reference_number != '') { ?>Reference: <?php echo $result[0]->reference_number;  }else { ?> and Agency Reference: <?php echo $result[0]->AgencyReference_num;  } ?>.
									
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><div class="pagesubhdngv">Contact Information</div></td>
					</tr>
					<tr>
						<td class="thrty">
							<div class="adrssvr">
								<div class="scont">  
									<span class="addresof clrimp">
										<?php $address = $this->General_Model->get_contact_address();
										if(!empty($address) && isset($address[0]->contact_address)) { ?>
											<p><?php echo $address[0]->contact_address; ?></p>
										<?php } else { ?>
										Fly2escape 
										Bay Square Level 7,Bldg 11 
										Business Bay PO Box 118656
										Dubai United Arab Emirates 
										<?php } ?>
									</span> 
								</div>
								<div class="scont"><span class="addresof clrimp">
								<span class="advcr fa fa-phone"></span>
								<?php if(!empty($address) && isset($address[0]->contact_number)) { echo $address[0]->contact_number; } else echo ''; ?></span> </div>
								<div class="scont"><span class="addresof2 clrimp">
								<span class="advcr fa fa-envelope"></span>
								<?php if(!empty($address) && isset($address[0]->email_address)) { echo $address[0]->email_address; } else echo ''; ?></span> 
							</div>
						</div>
					</td>
				</tr>
				<tr>
				<td><a class="cancelll" onclick="close_voucher()">Back</a></td>
				</tr>
			</table>
			</div>
			</div>
</div>
<div class="clearfix"></div>
                    <?php $this->load->view('general/footer'); ?>
                </div>
                <?php $this->load->view('general/load_js'); ?>
             </body>
           </html>
           <script type="text/javascript">
			function close_voucher(){
				window.location.href = "<?php echo base_url(); ?>dashboard";
			}
           </script>
<style>
.ovrgo {
    display: block;
    overflow: hidden;
}
.centervocr {
    background: #fff;
    border: 1px solid #ddd;
    display: block;
    margin: 50px auto;
    max-width: 70%;
    overflow: hidden;
    padding: 20px;
}
.mvchr {
    width: 100%;
}
.insideone {
    width: 100%;
}
.thrty {
    width: 33.333%;
}
.bighedingv {
    color: #444;
    display: block;
    font-size: 22px;
    overflow: hidden;
    padding: 15px 0;
    text-align: center;
}
.grngv {
    color: #444;
    display: block;
    font-size: 16px;
    overflow: hidden;
}
.pagesubhdngv {
    border-bottom: 1px solid #ddd;
    color: #444;
    display: block;
    font-size: 20px;
    margin: 10px 0 15px;
    overflow: hidden;
    padding: 10px 0;
}
.splvchr {
    border: 1px solid #eee;
    display: block;
    margin: 15px 0 0;
    overflow: hidden;
}
.splvchr .topalldesc {
    margin: 0;
}
.topalldesc {
    background: none repeat scroll 0 0 #fff;
    display: table;
    margin: 20px 0 0;
    overflow: hidden;
    padding: 15px;
    width: 100%;
}
.splvchr .topalldesc .celtbcel {
    padding: 0 10px;
}
.celtbcel {
    display: table-cell;
    float: none;
    vertical-align: middle;
}
.colrcelo {
    background: none repeat scroll 0 0 #f6f6f6;
}
.celpad5 tr td {
    color: #666;
    font-size: 14px;
    padding: 5px;
    vertical-align: middle;
}
.jetimg {
    float: left;
    margin-right: 10px;
}
.splvchr .topalldesc .celtbcel {
    padding: 0 10px;
}
.colrcelo {
    background: none repeat scroll 0 0 #f6f6f6;
}
.celtbcel {
    display: table-cell;
    float: none;
    vertical-align: middle;
}
.bokkpricesml {
    display: block;
    overflow: hidden;
    padding: 15px;
    text-align: right;
}
.travlrs {
    color: #999;
    display: block;
    font-size: 16px;
    margin: 0 0 15px;
    overflow: hidden;
}
.totlbkamnt {
    color: #666;
    display: block;
    font-size: 20px;
    margin: 0 0 10px;
    overflow: hidden;
}
.pagesubhdngv {
    border-bottom: 1px solid #ddd;
    color: #444;
    display: block;
    font-size: 20px;
    margin: 10px 0 15px;
    overflow: hidden;
    padding: 10px 0;
}
</style>
