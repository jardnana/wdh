<div class="farehd arimobold">Flight Details</div>
<?php for($i=0;$i<count($results);$i++){ $result[0] = json_decode(base64_decode($results[$i]),1); for($fr=0;$fr< count($result);$fr++){ 
		$count1 = (count($result[$fr]) - 1); for($fs=0;$fs<=$count1;$fs++){ $count = count($result[$fr][$fs]['MarketingAirline']) - 1 ?>
		<div class="moreflt boksectn">
			<div class="segments">
				<div class="col-xs-5">
					<div class="flimage">
						<img src="http://c.fareportal.com/n/common/air/ai/<?php echo $result[$fr][$fs]['MarketingAirline'][0]; ?>.gif" alt="" />
					</div>
					<div class="flright">
						<span class="fl_name"><?php echo $result[$fr][$fs]['Airline_name'][0]; ?> - <?php echo $result[$fr][$fs]['FlighvgtNumber_no'][0]; ?></span>
						<span class="fl_name">Aircraft : <?php echo $result[$fr][$fs]['Equipment'][0]; ?> <a data-target="#flight_res<?php echo $fr."_".$fs; ?>"  data-toggle="modal">More</a> </span>
					</div>
				</div>
				<div class="col-xs-5 nopad">
					<div class="col-xs-6">
						<span class="fltiming"> <strong><?php echo date('H:i',(strtotime("+0 day", (strtotime($result[$fr][$fs]['DepartureDateTime_r'][0]))))); ?></strong> <?php echo date('D, M j',(strtotime("+0 day", (strtotime($result[$fr][$fs]['DepartureDateTime_r'][0]))))); ?> </span>
						<span class="fltiming"> <strong><?php echo date('H:i',(strtotime("+0 day", (strtotime($result[$fr][$fs]['ArrivalDateTime_r'][$count]))))); ?></strong> <?php echo date('D, M j',(strtotime("+0 day", (strtotime($result[$fr][$fs]['ArrivalDateTime_r'][$count]))))); ?> </span>
					</div>
					<div class="col-xs-6">
						<span class="fltiming"> <?php echo $result[$fr][$fs]['Origin'][0]; ?></span>
						<span class="fltiming">  <?php echo $result[$fr][$fs]['Destination'][$count]; ?> </span>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="rightfl">
						<span class="fltiming"> <strong><?php if($count == 0){ echo "Non"; }else{ echo $count; } ?> Stop</strong> </span>
						<div class="fl_time"><span class="fa fa-clock-o"></span> <?php echo $result[$fr][$fs]['final_duration']; ?></div>
					</div>
				</div>
			</div>
			<div role="dialog" id="flight_res<?php echo $fr."_".$fs; ?>" class="modal fade">
				<div class="propopum flight_datails">
					<div class="popuphed"><button data-dismiss="modal" class="close" type="button"><span class="fa fa-close"></span></button><div class="hdngpops">Flight Details</div></div>
					<div class="clearfix"></div>
					<div class="popconyent">
						<?php for($fsd=0;$fsd<=$count;$fsd++){ if($fsd == 0){ ?><div class="layortie"><?php echo $result[$fr][$fs]['Origin'][$fsd]; ?> to <?php echo $result[$fr][$fs]['Destination'][($count)]; ?>, Total Trip Duration( <?php echo $result[$fr][$fs]['final_duration']; ?> )</div> <?php } ?>
						<div class="innerpopup">
							<div class="col-xs-4">
								<div class="flightpop">Departure from  <?php echo $result[$fr][$fs]['Origin'][$fsd]; ?> </div>
								<ul class="newlines">
									<li>Terminal :   <?php echo $result[$fr][$fs]['TerminalID'][$fsd]; ?> </li>
									<li>Scheduled :   <?php echo date('H:i',(strtotime("+0 day", (strtotime($result[$fr][$fs]['DepartureDateTime_r'][$fsd]))))); ?> <?php echo date('D, M j',(strtotime("+0 day", (strtotime($result[$fr][$fs]['DepartureDateTime_r'][$fsd]))))); ?></li>
								</ul>
							</div>
							<div class="col-xs-2">
								<div class="layortie_duration">
									<span class="fa fa-clock-o"></span>
									<strong>Duration: </strong> <?php echo $result[$fr][$fs]['segment_duration'][$fsd]; ?>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="flightpop">Arrival at <?php echo $result[$fr][$fs]['Destination'][$fsd]; ?> </div>
								<ul class="newlines">
									<li>Terminal :   <?php echo $result[$fr][$fs]['TerminalID'][$fsd]; ?> </li>
									<li>Arrived :  <?php echo date('H:i',(strtotime("+0 day", (strtotime($result[$fr][$fs]['ArrivalDateTime_r'][$fsd]))))); ?> <?php echo date('D, M j',(strtotime("+0 day", (strtotime($result[$fr][$fs]['ArrivalDateTime_r'][$fsd]))))); ?></li>
								</ul>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>                      
			</div>
		</div>
		<div class="sepertr"></div>
<?php }}} ?>

								
