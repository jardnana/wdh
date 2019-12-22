<?php 
    if($moduleType == 'FLIGHT') {
        $id = "refineFlightTable";
        $table_type = "flight";
    } else if($moduleType == 'HOTEL') {
        $id = "refineHotelTable";
        $table_type = "hotel";
    }
	else if($moduleType == 'SIGHTSEEN') {
        $id = "refinesightTable";
        $table_type = "sightseen";
    }
	else if($moduleType == 'TRANSFER') {
        $id = "refineTransferTable";
        $table_type = "transfer";
    }
	else {
        $id = "refineFlightTable";
        $table_type = "flight";
    }
?>
<?php if($moduleType == 'FLIGHT') { ?>
<table id="booking_list" class='data-table-column-filter1 table table-bordered table-striped'>
  <thead>
      <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>PNR NO</th>
          <th>Booking ID</th>
          <th>Flight Number</th>
          <th>Amount</th>
          <th>Selling Price</th>
          <th>Net Price</th>
          <th>Profit</th>
          <th>Payment ID</th>
          <th>Payment Status</th>
          <th>Booking Date</th>
          <th>Departure Date</th>
          <th>Arrival Date</th>
          <th>Cancellation Date</th>
          <th>API Status</th>
          <th>Booking Status</th>
          <th>Status Date</th>
          <th>IP Address</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>
      <?php if (!empty($Bookings)) {
          $c = 1;
          foreach ($Bookings as $ab) {  if($ab->module == 'FLIGHT'){
      ?>
          <?php 
              $fltBookingData = $this->booking_model->getMarkupData('flight', $ab->ref_id)->row();
              if(isset($fltBookingData->TotalPrice) && $fltBookingData->TotalPrice >= 0) {
                  $sp = $fltBookingData->TotalPrice;   //total / selling price
              } else {
                  $sp = 0;
              }

              if(isset($fltBookingData->AdminMarkup) && $fltBookingData->AdminMarkup >= 0) {
                  $adminMarkup = $fltBookingData->AdminMarkup;      //admin markup
              } else {
                  $adminMarkup = 0; 
              }

              $np = $sp - $adminMarkup;  //net price
              $np = ($np >= 0) ? $np : 0;

              if(isset($fltBookingData->DepartureTime)) {
                  $departureDate_str = $fltBookingData->DepartureTime;
                  $departureDate = date('d-m-Y', $departureDate_str);
              } else {
                  $departureDate = '-';
              }

              if(isset($fltBookingData->ArrivalTime)) {
                  $arrivalDate_str = $fltBookingData->ArrivalTime;
                  $arrivalDate = date('d-m-Y', $arrivalDate_str);
              } else {
                  $arrivalDate = '-';
              }

              if(isset($ab->api_status)) {
                  $api_status = $ab->api_status;
              } else {
                  $api_status = '-';
              }

              if(isset($fltBookingData->response)) {
                  $response_str = $fltBookingData->response;
                  $response_json = base64_decode($response_str);
                  $response_obj = json_decode($response_json);
                  if(isset($response_obj->Segments)) {
                      $firstSeg = reset($response_obj->Segments);
                      $flightNumber = $firstSeg->FlightNumber;
                  } else {
                      $flightNumber = "-";
                  }
              }
          ?>

              <tr>
                  <td><?php echo $c; ?></td>
                  <td> 
                      <a class="" data-content="<?php echo 'Total Profit: '.$adminMarkup  ?>"> 
                          <?php echo $ab->leadpax; ?>
                      </a>
                  </td>                                            
                  <td><?php echo $ab->pnr_no; ?></td>
                  <td><?php echo $ab->booking_no; ?></td>
                  <td><?php echo $flightNumber; ?></td>
                  <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                  <td><?php echo CURR_ICON.''.$sp; ?></td>
                  <td><?php echo CURR_ICON.''.$np; ?></td>
                  <td><?php echo CURR_ICON.''.$adminMarkup; ?></td>
                  <td>-</td>
                  <td>-</td>
                  <td><?php echo $ab->voucher_date; ?></td>
                  <td><?php echo $departureDate; ?></td>
                  <td><?php echo $arrivalDate; ?></td>
                  <td><?php echo '-'; ?></td>
                  <td><?php echo $api_status; ?></td>
                  <td><?php echo $ab->booking_status; ?></td>
                  <td><?php echo $ab->voucher_date; ?></td>
                  <td><?php echo $ab->ip; ?></td>
                  <td>
                  <a href="<?php echo WEB_URL.'email/mail_voucher/'.$ab->pnr_no; ?>" title="Mail voucher" onclick="flight_mail_voucher(this); return false;" data-pnr="<?php echo $ab->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher" style="display: none;"> 
                      <i class="icon-envelope"></i>
                      <span class="loadr" style="display: none;">
                          <img src="<?php echo ASSETS;?>images/loader.gif"/>
                      </span> 
                  </a>
                  <a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                      <i class='icon-ticket'></i>
                  </a>
                  <?php if(false){ if($ab->booking_status == 'CONFIRMED') { ?>
                  <a onclick="return confirm('Are you sure?')" href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                      <i class='icon-off'></i>
                  </a>
                  <?php } }?>
              </td>
          </tr>
          <?php $c++; } } } ?>
      </tbody>
      <tfoot>
          <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>PNR NO</th>
          <th>Booking ID</th>
          <th>Flight Number</th>
          <th>Amount</th>
          <th>Selling Price</th>
          <th>Net Price</th>
          <th>Profit</th>
          <th>Payment ID</th>
          <th>Payment Status</th>
          <th>Booking Date</th>
          <th>Departure Date</th>
          <th>Arrival Date</th>
          <th>Cancellation Date</th>
          <th>API Status</th>
          <th>Booking Status</th>
          <th>Status Date</th>
          <th>IP Address</th>
          <th>Actions</th>
       </tr>
   </tfoot>
</table>
   <?php } ?>

   <?php if($moduleType == 'HOTEL') { ?>
<div class="row"  style="overflow-x: scroll;">
   <table id="booking_list" class='data-table-column-filter1 table table-bordered table-striped'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Confirmation No.</th>
                <th>Booking Id</th>
                <th>Amount</th>
                <th>Selling Price</th>
                <th>Net Price</th>
                <th>Profit</th>
                <th>Booking Date</th>
                <th>Checkin Date</th>
                <th>CheckOut Date</th>
                <th>Cancellation Date</th>
                <th>API Status</th>
                <th>Booking Status</th>
                <th>Status Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($Bookings)) {
                $c = 1;
                foreach ($Bookings as $ab) {  if($ab->module == 'HOTEL'){?>
                <?php 
                    $fltBookingData = $this->Booking_Model->getMarkupData('hotel', $ab->ref_id)->row();
                    
                    if(isset($fltBookingData->total_cost) && $fltBookingData->total_cost >= 0) {
                        $sp = $fltBookingData->total_cost;   //total / selling price
                    } else {
                        $sp = 0;
                    }

                    if(isset($fltBookingData->AdminMarkup) && $fltBookingData->AdminMarkup >= 0) {
                        $adminMarkup = $fltBookingData->AdminMarkup;      //admin markup
                    } else {
                        $adminMarkup = 0; 
                    }

                    $np = $sp - $adminMarkup;  //net price
                    $np = ($np >= 0) ? $np : 0;

                    if(isset($fltBookingData->request)) {
                        $request_str = $fltBookingData->request;
                        $request_json = base64_decode($request_str);
                        $request_obj = json_decode($request_json);
                        if(isset($request_obj->check_in)) {
                            $checkin = $request_obj->check_in;
                        } else {
                            $checkin = "-";
                        }
                        if(isset($request_obj->check_out)) {
                            $checkout = $request_obj->check_out;
                        } else {
                            $checkout = "-";
                        }
                    } else {
                        $checkin = $checkout = "-";
                    }

                    if(isset($ab->api_status)) {
                        $api_status = $ab->api_status;
                    } else {
                        $api_status = '-';
                    }
                ?>
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>
                        <a class="" data-content="<?php echo 'Total Profit: '.$adminMarkup  ?>">  
                            <?php echo $ab->leadpax; ?>
                        </a>
                    </td> 
                    <td><?php echo $ab->pnr_no; ?></td>
                    <td><?php echo $ab->booking_no; ?></td>
                    <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                    <td><?php echo CURR_ICON.''.$sp; ?></td>
                    <td><?php echo CURR_ICON.''.$np; ?></td>
                    <td><?php echo CURR_ICON.''.$adminMarkup; ?></td>
                    <td><?php echo $ab->voucher_date; ?></td>
                    <td><?php echo $checkin; ?></td>
                    <td><?php echo $checkout; ?></td>
                    <td><?php echo '-'; ?></td>
                    <td><?php echo $api_status; ?></td>
                    <td><?php echo $ab->booking_status; ?></td>
                    <td><?php echo $ab->voucher_date; ?></td>
                    <td>
                    <a href="<?php echo base_url().'email/hotel_mail_voucher/'.$ab->pnr_no; ?>" title="Mail voucher" onclick="hotel_mail_voucher(this); return false;" data-pnr="<?php echo $ab->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher" style="display: none;"> 
                        <i class="icon-envelope"></i> 
                        <span class="loadr" style="display: none">
                            <img src="<?php echo ASSETS;?>images/loader.gif"/>
                        </span> 
                    </a>
                    <a href="<?php echo base_url();?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                        <i class='icon-ticket'></i>
                    </a>
                    <?php if(false){ if($ab->booking_status == 'CONFIRMED') { ?>
                    <a onclick="return confirm('Are you sure?')" href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                        <i class='icon-off'></i>
                    </a>
                    <?php } }?>
                </td>
            </tr>
            <?php $c++; } } } ?>
        </tbody>
        <tfoot>
            <tr>
             <th>S.No</th>
                <th>Name</th>
                <th>Confirmation No.</th>
                <th>Booking Id</th>
                <th>Amount</th>
                <th>Selling Price</th>
                <th>Net Price</th>
                <th>Profit</th>
                <th>Booking Date</th>
                <th>Checkin Date</th>
                <th>CheckOut Date</th>
                <th>Cancellation Date</th>
                <th>API Status</th>
                <th>Booking Status</th>
                <th>Status Date</th>
                <th>Actions</th>
         </tr>
     </tfoot>
    </table>
