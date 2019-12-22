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
        <?php $this->load->view('general/header_menu'); ?>     
        <div class="allpagewrp" >
            <div class="rltvht"> <?php $this->load->view('general/header'); ?></div>
            <div class="clearfix"></div>
            <div class="contentsec margtop">
                <div class="container">
					<div class="ovrgo" id="divToPrint">
						<div class="centervocr">
							<table class="mvchr vchrpaadd">
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
													 <a class="faprnt fa fa-print" href="javascript:void();" onClick="PrintDiv();return false;"></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="bighedingv"><?php echo $this->fly2escape['Voucher']['ConfirmationLetter'];?></div></td>
								</tr>
								<?php if($result[0]->module == 'SIGHTSEEN') { ?>
								<tr>
									<td>
										<div class="grngv"><?php echo $this->fly2escape['Voucher']['Hello'];?>, <?php echo $result[0]->leadpax; ?><br />
											<p><?php echo $this->fly2escape['Voucher']['CheckExcursionDates']; ?></p>
										</div>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['Itinerary'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<div class="splvchr">
														<div class="topalldesc">
															<div class="col-xs-8 nopadding celtbcel">
																<?php for( $i=0; $i<count($result); $i++){ 
																	$sightseen = $this->Excursion_Model->getBookingSightTemp($result[0]->ref_id)->result();
																	$booking_resp = json_decode($sightseen[0]->booking_res);
																	?>
																	<div class="moreflt spltopbk">
																		<div class="ontypsec">
																			<div class="allboxflt">
																				<table class="insideone celpad5">
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingDate']; ?></span></td>
																						<td><span class="ansrlbl"><?php echo date('d/M/Y', strtotime($booking_resp->ticket_booked_on)); ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingStatus'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[$i]->booking_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PNRNo'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($result[$i]->pnr_no!='') echo $result[$i]->pnr_no; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BOOKINGREFERENCE'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($result[0]->booking_no!=''){ 
																							$ref_no = explode('-',$result[0]->booking_no);
																							echo $ref_no[0].'-'.$ref_no[1]; } else echo 'N/A'; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ReferenceNo'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($booking_resp->api_reference_number!=''){ 
																							echo $booking_resp->api_reference_number; } else echo 'N/A'; ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionStatus'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->payment_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionID'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->transaction_id; ?></span></td>
																					</tr>
																				</table>
																			</div>
																		</div>
																	</div>
																
																<div class="moreflt spltopbk">
																<?php
																$dep = strtotime($sightseen[0]->service_start_date);
																$arv = strtotime($sightseen[0]->service_end_date);
																$absDateDiff = abs($arv - $dep);
																$nights = floor($absDateDiff / (60 * 60 * 24));
																?>
																	<div class="ontypsec">
																		<div class="allboxflt">
																			<div class="col-xs-3 nopadding">
																				<div class="jetimg"><img src="<?php if($sightseen[0]->image == '') echo base_url().'assets/images/no-image.jpg'; else echo $sightseen[0]->image; ?>" alt="" /></div>
																				<div class="alldiscrpo">
																					
																					<span class="sgsmal"></span>
																				</div>
																			</div>
																			<div class="col-xs-9 nopadding">
																				<div class="col-xs-7 right">
																					<span class="airlblxl"><strong><?php echo $sightseen[0]->ticket_name; ?></strong></span>
																					<br/>
																					<span><strong><?php echo $this->fly2escape['Voucher']['RefSupplier'];?>: </strong><?php echo $result[0]->booking_no; ?></span>
																					<br/>
																					<span class="portnme"> <b><?php echo $this->fly2escape['Voucher']['ServiceStartsSOn'];?>: </b><?php echo date('d M Y', strtotime($sightseen[0]->service_start_date)); ?> <br/> <b><?php echo $this->fly2escape['Voucher']['ServiceEndsOn'];?>: </b><?php echo date('d M Y', strtotime($sightseen[0]->service_end_date)); ?> </span>
																					<br/>
																					<span class="portnme textcntr"><b><?php echo $this->fly2escape['Voucher']['TicketType']; ?>: </b><?php echo $sightseen[0]->ticket_modality; ?><br/><b><?php echo $this->fly2escape['Voucher']['NoOfNights'];?>: </b><?php echo $nights. ' '.$this->fly2escape['Voucher']['Night(s)']; ?></span>
																				</div>
																			</div>
																		</div>
																	</div> 
																	<div class="ontypsec">
																		<div class="allboxflt">
																			<div class="col-xs-12 nopadding">
																				<div class="col-xs-12 right">
																					<span class="airlblxl"><?php echo $sightseen[0]->ticket_description; ?></span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																	<?php } ?>
															</div>
														
															<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs"><?php echo $this->fly2escape['Voucher']['Travelers'];?>: 
																	<span class="fa fa-male"></span> <?php echo $sightseen[0]->adult; ?> | <span class="fa fa-child"></span> <?php echo $sightseen[0]->child; ?></div>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['TotalAmount'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(($result[0]->ag_markup * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																</div>
															</div>
														</div>
													</div>
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CustomerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['EmailID'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $sightseen[0]->billing_email; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MobileNumber'];?>  </span></td>
												<td><span class="ansrlbl"><?php echo $sightseen[0]->billing_phone; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Address'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $sightseen[0]->billing_city; ?>, <?php echo $sightseen[0]->billing_state; ?>, <?php echo $sightseen[0]->billing_country; ?> - <?php echo $sightseen[0]->billing_zip; ?></span></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['PassengerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<?php $travellers = json_decode($sightseen[0]->traveler_info, 1); ?>
											<tr>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerName'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerType'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['Status'];?> </span></td>
											</tr>
											<?php if (isset($travellers['adult']) && !empty($travellers['adult'])) {
												foreach ($travellers['adult'] as $key => $adult_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $adult_details['username']." ".$adult_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ADT']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } if (isset($travellers['child']) && !empty($travellers['child'])) {
												$chd_cnt = 0; $child_ages = explode(',', $sightseen[0]->child_age);
											foreach ($travellers['child'] as $key => $child_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $child_details['username']." ".$child_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['CHD'].' ( '.$child_ages[$chd_cnt].' '.$this->fly2escape['Voucher']['YearsOld']; ?>)</span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php $chd_cnt++; } } ?>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['Remarks'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $booking_resp->Remarks; ?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CancellationPolicies'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $sightseen[0]->cancellation_policy_super_admin; ?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['BookableAndPayableby']; ?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $this->fly2escape['Voucher']['PayableThrough'];?> <strong><?php echo $booking_resp->Suppliername; ?></strong>, <?php echo $this->fly2escape['Voucher']['ActingasAgent'];?> <strong><?php echo $booking_resp->vat.' '; ?></strong> <?php if($booking_resp->ref != ''){?> <?php echo $this->fly2escape['Voucher']['Reference'];?>: <strong><?php echo $booking_resp->ref; ?></strong><?php } ?> 
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php } else if($result[0]->module == 'HOTEL') {
									//echo "<pre/>";print_r($result);
									?>
								<tr>
									<td>
										<div class="grngv"><?php echo $this->fly2escape['Voucher']['Hello'];?>, <?php echo $result[0]->leadpax; ?><br />
											<p><?php echo $this->fly2escape['Voucher']['CheckDates'];?>.</p>
										</div>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['Itinerary'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<div class="splvchr">
														<div class="topalldesc">
															<div class="col-xs-8 nopadding celtbcel">
																<?php 
																for( $i=0; $i<count($result); $i++){ ?>
																	<div class="moreflt spltopbk">
																		<div class="ontypsec">
																			<div class="allboxflt">
																				<table class="insideone celpad5">
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingStatus']; ?></span></td>
																						<td><span class="ansrlbl"><?php echo $result[$i]->status_value; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PNRNo'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($result[$i]->pnr_no!='') echo $result[$i]->pnr_no; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BOOKINGREFERENCE'];?> </span></td>
																						<td><span class="ansrlbl"><?if($result[$i]->status_value != 'Failed'){ if($result[0]->booking_no!='') echo $result[0]->booking_no; else if($result[0]->booking_item_code_value != '') echo $result[0]->booking_item_code_value; else echo 'N/A'; 
																						} else echo 'N/A'; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['YOURREFERENCE'];?></span></td>
																						<td><span class="ansrlbl"><?php if($result[0]->book_no_value!='') echo $result[0]->book_no_value; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionStatus'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->payment_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionID'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->transaction_id; ?></span></td>
																					</tr>
																				</table>
																			</div>
																		</div>
																	</div>
																
																<div class="moreflt spltopbk">
																<?php
																	//echo "<br/>-----------------------------------<pre/>";print_r($booking_hotel);exit;
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
																	<div class="ontypsec">
																		<div class="allboxflt">
																				<div class="col-xs-7 nopadding secmoddiv">
																					<div class="jetimg"><img src="<?php if($booking_hotel1->thumb_image == '') echo base_url().'assets/images/no-image.jpg'; else echo $booking_hotel1->thumb_image; ?>" alt="" /></div>
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
												$categoryarray=json_decode(json_encode($category_des),1); //echo $categoryarray['category_details_list_code'].' - '.$categoryarray['category_details_list_description'];?>
												
																							<img alt="" src="<?php echo base_url(); ?>assets/images/bigrating-<?php echo $star_rating; ?>.png">
																												</div>
																						<div class="clearfix"></div> <div class="clearfix"></div> <div class="clearfix"></div> 
																						<span class="portnme">
																							<strong><?php echo $this->fly2escape['Voucher']['CheckinDate'];?> : </strong><?php echo date('M/d/Y', strtotime($_SESSION['hotel_checkin'])); ?> <?php echo $this->fly2escape['Voucher']['and']; ?> <strong><?php echo $this->fly2escape['Voucher']['CheckoutDate'];?>: </strong><?php echo date('M/d/Y', strtotime($_SESSION['hotel_checkout'])); ?> <br/>(12PM to 12PM)
																						</span>
																					</div>
																				</div>
																			</div>
																		</div> 
																</div>
																	<?php } ?>
															</div>
														
															<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs"><?php echo $this->fly2escape['Voucher']['Travelers'];?>: 
																	<span class="fa fa-male"></span> <?php echo $_SESSION['adult_payment']; ?> | <span class="fa fa-child"></span> <?php echo $_SESSION['child_payment']; ?></div>
																	<!--<div class="totlbkamnt"> Total Amount <br /><?php //echo $_SESSION['currency'] . ' ' . (($result[0]->amount) * $_SESSION['currency_value']); ?></div>-->
																</div>
															</div>
														</div>
													</div>
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CustomerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['EmailID'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $result[0]->contact_email; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MobileNumber'];?>  </span></td>
												<td><span class="ansrlbl"><?php echo $result[0]->contact_mobile_number; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Address'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $result[0]->contact_city_name.', '.$result[0]->contact_state_name.', '.$result[0]->contact_country.' - '.$result[0]->contact_zip_code; ?></span></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['HotelDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Dashboard']['Name'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $booking_hotel1->Name; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Destination'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $booking_hotel1->DestinationName; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['EmailID'];?>  </span></td>
												<td><span class="ansrlbl"><?php echo $booking_hotel1->Email; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Address'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $booking_hotel1->cityName.', '.$booking_hotel1->Address.', '.$booking_hotel1->CountryName.' - '.$booking_hotel1->PostalCode; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ContactOn'];?> </span></td>
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
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['PassengerDetails'];?></div></td>
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
											<tr><th colspan="3"><?php echo $this->fly2escape['Voucher']['Room']; ?> <?php echo $room_trav+1; ?> (<?php echo $room_type[($room_trav)].' - '.$board_type[($room_trav)]; ?>) <?php echo $this->fly2escape['Voucher']['Passengers']; ?></th></tr>
											<tr>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerName'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerType'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['Status'];?> </span></td>
											</tr>
											<?php for($i=0; $i < count($room[($room_trav+1)]); $i++){
												//print_r($travellers[$i]);
											if (($room[($room_trav+1)][$i]['type']=='Adult') && !empty($room[($room_trav+1)][$i]['type'])) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $room[($room_trav+1)][$i]['username']." ".$room[($room_trav+1)][$i]['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ADT'];?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } //}
											for($i=0; $i < count($room[($room_trav+1)]); $i++){
											if (($room[($room_trav+1)][$i]['type']=='Child') && !empty($room[($room_trav+1)][$i]['type'])) {
											//foreach ($travellers['child'] as $key => $child_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $room[($room_trav+1)][$i]['username']." ".$room[($room_trav+1)][$i]['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['CHD'];?> (<?php echo $room[($room_trav+1)][$i]['age']; ?> <?php echo $this->fly2escape['Voucher']['YearsOld']; ?>)</span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } } } ?>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['Remarks'];?></div></td>
								</tr>
								<tr>
									<td><?php echo html_entity_decode($result[0]->comment_remarks);?></td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CancellationPolicies'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $result[0]->cancel_policy;  ?>
													(*)<?php echo $this->fly2escape['PreBooking']['CancellationPolicyDepends']; ?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['PayableThrough'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $this->fly2escape['Voucher']['PayableThrough'].' '.$result[0]->supplier_name.', '.$this->fly2escape['Voucher']['ActingasAgent'].' : '.$result[0]->vat_number;  if($result[0]->reference_number != '') { echo $this->fly2escape['Voucher']['Reference'].' : '.$result[0]->reference_number;  } else { echo $this->fly2escape['Voucher']['and'].' '.$this->fly2escape['Voucher']['AgencyReference'].' : '.$result[0]->AgencyReference_num;  } ?>.
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
							<?php	} else if($result[0]->module == 'TRANSFER') {
									$transfer = $this->Transfer_Model->getBookingTransferTemp($result[0]->ref_id)->result();
									//echo "<pre/>"; print_r($transfer); exit;
									$BookingRes = json_decode($result[0]->booking_res);
									$transferResponse 		= json_decode(base64_decode($result[0]->addservice_response), 1);
								?>
									<tr>
									<td>
										<div class="grngv"><?php echo $this->fly2escape['Voucher']['Hello'];?>, <?php echo $result[0]->leadpax; ?><br />
											<p><?php echo $this->fly2escape['Voucher']['CheckDates'];?></p>
										</div>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['Itinerary'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<div class="splvchr">
														<div class="topalldesc">
															<div class="col-xs-8 nopadding celtbcel">
																<?php for( $i=0; $i<count($result); $i++){ ?>
																	<div class="moreflt spltopbk">
																		<div class="ontypsec">
																			<div class="allboxflt">
																				<table class="insideone celpad5">
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingStatus'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[$i]->booking_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PNRNo'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($result[$i]->pnr_no!='') echo $result[$i]->pnr_no; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingConfirmationNo'];?> </span></td>
																						<td><span class="ansrlbl"><?php if($result[0]->booking_no!='') echo $result[0]->booking_no; else echo ''; ?></span></td>
																					</tr>
																					
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionStatus'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->payment_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TransactionID'];?> </span></td>
																						<td><span class="ansrlbl"><?php echo $result[0]->transaction_id; ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TripType'];?></span></td>
																						<td><span class="ansrlbl"><?php echo $transfer[0]->trip_type; ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['VehicleType'];?></span></td>
																						<td><span class="ansrlbl"><strong><?php echo strtoupper($BookingRes->vehicle_type); ?></strong></span></td>
																					</tr>
																					<tr>
																						<?php 
																						$response_arr=json_decode(base64_decode($transfer[0]->addservice_response));
																					if($transfer[0]->trip_type=='oneway'){ 
																						if($result[0]->transferType == 'IN'){ 
																							echo "<td class='col-xs-4 bortd'><span class='labltbl'>".$this->fly2escape['PreBooking']['Trip']." </span></td>";
																							echo "<td class='bortd'><span class='ansrlbl'><strong>".$this->fly2escape['PreBooking']['Terminal'].": </strong>".$result[0]->pickup_city_name." ".$this->fly2escape['PreBooking']['To']." <strong>".$this->fly2escape['PreBooking']['Hotel'].": </strong>".$result[0]->dropoff_city_name.'</span>';
																						 } else { 
																							echo "<span class='airlblxl'><strong>".$this->fly2escape['PreBooking']['Hotel'].": </strong>".$result[0]->pickup_city_name." ".$this->fly2escape['PreBooking']['To']." <strong>".$this->fly2escape['PreBooking']['Terminal']." : </strong>".$result[0]->dropoff_city_name.'</span>';
																						 }
																						 echo "<br/><span class='airlblxl'><strong>".$this->fly2escape['PreBooking']['FlightNo']." : </strong>".$transfer[0]->departure_flight_no.'</span></td>';
																					} else {
																					$response_arr=json_decode(base64_decode($transfer[0]->addservice_response));
																					//echo "<pre/>"; print_r($response_arr); exit;
																					$t=1;
																					 foreach($response_arr as $resp_array){
																					 if($resp_array->transferType == 'IN'){ 
																						echo "<td class='col-xs-4 bortd'><span class='labltbl'>".$this->fly2escape['PreBooking']['Trip']." ".$t."</span></td> <td class='bortd'><span class='ansrlbl'><strong>".$this->fly2escape['PreBooking']['Terminal']." : </strong>".$resp_array->PickupLocationName." ".$this->fly2escape['PreBooking']['To']." <strong>".$this->fly2escape['PreBooking']['Hotel']." : </strong>".$resp_array->DestinationLocationName.'</span> ';
																					 } else { 
																					 echo "<tr><td class='col-xs-4 bortd'><span class='labltbl'>".$this->fly2escape['PreBooking']['Trip']." ".$t."</span></td><td class='bortd'><span class='ansrlbl'><strong>".$this->fly2escape['PreBooking']['Hotel']." : </strong>".$resp_array->PickupLocationName." ".$this->fly2escape['PreBooking']['To']." <strong>".$this->fly2escape['PreBooking']['Terminal']." : </strong>".$resp_array->DestinationLocationName.'';
																					 } echo '<br/><strong>'.$this->fly2escape['PreBooking']['FlightNo'].' : </strong>'; if($t==1){ echo $transfer[0]->departure_flight_no.'</span></td>'; } else { echo $transfer[0]->return_flight_no.'</span></td>'; } $t++; } } 
																					 ?>
																					</tr>
																				</table>
																			</div>
																		</div>
																	</div>
																
																<div class="moreflt spltopbk martrip">
																<?php
																$dep = strtotime($transfer[0]->departure_date);
																if(!empty($booking_transfer->return_date)) {
																	$arv = strtotime($booking_transfer->return_date);
																} else { $arv =''; }
																$absDateDiff = abs($arv - $dep);
																$nights = floor($absDateDiff / (60 * 60 * 24));
																?>
																	<div class="ontypsec">
																		<div class="allboxflt">
																			<div class="col-xs-4 nopadding">
																				<div class="jetimg"><img src="<?php if($transfer[0]->image == '') echo base_url().'assets/images/no-image.jpg'; else echo $transfer[0]->image; ?>" alt="" /></div>
																				<div class="alldiscrpo">
																					
																					<span class="sgsmal"></span>
																				</div>
																			</div>
																			<div class="col-xs-8 nopadding">
																				<div class="col-xs-10 nopadding">
																					<span class="portnme">
																						<strong><?php echo $this->fly2escape['Voucher']['DepartureDateTime']; ?> : </strong><?php echo $transfer[0]->departure_date.' - '.$transfer[0]->departure_time; ?>
																					</span><br>
																					
																					<?php if($transfer[0]->trip_type=="circle"){ ?>
																							<span class="portnme">
																								<strong><?php echo $this->fly2escape['Voucher']['ReturnDateTime'];?> : </strong><?php echo $transfer[0]->return_date.' - '.$transfer[0]->return_time; ?>
																							</span><br>
																							
																					<?php	}	?>
																				</div>
																			</div>
																		</div>
																	</div> 
																</div>
																	<?php } ?>
															</div>
														
															<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs"><?php echo $this->fly2escape['Voucher']['Travelers'];?>: 
																	<span class="fa fa-male"></span> <?php echo $transfer[0]->adult; ?> | <span class="fa fa-child"></span> <?php echo $transfer[0]->child; ?></div>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['TotalAmount'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(($result[0]->total_price * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																</div>
															</div>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['ServiceDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PickupDescription'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->transferinfo_description; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PickupDateTime'];?></span></td>
												<td><span class="ansrlbl">
													<?php if($BookingRes->transfer_pickup_info == '||') { 
														echo 'N/A'; 
													} else { 
														$pickup = explode('|',$BookingRes->transfer_pickup_info); 
														echo date('d/m/Y', strtotime($pickup[0])).' '.date('H:i', strtotime($pickup[1])).'h';
													} ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ServiceSpecificInfo'];?></span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->specific_transfer_listval; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MaximumWaitingTime'];?></span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->MaximumWaitingTime_val; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MaxWaitingTimeDomesticSupplier'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->MaximumWaitingTimeSupplierDomestic_val; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MaxWaitingTimeInternationalSupplier'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->MaximumWaitingtimeSupplierInternational_val; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ServiceGenericInformation'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $BookingRes->GenericTransferGuidelinesList_val; ?></span></td>
											</tr>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ConsultingInformation'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PleaseVisit'];?> <?php echo $BookingRes->TransferWebInformation_val; ?>, <?php echo $BookingRes->TimeBeforeConsultingWeb_val; ?> <?php echo $this->fly2escape['Voucher']['ContactHours']; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ServiceIncludes'];?> </span></td>
												<td><span class="ansrlbl"><?php  
													
												if($transfer[0]->trip_type=="circle"){
													foreach($transferResponse[0]['InfoList'] as $info){
														echo '<span class="icontk fa fa-check"></span> '.$info.'<br>';
													}
												} else {
													$includes = json_decode(base64_decode($BookingRes->Transfer_bullet_info),1);
													if(!empty($includes)){
														foreach($includes as $service_includes){
															echo '<span class="icontk fa fa-check"></span> '.$service_includes.'<br>';
														 }
													 } else {
														echo 'N/A';
													 }
												}
												 ?>
												</span></td>
											</tr>
										</table>
									</td>
								</tr>			
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CustomerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['EmailID'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $transfer[0]->billing_email; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MobileNumber'];?>  </span></td>
												<td><span class="ansrlbl"><?php echo $transfer[0]->billing_phone; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Address'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $transfer[0]->billing_city.', '.$transfer[0]->billing_state.', '.$transfer[0]->billing_country.' - '.$transfer[0]->billing_zip; ?></span></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['PassengerDetails'];?></div></td>
									
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<?php $travellers = json_decode($transfer[0]->traveler_info, 1); ?>
											<tr class="psngrdetsl">
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerName'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerType'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['Status'];?> </span></td>
											</tr>
											<?php if (isset($travellers['adult']) && !empty($travellers['adult'])) {
												foreach ($travellers['adult'] as $key => $adult_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $adult_details['username']." ".$adult_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ADT'];?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } if (isset($travellers['child']) && !empty($travellers['child'])) {
											$child_age = json_decode(base64_decode($transfer[0]->addservice_request))->childAges;
											//echo "<pre>"; print_r(json_decode(base64_decode($transfer[0]->addservice_request))); exit;
											foreach ($travellers['child'] as $key => $child_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $child_details['username']." ".$child_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['CHD'];?> (<?php echo $child_age[$key];?> <?php echo $this->fly2escape['Voucher']['YearsOld']; ?>) </span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } ?>
										</table>
									</td>
								</tr>
								
								<tr>
									<?php 
									
									if(!empty($BookingRes->CancellationPolicy)) {
									?>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CancellationPolicies'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $BookingRes->CancellationPolicy; ?>
												</td>
											</tr>
											<?php if(!empty($BookingRes->total_price_con))
											{?>
											<tr>
												<td><?php echo $this->fly2escape['Voucher']['ReturnAmount'];?> : <?php echo $_SESSION['currency'] . ' ' . number_format(($BookingRes->total_price_con * $_SESSION['currency_value']), 2, '.', '');; ?></td>
											</tr>
											<?php }?>
										</table>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['BookableAndPayableby'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $this->fly2escape['Voucher']['PayableThrough'];?> <strong><?php echo $BookingRes->supplier_name; ?></strong>, <?php echo $this->fly2escape['Voucher']['ActingasAgent'];?>: <strong><?php echo $BookingRes->supplier_vat.' '; ?></strong> <?php if($BookingRes->AgencyReference != ''){?> <?php echo $this->fly2escape['Voucher']['AgencyReference'];?>: <strong><?php echo $BookingRes->AgencyReference; ?></strong><?php } ?> <?php echo $this->fly2escape['Voucher']['BookingSupplierReference']; ?>: <strong><?php echo $BookingRes->LocatorCode; ?></strong>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php }else if($result[0]->module == 'FLIGHT') {
									$flight = $this->Flight_Model->get_booking_cart_flight_data($result[0]->ref_id)->result();
									if($flight[0]->api_type != "ypsilon_Model"){
											$flightRequest  = json_decode(base64_decode($flight[0]->airpriceresopnse));
											$flight_sequence = $flightRequest->Body->AirPriceRsp->AirItinerary->AirSegment;
										} else{
											$flight_sequence            = json_decode(base64_decode($flight[0]->response));
										}
									
									//echo "<pre/>"; print_r($flight[0]); exit;
								?>
									<tr>
									<td>
										<div class="grngv"><?php echo $this->fly2escape['Voucher']['Hello'];?>, <?php echo $result[0]->leadpax; ?><br />
											<p><?php echo $this->fly2escape['Voucher']['CheckFlightDates'];?>.</p>
										</div>
									</td>
								</tr>
								
								 <tr>
								<td>
									<div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['BookingDetails'];?></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<table class="insideone celpad5">
										
										<tr>
											<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingConfirmationNo'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $result[0]->booking_no; ?></span></td>
										</tr>
										<tr>
											<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['BookingStatus'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $result[0]->booking_status; ?></span></td>
										</tr>
										<tr>
											<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['PNRNo'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $result[0]->pnr_no; ?></span></td>
										</tr>
										<?php if(($flight[0]->seat_code != "Null") && ($flight[0]->seat_code != "")){ ?>
										<tr>
											<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['SeatNumber'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $flight[0]->seat_code; ?></span></td>
										</tr>
										<?php } ?>
										<?php if(($flight[0]->baggages_weight != "Null") && ($flight[0]->baggages_weight != "")){ ?>
										<tr>
											<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['OBAGGAGESSELECTED'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $flight[0]->baggages_weight; ?>&nbsp;Kg</span></td>
										</tr>
										<?php } ?>
										<?php if(($flight[0]->baggages_inbound_weight != "Null") && ($flight[0]->baggages_inbound_weight != "")){ ?>
										<tr>
											<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['IBAGGAGESSELECTED'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $flight[0]->baggages_inbound_weight; ?>&nbsp;Kg</span></td>
										</tr>
										<?php } ?>
										<?php if(($flight[0]->baggages_price != "Null") && ($flight[0]->baggages_price != "")){ 
											$rdata = number_format(((($flight[0]->baggages_price + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', '');
										?>
										<tr>
											<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['OpBAGGAGESSELECTED'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $_SESSION['currency'] . ' ' . $rdata ?></span></td>
										</tr>
										<?php } else{

											}?>
										<?php if(($flight[0]->baggages_iprice != "Null") && ($flight[0]->baggages_iprice != "")){ 
											$idata = number_format(((($flight[0]->baggages_iprice + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', '');
										?>
										<tr>
											<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['IpBAGGAGESSELECTED'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $_SESSION['currency'] . ' ' . $idata ?></span></td>
										</tr>
										<?php } else{

											}?>
										<tr>
											<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Travelers'];?> :</span></td>
											<td><span class="ansrlbl"><span class="fa fa-male"></span> <?php echo $flight[0]->adult_count ?> | <span class="fa fa-child"></span> <?php echo $flight[0]->child_count ?>| <span class="fa fa-child"></span> <?php echo $flight[0]->infants_count ?></span></td>
										</tr>
										<tr>
											<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['TotalAmount'];?> :</span></td>
											<td><span class="ansrlbl"><?php echo $_SESSION['currency'] . ' ' . number_format(((($flight[0]->TotalPrice + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup  + $rdata + $idata) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', ''); ?></span></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['FlightDetails'];?></div>
								</td>
							</tr>
								 <tr>
								<td>
									<table class="insideone celpad5">
										<tr>
											<td>
												
											<div class="splvchr">
												<div class="topalldesc">
													<div class="col-xs-12 nopadding celtbcel">
														<div class="moreflt spltopbk">
															<?php 
																						$attributes = "@attributes";
																						if($flight[0]->journeyType =='oneway'){ 
																							if (count($flight_sequence) == 1) {
																								if ($flight[0]->api_type == "ypsilon_Model") {
																									 //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";die;
																									$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[0]->segments[0]->Origin);
																									$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[0]->segments[0]->Destination);
																									$origin = $origin.'('.$flight_sequence[0]->segments[0]->Origin.')';
																									$destination = $destination.'('.$flight_sequence[0]->segments[0]->Destination.')';
																									//echo "<span class='airlblxl'>Origin: ".$origin.'</span>';
																									//echo "<span class='airlblxl'>Destination: ".$destination.'</span>';
																									$departure_time = date("d\ M\ Y",strtotime($flight_sequence[0]->segments[0]->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence[0]->segments[0]->DepartureTime));
			$flight_number = $flight_sequence[0]->segments[0]->FlightNumber.'</span>';
			$arrival_time = date("d\ M\ Y",strtotime($flight_sequence[0]->segments[0]->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence[0]->segments[count($flight_sequence[0]->segments) - 1]->ArrivalTime));
																									$flight_number = $flight_sequence[0]->segments[0]->FlightNumber.'</span>';
																									$stop = count($flight_sequence[0]->segments) - 1;
																									$time_lenght = explode(":", $flight_sequence[0]->segments[0]->FlightTime);
																									$duration_time = floor($time_lenght[0]).'H'.floor($time_lenght[1]);
																									$image = "http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/".$flight_sequence[0]->segments[0]->Carrier.".gif";
																									//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';?>
																									<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																													<?php $air_data['AirLineCode'] =  $flight_sequence[0]->segments[0]->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																													if (!empty($airline)) {
																														echo $airline->AirLineName;
																													}
																													?>
																													<span class="sgsmal"><?php echo $flight_sequence[0]->segments[0]->FlightNumber; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin ?></span>
																													<span class="portnme"> <?php echo $departure_time ?> </span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination ?></span>
																													<span class="portnme"><?php echo $arrival_time ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr">3h 35m</span>
																												<!-- <span class="portnme textcntr"> <?php echo $stop ?> <?php echo $stop ?> <?php echo $this->fly2escape['Voucher']['Stop'];?> </span> -->
																											</div>
																										</div>
																									</div>
																									<div class="clearfix"></div>
																		
																								<?php } else {
																									 //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";die;
																									$air_data['AirLineCode'] =  $flight_sequence->$attributes->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																									$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Origin);
																									$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Destination);
																									$origin = $origin.'('.$flight_sequence->$attributes->Origin.')';
																									$destination = $destination.'('.$flight_sequence->$attributes->Destination.')';
																								$departure_time = date("d\ M\ Y",strtotime($flight_sequence->$attributes->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence->$attributes->DepartureTime));
																								$arrival_time = date("d\ M\ Y",strtotime($flight_sequence->$attributes->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence->$attributes->ArrivalTime));
																								$stop = count($flight_sequence->FlightDetails) - 1;
																								$duration_time = floor($flight_sequence->$attributes->TravelTime / 60).'H'.floor($flight_sequence->$attributes->TravelTime % 60);
																								  $flight_number = $flight_sequence->$attributes->FlightNumber.'</span>';
																									$image = "https://www.amadeus.net/static/img/static/airlines/medium/".$flight_sequence->$attributes->Carrier.".png";
																									//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';
																								}
																								?>
																								<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																													 <?php 
																													 if(!empty($airline)){
																														echo $airline->AirLineName;
																													 }
																													?>
																													<span class="sgsmal"><?php echo $flight_number; ?><br />
																													737-800</span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin ?></span>
																													<span class="portnme"> <?php echo $departure_time ?></span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination ?></span>
																													<span class="portnme"><?php echo $arrival_time ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr"><?php echo $duration_time ?></span>
																												<!-- <span class="portnme textcntr"> <?php echo $stop ?> <?php echo $stop ?> <?php echo $this->fly2escape['Voucher']['Stop'];?></span> -->
																											</div>
																										</div>
																									</div>
																								<div class="clearfix"></div>
																							<?php
																							} else {
																								
																									if ($flight[0]->api_type == "ypsilon_Model") {
																										for ($i=0; $i <count($flight_sequence) ; $i++) { 
																											$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->segments[0]->Origin);
																											$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->Destination);
																											$origin = $origin.'('.$flight_sequence[$i]->segments[0]->Origin.')';
																											$destination = $destination.'('.$flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->Destination.')';
																											//echo "<span class='airlblxl'>Origin: &nbsp".$origin.'</span>';
																											//echo "<span class='airlblxl'>&nbspDestination:&nbsp ".$destination.'</span>';
																											$departure_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->segments[0]->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->segments[0]->DepartureTime));
			$flight_number = $flight_sequence[$i]->segments[0]->FlightNumber.'</span>';                     $stop = count($flight_sequence[$i]->segments) - 1;
			$arrival_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->segments[0]->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->ArrivalTime));
																											$flight_number = $flight_sequence[$i]->segments[0]->FlightNumber.'</span>';
																											$duration_time = floor(date("H:i",strtotime($flight_sequence[$i]->segments[0]->FlightTime)) / 60).'H'.floor(date("H:i",strtotime($flight_sequence[$i]->segments[0]->FlightTime)) % 60);
																											$image = "http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/".$flight_sequence[$i]->$attributes->Carrier.".gif";
																											//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';?>
																											<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																													<?php $air_data['AirLineCode'] =  $flight_sequence[$i]->segments[0]->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																													if (!empty($airline)) {
																														echo $airline->AirLineName;
																													}
																													?>
																													<span class="sgsmal"><?php echo $flight_sequence[$i]->segments[0]->FlightNumber; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin ?></span>
																													<span class="portnme"> <?php echo $departure_time ?> </span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination ?></span>
																													<span class="portnme"><?php echo $arrival_time ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr"><?php echo $duration_time; ?></span>
																												<!-- <span class="portnme textcntr"> <?php echo $stop ?> <?php echo $stop ?> <?php echo $this->fly2escape['Voucher']['Stop'];?> </span> -->
																											</div>
																										</div>
																									</div>
																									<div class="clearfix"></div>
																										<?php }
																									} else {
																											$attributes = "@attributes";
																								for ($i=0; $i <count($flight_sequence) ; $i++) { 
																									 //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";;die;
																								$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Origin);
																								$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Destination);
																								$origin = $origin.'('.$flight_sequence[$i]->$attributes->Origin.')';
																								$destination = $destination.'('.$flight_sequence[$i]->$attributes->Destination.')';
																								$departure_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->$attributes->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->$attributes->DepartureTime));
																								$arrival_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->$attributes->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->$attributes->ArrivalTime));
																								$stop = count($flight_sequence);
																								$mjourney =  strtotime(date('Y-m-d H:i:s',strtotime($flight_sequence[$i]->$attributes->DepartureTime)));
												                                                $mjourney1 =  strtotime(date('Y-m-d H:i:s',strtotime($flight_sequence[$i]->$attributes->ArrivalTime)));
												                                                $time = round(abs($mjourney1 - $mjourney) / 60,2);
												                                                $hours = floor($time / 60);
												                                                $minutes = ($time % 60);
												                                                $duration_time = $hours.' H '.$minutes.' M';
																								$flight_number = $flight_sequence[$i]->$attributes->FlightNumber.'</span>';
																								$image = "http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/".$flight_sequence[$i]->$attributes->Carrier.".gif";
																								//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';?>
																								<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																												   <?php $air_data['AirLineCode'] =  $flight_sequence[$i]->$attributes->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																													if (!empty($airline)) {
																														echo $airline->AirLineName;
																													}?>
																													<span class="sgsmal"><?php echo $flight_number; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin; ?></span>
																													<span class="portnme"> <?php echo $departure_time; ?></span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination; ?></span>
																													<span class="portnme"><?php echo $arrival_time; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr"><?php echo $duration_time; ?></span>
																												<!-- <span class="portnme textcntr"><?php echo $stop ?><?php echo $stop; ?> <?php echo $this->fly2escape['Voucher']['Stop'];?></span> -->
																											</div>
																										</div>
																									</div>
																									<div class="clearfix"></div>
																										<?php }
																									}
																									
																								?>
																								
																							<?php }
																							
																							
																							
																						} else {
																						//echo "<pre/>";    print_r($flight);die;
																						if ($flight[0]->api_type == "ypsilon_Model") {
																							for ($i=0; $i <count($flight_sequence) ; $i++) { 
																								//echo "<pre/>";print_r($flight_sequence);die;
																								$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->segments[0]->Origin);
																								$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->Destination);
																								$origin = $origin.'('.$flight_sequence[$i]->segments[0]->Origin.')';
																								$destination = $destination.'('.$flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->Destination.')';
																								$time_lenght = explode(":", $flight_sequence[$i]->segments[0]->FlightTime);
																								$duration_time = $time_lenght[0]."H".$time_lenght[1]."M";
																								//echo "<span class='airlblxl'>Origin: &nbsp".$origin.'</span>';
																								//echo "<span class='airlblxl'>&nbspDestination:&nbsp ".$destination.'</span>';
																								$departure_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->segments[0]->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->segments[0]->DepartureTime));
																								$flight_number = $flight_sequence[$i]->segments[0]->FlightNumber.'</span>';
																								$arrival_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->segments[0]->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->segments[count($flight_sequence[$i]->segments) - 1]->ArrivalTime));
																								$stop = count($flight_sequence[$i]->segments) - 1;
																								$image = "http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/".$flight_sequence[$i]->segments[0]->Carrier.".gif";
																								//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';?>
																								<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																													<?php $air_data['AirLineCode'] =  $flight_sequence[$i]->segments[0]->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																													if (!empty($airline)) {
																														echo $airline->AirLineName;
																													}?>
																													<span class="sgsmal"><?php echo $flight_sequence[$i]->segments[0]->FlightNumber; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin; ?></span>
																													<span class="portnme"> <?php echo $departure_time; ?> </span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination; ?></span>
																													<span class="portnme"><?php echo $arrival_time; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr"><?php echo $duration_time; ?></span>
																												<!-- <span class="portnme textcntr"> <?php echo $stop ?> <?php echo $stop ?> <?php echo $this->fly2escape['Voucher']['Stop'];?> </span> -->
																											</div>
																										</div>
																									</div>
																									<div class="clearfix"></div>
																							<?php }
																						} else {
																							$attributes = "@attributes";
																								for ($i=0; $i <count($flight_sequence) ; $i++) { 
																									// echo "<pre>"; print_r($flight_sequence); echo "<pre/>";;die;
																								$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Origin);
																								$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Destination);
																								$origin = $origin.'('.$flight_sequence[$i]->$attributes->Origin.')';
																								$destination = $destination.'('.$flight_sequence[$i]->$attributes->Destination.')';
																								$departure_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->$attributes->DepartureTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->$attributes->DepartureTime));
																								$arrival_time = date("d\ M\ Y",strtotime($flight_sequence[$i]->$attributes->ArrivalTime))."&nbsp".date("H:i",strtotime($flight_sequence[$i]->$attributes->ArrivalTime));
																								$stop = count($flight_sequence[$i]->FlightDetails) - 1;
																								$duration_time = floor($flight_sequence[$i]->$attributes->TravelTime / 60).'H'.floor($flight_sequence[$i]->$attributes->TravelTime % 60);
																								$flight_number = $flight_sequence[$i]->$attributes->FlightNumber.'</span>';
																								$image = "http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/".$flight_sequence[$i]->$attributes->Carrier.".gif";
																								//echo '&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/'.$image.'" alt="" />';?>
																								<div class="ontypsec ">
																										<div class="allboxflt">
																											<div class="col-xs-3 nopadding centerscem">
																												<div class="jetimg"><img src="<?php echo $image ?>" alt="" /></div>
																												<div class="alldiscrpo">
																												   <?php $air_data['AirLineCode'] =  $flight_sequence[$i]->$attributes->Carrier;
																													$airline =  $this->Flight_Model->getAirLineName($air_data)->row(); 
																													if (!empty($airline)) {
																														echo $airline->AirLineName;
																													}?>
																													<span class="sgsmal"><?php echo $flight_number ?></span>
																												</div>
																											</div>
																											<div class="col-xs-7 nopadding centerscem">
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $origin; ?></span>
																													<span class="portnme"> <?php echo $departure_time; ?></span>
																												</div>
																												<div class="col-xs-2 nopadding">
																													<span class="fadr fa fa-long-arrow-right textcntr"></span>
																												</div>
																												<div class="col-xs-5">
																													<span class="airlblxl"><?php echo $destination; ?></span>
																													<span class="portnme"><?php echo $arrival_time; ?></span>
																												</div>
																											</div>
																											<div class="col-xs-2 nopadding centerscem brdbtmnone">
																												<span class="portnme textcntr"><?php echo $duration_time; ?></span>
																												<!-- <span class="portnme textcntr"><?php echo $stop; ?><?php echo $stop; ?> <?php echo $this->fly2escape['Voucher']['Stop'];?></span> -->
																											</div>
																										</div>
																									</div>
																									<div class="clearfix"></div>
																							<?php }
																						}
																						?>
																								
																							<?php 
																						  } 
																						 ?>

															
															<!-- <div class="ontypsec">
																<div class="allboxflt">
																	<div class="col-xs-3 nopadding centerscem">
																		<div class="jetimg"><img src="images/smAI.gif" alt="" /></div>
																		<div class="alldiscrpo">
																			SpiceJet 
																			<span class="sgsmal">SG-13 Boeing <br />
																			737-800</span>
																		</div>
																	</div>
																	<div class="col-xs-7 nopadding centerscem">
																		<div class="col-xs-5">
																			<span class="airlblxl"> Mumbai (BOM)</span>
																			<span class="portnme"> 26 Jun, 08:30 </span>
																		</div>
																		<div class="col-xs-2 nopadding"><span class="fadr fa fa-long-arrow-right textcntr"></span></div>
																		<div class="col-xs-5">
																			<span class="airlblxl">Dubai (DXB)</span>
																			<span class="portnme">26 Jun, 08:30</span>
																		</div>
																	</div>
																	<div class="col-xs-2 nopadding centerscem brdbtmnone">
																		<span class="portnme textcntr">3h 35m</span>
																		<span class="portnme textcntr"> Non Stop </span>
																	</div>
																</div>
															</div> -->  
														</div>
													</div>
												</div>
											</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
											
							
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<div class="splvchr">
														<div class="topalldesc">
															<div class="col-xs-8 nopadding celtbcel">
																<?php for( $i=0; $i<count($result); $i++){$status = $result[$i]->booking_status ?>
																	<div class="moreflt spltopbk">
																		<div class="ontypsec">
																			<div class="allboxflt">
																				<table class="insideone celpad5">
																					
																					<tr>
																					
																					</tr>
																				</table>
																			</div>
																			<div class="col-xs-8 nopadding">
																				<div class="col-xs-10 nopadding">
																					<span class="portnme">
																						<?php if($flight[0]->api_type == "ypsilon_Model"){ ?>
																							<strong><?php echo $this->fly2escape['Voucher']['DepartureDateTime'];?> : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence[0]->segments[0]->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence[0]->segments[0]->DepartureTime)); ?>
																						<?php }else{?>
																								<?php if(count($flight_sequence) > 1){?>
																									<strong><?php echo $this->fly2escape['Voucher']['DepartureDateTime'];?> : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence[0]->$attributes->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence[0]->$attributes->DepartureTime)); ?>
																								<?php }else{?>
																									<strong><?php echo $this->fly2escape['Voucher']['DepartureDateTime'];?> : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence->$attributes->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence->$attributes->DepartureTime)); ?>
																								<?php } ?>
																						<?php } ?>
																						
																					</span><br>
																					
																					<?php //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";die;
																					if($flight[0]->journeyType =="circle")
																					{
																						?>
																							<span class="portnme">
																								<?php if($flight[0]->api_type == "ypsilon_Model"){?>
																									<strong><?php echo $this->fly2escape['Voucher']['ReturnDateTime'];?> : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence[1]->segments[0]->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence[1]->segments[0]->DepartureTime)); ?>
																								<?php }else{?>
																									<strong><?php echo $this->fly2escape['Voucher']['ReturnDateTime'];?> : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence[2]->$attributes->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence[2]->$attributes->DepartureTime)); ?>
																								<?php } ?>
																								
																							</span><br>
																							
																						<?php
																					}
																					?>
																				</div>
																			</div>
																		</div>
																	</div>
																
																<div class="moreflt spltopbk martrip">
																<?php  //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";die;
																		if ($flight[0]->api_type == "ypsilon_Model") {
																			$dep = strtotime($flight_sequence[0]->segments[0]->DepartureTime);
																		} else {
																			if (count($flight_sequence) > 1) {
																				$dep = strtotime($flight_sequence[0]->$attributes->DepartureTime);
																			} else {
																				$dep = strtotime($flight_sequence->$attributes->DepartureTime);
																			}
																			
																		}
																		
																		if(!empty($flight[0]->journeyType == 'circle')) {
																			if ($flight[0]->api_type == "ypsilon_Model") {
																				$arv = strtotime($flight_sequence[0]->segments[0]->DepartureTime);
																			} else {
																				$arv = strtotime($flight_sequence[0]->$attributes->DepartureTime);
																			}
																			
																		} else { $arv =''; }
																		$absDateDiff = abs($arv - $dep);
																		$nights = floor($absDateDiff / (60 * 60 * 24));
																	?>
																	
																</div>
																	
															</div>
															<?php 
															$ampl = "@attributes";
															//echo "<pre/>";print_r(explode("N", $flightRequest->Body->AirPriceRsp->AirPriceResult->AirPricingSolution->$ampl->ApproximateBasePrice));
															$base_price = explode("N", $flightRequest->Body->AirPriceRsp->AirPriceResult->AirPricingSolution->$ampl->ApproximateBasePrice);
															$tax_price = explode("N", $flightRequest->Body->AirPriceRsp->AirPriceResult->AirPricingSolution->$ampl->Taxes);
															 ?>
															<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs"><?php echo $this->fly2escape['Voucher']['Travelers'];?>: 
																	<span class="fa fa-male"></span> <?php echo $flight[0]->adult_count; ?> | <span class="fa fa-child"></span> <?php echo $flight[0]->child_count; ?></div>
																	<?php if($status !='FAILED'){?>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['BASEPRICE'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(((($base_price[1] + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['TAXPRICE'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(((($tax_price[1] + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['TotalAmount'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(((($flight[0]->TotalPrice + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup  + $rdata + $idata) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																	<?php }else{?>
																	<div class="totlbkamnt"> <?php echo $this->fly2escape['Voucher']['TotalAmount'];?> <br /><?php echo $_SESSION['currency'] . ' ' . number_format(0, 2, '.', ''); ?></div>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CustomerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['EmailID'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_EMAIL; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['MobileNumber'];?>  </span></td>
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_PHONE; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl"><?php echo $this->fly2escape['Voucher']['Address'];?> </span></td>
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_CITY; ?>, <?php echo $flight[0]->BILLING_STATE; ?>, <?php echo $flight[0]->BILLING_COUNTRY; ?> - <?php echo $flight[0]->BILLING_ZIP; ?></span></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['PassengerDetails'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<?php $travellers = json_decode($flight[0]->TravelerDetails, 1); ?>
											<tr class="psngrdetsl">
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerName'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['PassengerType'];?> </span></td>
												<td class="col-xs-4"><span class="ansrlbl"><?php echo $this->fly2escape['Voucher']['Status'];?> </span></td>
											</tr>
											<?php if (isset($travellers['adult']) && !empty($travellers['adult'])) {
												foreach ($travellers['adult'] as $key => $adult_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $adult_details['username']." ".$adult_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['ADT'];?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } if (isset($travellers['child']) && !empty($travellers['child'])) {
											foreach ($travellers['child'] as $key => $child_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $child_details['username']." ".$child_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $this->fly2escape['Voucher']['CHD'];?></span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } ?>
										</table>
									</td>
								</tr>
								<tr>
									<?php if(!empty($transfer[0]->cancellation_policy_super_admin)) {
									?>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['CancellationPolicies'];?></div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $transfer[0]->cancellation_policy_super_admin; ?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
								}
								}
							}
								/*} else if($result[0]->module == 'FLIGHT') {
									$flight = $this->Flight_Model->get_booking_cart_flight_data($result[0]->ref_id)->result();
									$flightRequest  = json_decode(base64_decode($flight[0]->airpriceresopnse));
									$flight_sequence = $flightRequest->Body->AirPriceRsp->AirItinerary->AirSegment;
									//echo "<pre/>"; print_r(json_decode($flight[0]->booking_res)); exit;
								?>
									<tr>
									<td>
										<div class="grngv">Hello, <?php echo $result[0]->leadpax; ?><br />
											<p>Please check on your Flight Details Departure dates & Schedule Your Tour Accordingly.</p>
										</div>
									</td>
								</tr>
								<tr>
									<td><div class="pagesubhdngv">Itinerary</div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<div class="splvchr">
														<div class="topalldesc">
															<div class="col-xs-8 nopadding celtbcel">
																<?php for( $i=0; $i<count($result); $i++){$status = $result[$i]->booking_status ?>
																	<div class="moreflt spltopbk">
																		<div class="ontypsec">
																			<div class="allboxflt">
																				<table class="insideone celpad5">
																					<tr>
																						<td class="col-xs-4"><span class="labltbl">Booking Status </span></td>
																						<td><span class="ansrlbl"><?php echo $result[$i]->booking_status; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl">PNR No </span></td>
																						<td><span class="ansrlbl"><?php if($result[$i]->pnr_no!='') echo $result[$i]->pnr_no; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td><span class="labltbl">Booking Confirmation No </span></td>
																						<td><span class="ansrlbl"><?php if($result[0]->booking_no!='') echo $result[0]->booking_no; else echo ''; ?></span></td>
																					</tr>
																					<tr>
																						<td class="col-xs-4"><span class="labltbl">Trip Type</span></td>
																						<td><span class="ansrlbl"><?php echo $flight[0]->journeyType; ?></span></td>
																					</tr>
																					<tr>
																					<?php 
																						$attributes = "@attributes";
																						if($flight[0]->journeyType =='oneway'){ 
																							if (count($flight_sequence) == 1) {
																								//echo "<pre/>";print_r($flight_sequence);die;
																								$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Origin);
																								$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Destination);
																								$origin = $origin.'('.$flight_sequence->$attributes->Origin.')';
																								$destination = $destination.'('.$flight_sequence->$attributes->Destination.')';
																								echo "<span class='airlblxl'>Origin: &nbsp".$origin.'</span>';
																								echo "<span class='airlblxl'>&nbspDestination:&nbsp ".$destination.'</span>';
																								echo "<span class='airlblxl'>&nbsp Flight No:&nbsp ".$flight_sequence->$attributes->FlightNumber.'</span>';
																								$image = $flight_sequence->$attributes->Carrier.".png";?>
																								&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/<?php echo $image ?>" alt="" />
																							<?php
																							} else {
																								for ($i=0; $i <count($flight_sequence) ; $i++) { 
																								$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Origin);
																								$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence->$attributes->Destination);
																								$origin = $origin.'('.$flight_sequence->$attributes->Origin.')';
																								$destination = $destination.'('.$flight_sequence->$attributes->Destination.')';
																								echo "<span class='airlblxl'>Origin: &nbsp".$origin.'</span>';
																								echo "<span class='airlblxl'>&nbspDestination:&nbsp ".$destination.'</span>';
																								echo "<span class='airlblxl'>&nbsp Flight No:&nbsp ".$flight_sequence->$attributes->FlightNumber.'</span>';
																								$image = $flight_sequence->$attributes->Carrier.".png";?>
																								&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/<?php echo $image ?>" alt="" />
																							<?php }
																							}
																							
																							
																						} else {
																						for ($i=0; $i <count($flight_sequence) ; $i++) { 
																							$attributes = "@attributes";
																							//echo "<pre/>"; print_r($flight_sequence);die();
																							$origin = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Origin);
																							$destination = $this->Flight_Model->get_airport_cityname1($flight_sequence[$i]->$attributes->Destination);
																							$origin = $origin.'('.$flight_sequence[$i]->$attributes->Origin.')';
																							$destination = $destination.'('.$flight_sequence[$i]->$attributes->Destination.')';
																								echo "<span class='airlblxl'>Origin: &nbsp".$origin.'</span>';
																								echo "<span class='airlblxl'>&nbspDestination:&nbsp ".$destination.'</span>';
																								echo "<span class='airlblxl'>&nbsp Flight No:&nbsp ".$flight_sequence[$i]->$attributes->FlightNumber.'</span>';
																								$image = $flight_sequence[$i]->$attributes->Carrier.".png";?>
																								&nbsp Airline <img src="https://www.amadeus.net/static/img/static/airlines/medium/<?php echo $image ?>" alt="" />
																							<?php }
																						  } 
																						 ?>
																					</tr>
																				</table>
																			</div>
																			<div class="col-xs-8 nopadding">
																				<div class="col-xs-10 nopadding">
																					<span class="portnme">
																						<strong>Departure Date & Time : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence->$attributes->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence->$attributes->DepartureTime)); ?>
																					</span><br>
																					
																					<?php //echo "<pre>"; print_r($flight_sequence); echo "<pre/>";die;
																					if($flight[0]->journeyType =="circle")
																					{
																						?>
																							<span class="portnme">
																								<strong>Return Date & Time : </strong><?php echo date("d\ M\ Y",strtotime($flight_sequence[0]->$attributes->DepartureTime)); ?> - <?php echo date("h:i",strtotime($flight_sequence[0]->$attributes->DepartureTime)); ?>
																							</span><br>
																							
																						<?php
																					}
																					?>
																				</div>
																			</div>
																		</div>
																	</div>
																
																
																	
															</div>
															<div class="col-xs-3 nopadding celtbcel colrcelo">
																<div class="bokkpricesml">
																	<div class="travlrs">Travelers: 
																	<span class="fa fa-male"></span> <?php echo $flight[0]->adult_count; ?> | <span class="fa fa-child"></span> <?php echo $flight[0]->child_count; ?></div>
																	<?php if($status !='FAILED'){?>
																	<div class="totlbkamnt"> Total Amount <br /><?php echo $_SESSION['currency'] . ' ' . number_format(((($flight[0]->TotalPrice + $flight[0]->MyMarkup + $flight[0]->AdminMarkup + $flight[0]->aMarkup + $flight[0]->pgMarkup) - $flight[0]->DISCOUNT) * $_SESSION['currency_value']), 2, '.', ''); ?></div>
																	<?php }else{?>
																	<div class="totlbkamnt"> Total Amount <br /><?php echo $_SESSION['currency'] . ' ' . number_format(0, 2, '.', ''); ?></div>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												
												</td>
											</tr>
										</table>
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
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_EMAIL; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl">Mobile Number  </span></td>
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_PHONE; ?></span></td>
											</tr>
											<tr>
												<td><span class="labltbl">Address </span></td>
												<td><span class="ansrlbl"><?php echo $flight[0]->BILLING_CITY; ?>, <?php echo $flight[0]->BILLING_STATE; ?>, <?php echo $flight[0]->BILLING_COUNTRY; ?> - <?php echo $flight[0]->BILLING_ZIP; ?></span></td>
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
											<?php $travellers = json_decode($flight[0]->TravelerDetails, 1); ?>
											<tr class="psngrdetsl">
												<td class="col-xs-4"><span class="ansrlbl">Passenger Name </span></td>
												<td class="col-xs-4"><span class="ansrlbl">Passenger Type </span></td>
												<td class="col-xs-4"><span class="ansrlbl">Status </span></td>
											</tr>
											<?php if (isset($travellers['adult']) && !empty($travellers['adult'])) {
												foreach ($travellers['adult'] as $key => $adult_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $adult_details['username']." ".$adult_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl">ADT</span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } if (isset($travellers['child']) && !empty($travellers['child'])) {
											foreach ($travellers['child'] as $key => $child_details) { ?>
											<tr>
												<td class="col-xs-4"><span class="labltbl"><?php echo $child_details['username']." ".$child_details['surename']; ?></span></td>
												<td class="col-xs-4"><span class="labltbl">CHD</span></td>
												<td class="col-xs-4"><span class="labltbl"><?php echo $result[0]->booking_status; ?></span></td>
											</tr>
											<?php } } ?>
										</table>
									</td>
								</tr>
								<tr>
									<?php if(!empty($transfer[0]->cancellation_policy_super_admin)) {
									?>
									<td><div class="pagesubhdngv">Cancellation Policies</div></td>
								</tr>
								<tr>
									<td>
										<table class="insideone celpad5">
											<tr>
												<td>
													<?php echo $transfer[0]->cancellation_policy_super_admin; ?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
								}
								}
							}*/
								else { } ?>
								<tr>
									<td><div class="pagesubhdngv"><?php echo $this->fly2escape['Voucher']['ContactInformation'];?></div></td>
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
						</table>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php $this->load->view('general/footer'); ?>
        </div>
        <?php $this->load->view('general/load_js'); ?>
    </body>
</html>
<script>
	function PrintDiv() {    
          var divToPrint = document.getElementById('divToPrint');
          var popupWin = window.open('', '_blank', 'width=800,height=500');
          popupWin.document.open();
          popupWin.document.write('<html><head><link href="<?php echo base_url('assets/css'); ?>/bootstrap.css" rel="stylesheet" type="text/css" /><link href="<?php echo base_url('assets/css'); ?>/custom.css" rel="stylesheet" type="text/css" /><link href="<?php echo base_url('assets/css'); ?>/media.css" rel="stylesheet" type="text/css" /></head><body onload="window.print();">' + divToPrint.innerHTML + '</html>');
          popupWin.document.close();
	}
</script>
