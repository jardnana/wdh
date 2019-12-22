<?php  for ($i=0; $i < count($results) ; $i++) { ?>
<div class="rm_in hotel-listing mbt15">
   <div class="row">
      <div class="col-md-3">
         <div class="busd">
            <h4><?php echo $results[$i]['displayname']; ?> </h4>
            <p>
               <?php echo $results[$i]['BusType']; ?> <!-- <span class="num">TG 2631</span> -->
            </p>
         </div>
      </div>
      <div class="col-md-9">
         <div class="col-md-4">
            <div class="booking_left">
               <h5><?php echo $results[$i]['DepartureTime']; ?></h5>
               <!-- <p class="booking-item-destination"><span class="acode">Counter no. 24,25,26 isbt-kashmiri gate </p> -->
            </div>
         </div>
         <div class="col-md-3 text-center stop-duration">
            <div class="flight-direction"> </div>
            <!-- <div class="bsn"> <span>0 stop</span> </div> -->
            <!-- <div class="stopbus"> </div> -->
            <div class="ddduration text-center"> <span> <?php echo $results[$i]['Duration']; ?></span> </div>
         </div>
         <div class="col-md-3">
            <div class="booking_right">
               <h5>01 : 55</h5>
               <!-- <p class="booking-item-destination">
                  <span class="acode">
                     Sherpur chowk 
               </p> -->
            </div>
         </div>
         <div class="col-md-2">
         <div class="dprcm">
         <h3 data-toggle="collapse" data-target="#detls">$<?php echo $results[$i]['Amount']; ?> <span class="srs"><?php echo $results[$i]['avialableseats']; ?> seats</span><a href="#" class="slctm">Select</a></h3>
         </div>
         </div>
      </div>
      <div class="col-md-12">
      <p class="booking-item-destination">
      <ul class="plcs"><li data-toggle="collapse" data-target="#Policess">Polices <i class="fa fa-angle-down"></i></li><li data-toggle="collapse" data-target="#Pickups<?php echo $i; ?>"> Pickups & Drops <i class="fa fa-angle-down"></i></li></ul></p>
      </div>
   </div>
   <div class="collapse" id="detls">
   <div class="col-md-12 pad0">
   <a href="#" class="pull-right" data-toggle="collapse" data-target="#detls"><i class="fa fa-times-circle-o"></i></a>
   </div>
   <div class="row">
   <div class="col-md-7">
   <div class="setsm">
   <div class="lsr">LOWER</div>
   <ul>
   <li class="active"></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   </ul>
   <ul class="mrst">
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>      
   </ul>
   </div>
   <div class="setsm">
   <div class="lsr">UPPER</div>
   <ul>
   <li class="active"></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   </ul>
   <ul class="mrst">
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>   
   <li></li>      
   </ul>
   </div>
   <img src="images/seat.png">
   </div>   
   <div class="col-md-5 pl0">
   <div class="drppist">

   <h4>Boarding Point</h4>
   <h5>(07:01 PM) Hyderabad</h5>
   <h6>ANAND VIHAR</h6>
   <p>New Delhi, Delhi 110092</p>
   </div>
   <div class="drppist">
   <h4>Dropping Point</h4>
   <h5>(012:01 AM) Near Bus Stand</h5>
   <h6>ANAND VIHAR</h6>
   <p>Isbt Anand Vihar</p>
   </div>   
   <div class="drppist">
   <ul class="sst">
   <li>Seat(s) No. <span class="pull-right">12</span></li>
   <li>Base Fare. <span class="pull-right">$650.00</span></li>
   <li>Discount. <span class="pull-right">-$50.00</span></li>
   <li class="bdr1"><b>Total</b> <span class="pull-right"><b>$610.00</b></span></li>
   <li><a href="#" class="slctm2">Continue Booking</a></li>
   </ul>
   </div>
   </div>   
   </div>
   </div>
   <div class="collapse" id="Policess">
   <div class="col-md-12 pad0">
   <a href="#" class="pull-right" data-toggle="collapse" data-target="#Policess"><i class="fa fa-times-circle-o"></i></a>
   </div>
   <div class="col-md-6">
   <ul class="sst2 fx">
   <h6>TIME OF CANCELLATION <span>CHARGES</span></h6>
   <li>more than 24 hrs before travel . <span class="pull-right">10%</span></li>
   <li class="bdr1">12 to 24 hr(s) before travel  <span class="pull-right">40%</span></li>
   <li class="bdr1">0 to 12 hr(s) before travel  <span class="pull-right">100%</span></li>
   </ul>
   </div>
   <div class="col-md-6">
   <ul class="sst fx">
   <h6>OTHER CONDITIONS</h6>
   <li>The penalty is calculated based on total seat worth 699</li>
   <li>Penalty is calculated basis the scheduled bus departure time from the first boarding point.</li>
   <li>Partial cancellation is not allowed for this ticket.</li>
   <li>Please note : the ticket cannot be cancelled after the bus departs from the first boarding point.</li>
   <li> Above defined cancellation charges are illustrated basis maximum fare applicable. Exact cancellation charges will depend on the final price charged along with discount and other adjustments.</li>
   <li>Cancellation amount shown above may also vary basis the non-refundable components of the ticket defined by the bus operator</li>
   </ul>
   </div>
   </div>
   <div class="collapse" id="Pickups<?php echo $i; ?>">
   <div class="col-md-12 pad0">
   <a href="#" class="pull-right" data-toggle="collapse" data-target="#Pickups<?php echo $i; ?>"><i class="fa fa-times-circle-o"></i></a>
   </div>
   <div class="col-md-6">
   <ul class="sst2 fx">
   <h6>Pickup Points</span></h6>
   <?php //echo '<pre>fs'; print_r($results[$i]['DroppingTimes']); exit; ?>
   <?php $bordingtimes = unserialize($results[$i]['BoardingTimes']);
   for ($bp=0; $bp < count($bordingtimes) ; $bp++) { ?>
      <li><?php echo $bordingtimes[$bp]['Time']; ?>  <?php echo $bordingtimes[$bp]['Location'].',' ?><?php echo $bordingtimes[$bp]['Landmark']; ?> </li>
   <?php } ?>
   </ul>
   </div>
   <div class="col-md-6">
   <ul class="sst fx">
   <h6>Drop Points</h6>
   <?php $droppingtimes = unserialize($results[$i]['DroppingTimes']);
   for ($dt=0; $dt < count($droppingtimes) ; $dt++) { ?>
      <li><?php echo $droppingtimes[$dt]['Time']; ?>  <?php echo $droppingtimes[$dt]['Location'].',' ?><?php echo $droppingtimes[$dt]['Landmark']; ?></li>
   <?php } ?>
   </ul>
   </div>
   </div>
</div>
<?php } ?>