</div> 
 <?php } ?>
 <?php if($moduleType == 'SIGHTSEEN') { ?>
<div class="row"  style="overflow-x: scroll;">
   <table class='data-table-column-filter1 table table-bordered table-striped' id="booking_list2">
        <thead>
            <tr>
                <th>S.No</th>
				<th>Name</th>
				<th>PNR NO</th>
				<th>Booking ID</th>											
				<th>Amount</th>
				<th>Selling Price</th>
				<th>Net Price</th>
				<th>Profit</th>
				<th>Booking Date</th>
				<th>Departure Date</th>
				<th>Arrival Date</th>
				<th>Cancellation Date</th>
				<th>API Status</th>
				<th>Booking Status</th>
				<th>Status Date</th>
				<th>IP Address</th>
				<th>Actions</th>
            </tr>
			<tr class="replace-inputs">
				<th>S.No</th>
				<th>Name</th>
				<th>PNR NO</th>
				<th>Booking ID</th>											
				<th>Amount</th>
				<th>Selling Price</th>
				<th>Net Price</th>
				<th>Profit</th>
				<th>Booking Date</th>
				<th>Departure Date</th>
				<th>Arrival Date</th>
				<th>Cancellation Date</th>
				<th>API Status</th>
				<th>Booking Status</th>
				<th>Status Date</th>
				<th>IP Address</th>
				<th>Actions</th>
			</tr>
        </thead>
        <tbody>
            <?php if (!empty($Bookings)) {
				$c = 1;
				foreach ($Bookings as $ab) {  if($ab->module == 'SIGHTSEEN'){
					//echo '<pre>';print_r($ab);echo '</pre>';exit;
			?>
				<?php 
					$fltBookingData = $this->Booking_Model->getMarkupData('sightseen', $ab->ref_id)->row();

					if(isset($fltBookingData->TotalPrice) && $fltBookingData->TotalPrice >= 0) {
						$sp = $fltBookingData->TotalPrice;   //total / selling price
					} else {
						$sp = 0;
					}

					if(isset($fltBookingData->AdminMarkup) && $fltBookingData->AdminMarkup >= 0) {
						$adminMarkup = $fltBookingData->AdminMarkup;      //admin markup
					} else {
						$adminMarkup = 0; 
					}

					$np = $sp - $adminMarkup;  //net price
					$np = ($np >= 0) ? $np : 0;

					if(isset($fltBookingData->DepartureTime)) {
						$departureDate_str = $fltBookingData->DepartureTime;
						$departureDate = date('d-m-Y', strtotime($departureDate_str));
					} else {
						$departureDate = '-';
					}

					if(isset($fltBookingData->ArrivalTime)) {
						$arrivalDate_str = $fltBookingData->ArrivalTime;
						$arrivalDate = date('d-m-Y', strtotime($arrivalDate_str));
					} else {
						$arrivalDate = '-';
					}

					if(isset($ab->api_status)) {
						$api_status = $ab->api_status;
					} else {
						$api_status = '-';
					}

					if(isset($fltBookingData->response)) {
						$response_str = $fltBookingData->response;
						$response_json = base64_decode($response_str);
						$response_obj = json_decode($response_json);
						if(isset($response_obj->Segments)) {
							$firstSeg = reset($response_obj->Segments);
							$flightNumber = $firstSeg->FlightNumber;
						} else {
							$flightNumber = "-";
						}
					}
				?>
					<tr>
						<td><?php echo $c; ?></td>
						<td> 
							<a class="" data-content="<?php echo 'Total Profit: '.$adminMarkup  ?>"> 
								<?php echo $ab->leadpax; ?>
							</a>
						</td>                                            
						<td><?php echo $ab->pnr_no; ?></td>
						<td><?php echo $ab->booking_no; ?></td>
						<td><?php echo CURR_ICON.''.$ab->amount; ?></td>
						<td><?php echo CURR_ICON.''.$sp; ?></td>
						<td><?php echo CURR_ICON.''.$np; ?></td>
						<td><?php echo CURR_ICON.''.$adminMarkup; ?></td>
						<td><?php echo $ab->voucher_date; ?></td>
						<td><?php echo $departureDate; ?></td>
						<td><?php echo $arrivalDate; ?></td>
						<td><?php echo '-'; ?></td>
						<td><?php echo $api_status; ?></td>
						<td><?php echo $ab->booking_status; ?></td>
						<td><?php echo $ab->voucher_date; ?></td>
						<td><?php echo $ab->ip; ?></td>
						<td>
						<a href="<?php echo base_url().'email/mail_voucher/'.$ab->pnr_no; ?>" title="Mail voucher" onclick="flight_mail_voucher(this); return false;" data-pnr="<?php echo $ab->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher" style="display: none"> 
							<i class="icon-envelope"></i>
							<span class="loadr" style="display: none;">
								<img src="<?php echo ASSETS;?>images/loader.gif"/>
							</span> 
						</a>
						<a href="<?php echo base_url();?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
							<i class='icon-ticket'></i>
						</a>
						<?php if(false){ if($ab->booking_status == 'CONFIRMED') { ?>
						<a onclick="return confirm('Are you sure?')" href="<?php echo base_url();?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
							<i class='icon-off'></i>
						</a>
						<?php } } ?>
					</td>
				</tr>
				<?php $c++; } } } ?>
        </tbody>
    </table>
</div> 
 <?php } ?>
  <?php if($moduleType == 'TRANSFER') { ?>
<div class="row"  style="overflow-x: scroll;">
   <table id="booking_list3" class='data-table-column-filter1 table table-bordered table-striped'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Confirmation No.</th>
                <th>Booking Id</th>
                <th>Amount</th>
                <th>Selling Price</th>
                <th>Net Price</th>
                <th>Profit</th>
                <th>Booking Date</th>
                <th>Checkin Date</th>
                <th>CheckOut Date</th>
                <th>Cancellation Date</th>
                <th>API Status</th>
                <th>Booking Status</th>
                <th>Status Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($Bookings)) {
				$c = 1;
				foreach ($Bookings as $ab) {  if($ab->module == 'TRANSFER'){
				?>
				<?php 
					$tnsfrBookingData = $this->Booking_Model->getMarkupData('transfer', $ab->ref_id)->row();
					
					if(isset($tnsfrBookingData->total_price) && $tnsfrBookingData->total_price >= 0) {
						$sp = $tnsfrBookingData->total_price;   //total / selling price
					} else {
						$sp = 0;
					}

					if(isset($tnsfrBookingData->AdminMarkup) && $tnsfrBookingData->AdminMarkup >= 0) {
						$adminMarkup = $tnsfrBookingData->AdminMarkup;      //admin markup
					} else {
						$adminMarkup = 0; 
					}

					$np = $sp - $adminMarkup;  //net price
					$np = ($np >= 0) ? $np : 0;

					if(isset($tnsfrBookingData->transfer_booking_req)) {
						$request_str = $tnsfrBookingData->transfer_booking_req;
						$request_json = base64_decode($request_str);
						$request_obj = json_decode($request_json);
						if(isset($request_obj->depart_date)) {
							$checkin = $request_obj->depart_date;
						} else {
							$checkin = "-";
						}
						if(isset($request_obj->return_date)) {
							$checkout = $request_obj->return_date;
						} else {
							$checkout = "-";
						}
					} else {
						$checkin = $checkout = "-";
					}

					if(isset($ab->api_status)) {
						$api_status = $ab->api_status;
					} else {
						$api_status = '-';
					}
				?>
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>
                        <a class="" data-content="<?php echo 'Total Profit: '.$adminMarkup  ?>">  
                            <?php echo $ab->leadpax; ?>
                        </a>
                    </td> 
                    <td><?php echo $ab->pnr_no; ?></td>
                    <td><?php echo $ab->booking_no; ?></td>
                    <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                    <td><?php echo CURR_ICON.''.$sp; ?></td>
                    <td><?php echo CURR_ICON.''.$np; ?></td>
                    <td><?php echo CURR_ICON.''.$adminMarkup; ?></td>
                    <td><?php echo $ab->voucher_date; ?></td>
                    <td><?php echo $checkin; ?></td>
                    <td><?php echo $checkout; ?></td>
                    <td><?php echo '-'; ?></td>
                    <td><?php echo $api_status; ?></td>
                    <td><?php echo $ab->booking_status; ?></td>
                    <td><?php echo $ab->voucher_date; ?></td>
                    <td>
                    <a href="<?php echo base_url().'email/hotel_mail_voucher/'.$ab->pnr_no; ?>" title="Mail voucher" onclick="hotel_mail_voucher(this); return false;" data-pnr="<?php echo $ab->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher" style="display: none;"> 
                        <i class="icon-envelope"></i> 
                        <span class="loadr" style="display: none">
                            <img src="<?php echo ASSETS;?>images/loader.gif"/>
                        </span> 
                    </a>
                    <a href="<?php echo base_url();?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                        <i class='icon-ticket'></i>
                    </a>
                    <?php if(false){ if($ab->booking_status == 'CONFIRMED') { ?>
                    <a onclick="return confirm('Are you sure?')" href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel PNR'>
                        <i class='icon-off'></i>
                    </a>
                    <?php } }?>
                </td>
            </tr>
            <?php $c++; } } } ?>
        </tbody>
        <tfoot>
            <tr>
             <th>S.No</th>
                <th>Name</th>
                <th>Confirmation No.</th>
                <th>Booking Id</th>
                <th>Amount</th>
                <th>Selling Price</th>
                <th>Net Price</th>
                <th>Profit</th>
                <th>Booking Date</th>
                <th>Checkin Date</th>
                <th>CheckOut Date</th>
                <th>Cancellation Date</th>
                <th>API Status</th>
                <th>Booking Status</th>
                <th>Status Date</th>
                <th>Actions</th>
         </tr>
     </tfoot>
    </table>
</div> 
 <?php } ?>

   
