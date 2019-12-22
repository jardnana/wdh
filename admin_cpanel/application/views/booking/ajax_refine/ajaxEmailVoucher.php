<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style type="text/css">
div, p, a, li, td {
	-webkit-text-size-adjust:none;
}
#outlook a {
	padding:0;
}
html {
	width: 100%;
}
body {
	width:100% !important;
	-webkit-text-size-adjust:100%;
	-ms-text-size-adjust:100%;
	margin:0;
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
	line-height: 100%;
}
#backgroundTable {
	margin:0;
	padding:0;
	width:100% !important;
	line-height: 100% !important;
}
img {
	outline:none;
	text-decoration:none;
	border:none;
	-ms-interpolation-mode: bicubic;
}
a img {
	border:none;
}
.image_fix {
	display:block;
}
p {
	margin: 0px 0px !important;
}
table td {
	border-collapse: collapse;
}
table {
	border-collapse:collapse;
	mso-table-lspace:0pt;
	mso-table-rspace:0pt;
}
table[class=full] {
	width: 100%;
	clear: both;
}
 @media only screen and (max-width: 640px) {
a[href^="tel"], a[href^="sms"] {
	text-decoration: none;
	color: #33b9ff;
	pointer-events: none;
	cursor: default;
}
.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
	text-decoration: default;
	color: #33b9ff !important;
	pointer-events: auto;
	cursor: default;
}
table[class=devicewidth] {
	width: 440px!important;
	text-align:center!important;
}
table[class=devicewidth2] {
	width: 440px!important;
	text-align:center!important;
}
table[class=devicewidth3] {
	width: 400px!important;
	text-align:center!important;
}
table[class=devicewidth33] {
	width: 420px!important;
	text-align:center!important;
}
table[class=devicewidthinner] {
	width: 420px!important;
	text-align:center!important;
}
img[class=banner] {
	width: 440px!important;
	height:220px!important;
}
img[class=col2img] {
	display:block;
	margin:0 auto;
}
}
 @media only screen and (max-width: 480px) {
a[href^="tel"], a[href^="sms"] {
	text-decoration: none;
	color: #33b9ff;
	pointer-events: none;
	cursor: default;
}
.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
	text-decoration: default;
	color: #33b9ff !important;
	pointer-events: auto;
	cursor: default;
}
table[class=devicewidth] {
	width: 280px!important;
	text-align:center!important;
}
table[class=devicewidth33] {
	width: 260px!important;
	text-align:center!important;
}
table[class=devicewidth2] {
	width: 280px!important;
	text-align:center!important;
}
table[class=devicewidth3] {
	width: 240px!important;
	text-align:center!important;
}
table[class=devicewidthinner] {
	width: 260px!important;
	text-align:center!important;
}
img[class=banner] {
	width: 280px!important;
	height:140px!important;
}
img[class=col2img] {
	width: 260px!important;
	height:140px!important;
}
.social {
	display: block;
	float: none;
	margin: 0 auto;
	overflow: hidden;
	padding: 10px 0;
	text-align: center !important;
	width: 100%;
}
.social div {
}
}
</style>
</head>
<body>
<table width="100%"  cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
  <tbody>
    <tr>
      <td><table width="645" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
          <tbody>
            <tr>
              <td width="100%" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);padding: 10px;"><table width="625" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                  <tbody>
                    <tr>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="left" width="100%">
                            
                            
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          	<tr>
                            <td align="left" style="padding:10px">
                                <?php if($Booking->user_type == '3'){?>
                                <img src="<?php echo ASSETS;?>images/logo.png" alt="Skywalker Travels Logo" />
                                <?php 
                    }else if($Booking->user_type == '2'){
                    $agent_d = $this->booking_model->GetUserData($Booking->user_type, $Booking->user_id)->row();
                ?>
                                <img src="<?php echo $agent_d->agent_logo;?>" alt="<?php echo $agent_d->company_name;?> Logo" width="50"/>
                                <?php }?>
                            </td>
                            <td align="right" style="padding:10px">
                              

                                <div style="color: #666; display: block; line-height: 20px; overflow: hidden; text-align: right;float: right; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                  <?php if($Booking->user_type == '3'){?>
                                  Skywalker Travels & TOURS<br />
                                  Plot 200 Rumuogba Estate off Aba Road,<br />
                                  Port Harcourt
                                  <div class="iconmania"><span class="icon icon-envelope"></span><a>bookings@skywalkertravels.com</a></div>
                                  <div class="iconmania"><span class="icon icon-phone"></span> +234 703 519 6449</div>
                                  <?php 
                    }else if($Booking->user_type == '2'){
                    $agent_d = $this->booking_model->GetUserData($Booking->user_type, $Booking->user_id)->row();
                ?>
                                  <?php echo $agent_d->company_name;?><br />
                                  <?php if($agent_d->city != '' || $agent_d->city != NULL){ echo $agent_d->city;}?>
                                  <div class="iconmania"><span class="icon icon-envelope"></span><a><?php echo $agent_d->email_id;?></a></div>
                                  <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $agent_d->mobile;?></div>
                                  <?php }?>
                                </div>                             
                              </td>
                              </tr>
                              </table>  
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="left" width="100%"><table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
                                      <tbody>
                                        <tr>
                                          <td align="left"></td>
                                          <td align="right" style="font-size:13px; line-height:20px;"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" style="border:0px; border-top:1px dashed #CCC;"><table width="100%" border="0" align="center" cellpadding="8" cellspacing="0">
                                              <tbody>
                                                <tr>
                                                  <td width="100%" style="line-height:22px;"><div class="confirmtionltr">Confirmation Letter</div></td>
                                                </tr>
                                              <tr>
                                                  <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tbody>
                                                        <tr>
                                                          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                                              <tbody>
                                                                <tr>
                                                                  <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo $Booking->leadpax;?> </strong></td>
                                                                </tr>
                                                                <tr>
                                                                  <td width="50%" align="left">Confirmation No  :</td>
                                                                  <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
                                                                </tr>
                                                                <tr>
                                                                  <td width="50%" align="left">Booking Status  :</td>
                                                                  <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
                                                                </tr>
                                                              </tbody>
                                                            </table></td>
                                                          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                                              <tbody>
                                                                <tr>
                                                                  <td colspan="2" align="left">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td width="50%" align="left">&nbsp;</td>
                                                                  <td width="50%" align="left">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left">&nbsp;</td>
                                                                  <td align="left">&nbsp;</td>
                                                                </tr>
                                                              </tbody>
                                                            </table></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <?php 
      $flight = json_decode(base64_decode($Booking->response));
      $request = json_decode(base64_decode($Booking->request));
      
      if($request->type == 'O'){
      foreach ($flight->Segments as $key => $segment) {
    ?>
                                                <tr>
                                                  <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;"><div class="dterser">
                                                              <div class="colsdets"> <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25"> DEPARTURE: <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?> </div>
                                                              <div class="snotes"> Please verify flight times prior to departure </div>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="25%" rowspan="2" style="border-right: 1px solid #eee;"><div class="padwithbord">
                                                              <div class="leftflitmg"> <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->MarketingAirlineCode;?>.png" /> </div>
                                                              <div class="fligtdetss"> <?php echo $this->booking_model->get_airline_name($segment->MarketingAirlineCode);?> <br />
                                                                <?php echo $segment->MarketingAirlineCode;?> <?php echo $segment->FlightNumber;?> </div>
                                                              <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingAirline;?></strong></div>
                                                              <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureDateTime),$this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></strong></div>
                                                            </div></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->DepartureAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->DepartureAirportCode);?></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->ArrivalAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->ArrivalAirportCode);?></td>
                                                          <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br>
                                                            <?php echo $segment->Equipment;?> <br>
                                                            <br>
                                                            Booking Class: <?php echo $segment->CabinType;?><br>
                                                            Stop(s): 0</td>
                                                        </tr>
                                                        <tr>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?></span><br></td>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></span><br></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <?php } ?>
                                                <?php
      }else if ($request->type == 'R') {
      foreach ($flight->onward->Segments as $key => $segment) {
    ?>
                                                <tr>
                                                  <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;"><div class="dterser">
                                                              <div class="colsdets"> <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25"> DEPARTURE: <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?> </div>
                                                              <div class="snotes"> Please verify flight times prior to departure </div>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="25%" rowspan="2" style="border-right: 1px solid #eee;"><div class="padwithbord">
                                                              <div class="leftflitmg"> <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->MarketingAirlineCode;?>.png" /> </div>
                                                              <div class="fligtdetss"> <?php echo $this->booking_model->get_airline_name($segment->MarketingAirlineCode);?> <br />
                                                                <?php echo $segment->MarketingAirlineCode;?> <?php echo $segment->FlightNumber;?> </div>
                                                              <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingAirline;?></strong></div>
                                                              <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureDateTime),$this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></strong></div>
                                                            </div></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->DepartureAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->DepartureAirportCode);?></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->ArrivalAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->ArrivalAirportCode);?></td>
                                                          <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br>
                                                            <?php echo $segment->Equipment;?> <br>
                                                            <br>
                                                            Booking Class: <?php echo $segment->CabinType;?><br>
                                                            Stop(s): 0</td>
                                                        </tr>
                                                        <tr>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?></span><br></td>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></span><br></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <?php }?>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <?php 
      foreach ($flight->return->Segments as $key => $segment) {
    ?>
                                                <tr>
                                                  <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;"><div class="dterser">
                                                              <div class="colsdets"> <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25"> DEPARTURE: <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?> </div>
                                                              <div class="snotes"> Please verify flight times prior to departure </div>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="25%" rowspan="2" style="border-right: 1px solid #eee;"><div class="padwithbord">
                                                              <div class="leftflitmg"> <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->MarketingAirlineCode;?>.png" /> </div>
                                                              <div class="fligtdetss"> <?php echo $this->booking_model->get_airline_name($segment->MarketingAirlineCode);?> <br />
                                                                <?php echo $segment->MarketingAirlineCode;?> <?php echo $segment->FlightNumber;?> </div>
                                                              <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingAirline;?></strong></div>
                                                              <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureDateTime),$this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></strong></div>
                                                            </div></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->DepartureAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->DepartureAirportCode);?></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->ArrivalAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->ArrivalAirportCode);?></td>
                                                          <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br>
                                                            <?php echo $segment->Equipment;?> <br>
                                                            <br>
                                                            Booking Class: <?php echo $segment->CabinType;?><br>
                                                            Stop(s): 0</td>
                                                        </tr>
                                                        <tr>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?></span><br></td>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></span><br></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <?php }} else if($request->type == 'M') { 
    foreach($flight->Segments as $key => $segment) {
    ?>
                                                <tr>
                                                  <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;"><div class="dterser">
                                                              <div class="colsdets"> <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25"> DEPARTURE: <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?> </div>
                                                              <div class="snotes"> Please verify flight times prior to departure </div>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="25%" rowspan="2" style="border-right: 1px solid #eee;"><div class="padwithbord">
                                                              <div class="leftflitmg"> <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->MarketingAirlineCode;?>.png" /> </div>
                                                              <div class="fligtdetss"> <?php echo $this->booking_model->get_airline_name($segment->MarketingAirlineCode);?> <br />
                                                                <?php echo $segment->MarketingAirlineCode;?> <?php echo $segment->FlightNumber;?> </div>
                                                              <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingAirline != "") ? $segment->OperatingAirline : '-' ;?></strong></div>
                                                              <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureDateTime),$this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></strong></div>
                                                            </div></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->DepartureAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->DepartureAirportCode);?></td>
                                                          <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->ArrivalAirportCode;?></span><br>
                                                            <?php echo $this->booking_model->get_airport_name($segment->ArrivalAirportCode);?></td>
                                                          <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br>
                                                            <?php echo $segment->Equipment;?> <br>
                                                            <br>
                                                            Booking Class: <?php echo $segment->CabinType;?><br>
                                                            Stop(s): 0</td>
                                                        </tr>
                                                        <tr>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureDateTime));?></span><br></td>
                                                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br>
                                                            <span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalDateTime));?></span><br></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>
                                                <tr>
                                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="2" style="padding:10px;"><div class="detailhed">Traveller Details (Lead Passenger)</div></td>
                                                        </tr>
                                                        <tr style="background:#eeeeee">
                                                          <th align="left" valign="top" style="padding:10px;"><strong>S No </strong></th>
                                                          <th align="left" valign="top" style="padding:10px;"><strong>Given Name </strong></th>
                                                          </tr>
                                                        <tr style="background:#ffffff">
                                                          <td style="padding:10px;">1</td>
                                                          <td style="padding:10px;"><?php echo $Booking->leadpax; ?></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td style="height:20px;width:100%;"></td>
                                                </tr>
                                                <tr>
                                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                                      <tbody>
                                                        <tr>
                                                          <td colspan="2" style="padding:10px;"><div class="detailhed" >Customer Details</div></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="20%" align="left" style="background:#eeeeee;padding:10px;"><strong>Email ID</strong></td>
                                                          <td width="80%" align="left" style="background:#ffffff;padding:10px;"><?php echo $Booking->BILLING_EMAIL;?></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" style="background:#eeeeee;padding:10px;"><strong>Mobile Number</strong></td>
                                                          <td align="left" style="background:#ffffff;padding:10px;"><?php echo $Booking->BILLING_PHONE;?></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                              </tbody>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td style="height:20px;width:100%;"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                              <tbody>
                                                <tr>
                                                  <td><div class="detailhed">Terma & Conditions </div></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="top" style="padding:0 10px;"><div class="paratems">
                                                      <ol>
                                                        <li>Customer name, address, phone number, traveller's name and age are shared with applicable service providers like the airlines, hotels, etc., for the purpose of reservation and booking the services for the customer/traveller. </li>
                                                        <li>You should not take any action based on information on the Website until you have received a confirmation of your transaction. In case of confirmations to be received by email, if you do not receive a confirmation of your purchase/transaction within the stipulated time period, first look into your "spam" or "junk" folder to verify that it has not been misdirected, and if still not found, please contact our call centre. </li>
                                                        <li>Your e-ticket details will be sent to the email address provided by you at the time of booking. If you do not receive your e-ticket within 8 hours of making your booking with skywalkertravels.com,  please call our Customer Care Representative on +234 703 3519 6449. </li>
                                                        <li>You need to show your e-ticket confirmation email and e-ticket along with a photo identity proof (passport, driver's license etc.) at the airline check-in counter. Thereafter the airline representative will issue your boarding pass. </li>
                                                        <li>Passport details are mandatory for e - ticket issuance to Europe, USA and Canada.A few airlines flying to these countries also require passport details for issuing the e-ticket. </li>
                                                        <li>Please carry a valid visa for the country you will be visiting or transiting through. </li>
                                                      </ol>
                                                    </div></td>
                                                </tr>
                                              </tbody>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
