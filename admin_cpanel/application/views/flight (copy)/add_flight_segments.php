<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Add Flight Segments Management</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/github.min.css">   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-clockpicker.min.js"></script>            
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flight/flight_list"; ?>">FLIGHT</a></li>
				<li class="active"><strong>Add Flight Segments</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add Flight Segments Management
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."flight/add_flight_segment_data/".base64_encode(json_encode($flight_id))."/".base64_encode(json_encode($flight_crs_id))."/".base64_encode(json_encode($trip_type)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flight Name</label>	
									<div class="col-sm-5">								
									<select name="airline" class="select2"  required>
											<option value=""/>
											<?php if($airline_list!=''){ for($ad=0;$ad<count($airline_list);$ad++){ ?>
											<option value="<?php echo $airline_list[$ad]->airline_code; ?>" <?php if($airline_list[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline_list[$ad]->airline_name; ?></option>
											<?php }} ?>
									</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Segment type</label>	
									<div class="col-sm-5">								
									<select name="segment_type" class="select2"  required>
											<option value=""/>
											<?php if ($trip_type =="ONEWAY"){  ?>
											<option value="Onward" data-iconurl="" selected>Onward Segment</option>
											<?php } elseif ($trip_type =="ROUNDTRIP") { ?>
											<option value="Onward" data-iconurl="" selected>Onward Segment</option>
											<option value="Return" data-iconurl="">Return Segment</option>
											<?php } else {
											  $mfc = json_decode($flight_info[0]->multi_from_city);
											  for($i=0;$i<(count($mfc) + 1);$i++) { ?>
											  <option value="<?php echo 'segment'.$i ;?>" data-iconurl=""><?php echo 'Segment'.$i; ?></option>
											<?php } } ?>
									</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flight Equipment</label>									
									<div class="col-sm-5">
										
										<input name="flight_equipment" style='text-transform:uppercase' id ="" maxlength="5"  size="3" type="text" class="form-control"  placeholder="Flight Equipment" required>

									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flight Number</label>									
									<div class="col-sm-5">
										<input name="flight_number" id ="" data-rule-number='true' type="text" maxlength="10" class="form-control"  placeholder="Enter Valid Flight Number" required>
									</div>
								</div>
							   <div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Marketing Airline</label>									
									<div class="col-sm-5">								
									<select name="marketing_airline" class="select2"  required>
											<option value=""/>
											<?php if($airline_list!=''){ for($ad=0;$ad<count($airline_list);$ad++){ ?>
											<option value="<?php echo $airline_list[$ad]->airline_code; ?>" <?php if($airline_list[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline_list[$ad]->airline_name; ?></option>
											<?php }} ?>
									</select>
									</div>
								</div>
							<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Operating Airline</label>									
									<div class="col-sm-5">								
									<select name="operating_airline" class="select2"  required>
											<option value=""/>
											<?php if($airline_list!=''){ for($ad=0;$ad<count($airline_list);$ad++){ ?>
											<option value="<?php echo $airline_list[$ad]->airline_code; ?>" <?php if($airline_list[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline_list[$ad]->airline_name; ?></option>
											<?php }} ?>
									</select>
									</div>
								</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Origin</label>									
									<div class="col-sm-5">
										<input name="onward_from_city" id =""  type="text" class="form-control autosuggest_onward"  placeholder="From City" autocomplete="off" required>
									</div>
								
							</div>
						     <div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Destination</label>									
									<div class="col-sm-5">
										<input name="onward_to_city" id =""  type="text" class="form-control autosuggest1_onward"  placeholder="To City" autocomplete="off" required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Departure Timezone</label>									
									<div class="col-sm-5">
										<input name="departure_timezone" id =""  type="text" class="form-control"  placeholder="Departure Timezone"  required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Arrival Timezone</label>									
									<div class="col-sm-5">
										<input name="arrival_timezone" id =""  type="text" class="form-control"  placeholder="Arrival Timezone"  required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Departure Date</label>									
									<div class="col-sm-3">
										<input  class="form-control return_timepicker1"  name="onward_departure_time" id="onward_departure_time" type="text" required>
									</div>
									<label for="field-1" class="col-sm-2 control-label">Departure time</label>  
					                <div class="col-sm-3">                     
					                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					                    <input type="text" class="form-control" name="start_time" value="" style="height: 30px;" >
					                    <span class="input-group-addon">
					                            <span class="glyphicon glyphicon-time"></span>
					                    </span>
					                </div>
					                </div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Arrival Date</label>									
									<div class="col-sm-3">
										<input  class="form-control timepicker1"  name="onward_arrival_time" id="onward_arrival_time" type="text" required>
									</div>
									<label for="field-1" class="col-sm-2 control-label">Arrival time</label>  
					                <div class="col-sm-3">                     
					                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					                    <input type="text" class="form-control" name="arrival_time" value="" style="height: 30px;" >
					                    <span class="input-group-addon">
					                            <span class="glyphicon glyphicon-time"></span>
					                    </span>
					                </div>
					                </div>
								
							</div>
								
								<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Seats Remaining</label>									
									<div class="col-sm-5">
									    <input name="seats_remaining" id ="" maxlength="1" min="0" max="9"  type="text" class="form-control"  placeholder="Seat Reamaining"  required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Booking Design Code</label>									
									<div class="col-sm-5">
									    <input name="design_code"  id ="" style='text-transform:uppercase' maxlength="1"  size="1"  type="text" class="form-control"  placeholder="Booking Design Code"  required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Meal</label>									
									<div class="col-sm-5">
									    <input name="meal"  id ="" maxlength="1" style='text-transform:uppercase' size="1"  type="text" class="form-control"  placeholder="Meal Code"  required>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Weight Allowance</label>									
									<div class="col-sm-5">
									    <textarea name="weight_allowance" id =""  type="text" class="form-control"  placeholder="weight allowance"  required></textarea>
									</div>
								
							</div>
							<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Max Stop</label>									
									<div class="col-sm-5">
									   <input name="max_stop" id =""  type="text" class="form-control"  placeholder="Max Stop"  required>
									</div>
								
							</div>
							<!--<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Connection Location</label>									
									<div class="col-sm-5">
									    <input name="connection_location" id =""  type="text" class="form-control"  placeholder="Include City"  required>
									</div>
								
							</div>-->
							<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">ETicket</label>									
									<div class="col-sm-5">
										 <select name="eticket" id="eticket" class="select2">
                                           <option value="True">True</option>
                                           <option value="False">False</option>
										   </select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Non Refundable</label>									
									<div class="col-sm-5">
										 <select name="non_refundable" id="non_refundable" class="select2">
                                          <option value="True">True</option>
                                           <option value="False">False</option>
										   </select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Marriage Group</label>									
									<div class="col-sm-5">
										 <select name="marriage_group" id="marriage_group" class="select2">
                                          <option value="True">True</option>
                                           <option value="False">False</option>
										   </select>
									</div>
								</div>
								<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Cabin Class</label>									
									<div class="col-sm-5">
									  <select class="select2" name="flight_class">
						                <option value="All" selected="selected">All</option>
						                <option value="F">First, Supersonic</option>
						                <option value="C">Business</option>
						                <option value="Y">Economic</option>
						                <option value="W">Premium Economy</option>
						                <option value="M">Standard Economy</option>
						                </select>
									</div>
								
							</div>
								<!--<?php  if ($trip_type=="ROUNDTRIP") { ?>
								<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Return Departure Time</label>									
									<div class="col-sm-5">
										<input  data-format="HH:mm" class="form-control return_timepicker1" data-template="HH : mm" name="return_depart_time" id="return_depart_time" type="text" required>
									</div>
								
							</div>								
								<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Return Arrival Time</label>									
									<div class="col-sm-5">
										<input   data-format="HH:mm" class="form-control timepicker1" data-template="HH : mm" name="return_arrival_time" id="return_arrival_time" type="text" required>
									</div>
								
							</div>
							<?php } ?>-->
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Flight Segment</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Chat Module -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<!--<script src="<?php echo base_url(); ?>assets/datetime/jquery.datetimepicker.css"></script>
	<script src="<?php echo base_url(); ?>assets/datetime/jquery.datetimepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/datetime/jquery.datetimepicker.min.js"></script>--> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
	<script>
			

	</script>

	<script>
	$(document).ready(function () {
			var mySelect = false;
      $(".autosuggest_onward").autocomplete({
          source: "<?php echo base_url(); ?>flight/get_airports",
          minLength: 2, //search after two characters
          autoFocus: true, // first item will automatically be focused
          select: function (event, ui) {
          	 mySelect = true;
            //$("#country_id").focus();
          },
          change: function(event, ui) {
          	 if (ui.item == null) {
        	 $(this).val("");
            // $("span").text("new item: " + this.value);
           }
         }
        });
     });
	</script>
	<script>
	$(document).ready(function () {
			var mySelect = false;
      $(".autosuggest1_onward").autocomplete({
          source: "<?php echo base_url(); ?>flight/get_airports",
          minLength: 2, //search after two characters
          autoFocus: true, // first item will automatically be focused
          select: function (event, ui) {
          	 mySelect = true;
            //$("#country_id").focus();
          },
          change: function(event, ui) {
          	 if (ui.item == null) {
        	 $(this).val("");
            // $("span").text("new item: " + this.value);
           }
         }
        });
     });
	</script>
	<script>
		$(document).ready(function(){
    $("#onward_departure_time").datepicker({
       dateFormat: 'M dd yy',
        minDate: 0,
        //numberOfMonths: 1,
        // onSelect: function(selected) {
        //   $("#onward_arrival_time").datetimepicker("option","minDate", selected)
        // }
    });
    $("#onward_arrival_time").datepicker({ 
        //numberOfMonths: 1,
        dateFormat: 'M dd yy',
        // onSelect: function(selected) {
        //    $("#return_depart_time").datepicker("option","maxDate", selected)
        // }
    }); 
  
 $("#return_depart_time" ).datepicker({
    minDate: 0,
    dateFormat: 'M dd yy',
    maxDate: "+1y",
    // onClose: function( selectedDate ) {
    //   $( "#return_arrival_time" ).datepicker( "option", "minDate", selectedDate );
  
    // }
  });
  
  jQuery( "#return_arrival_time" ).datepicker({
    minDate: +1,
    dateFormat: 'M dd yy',
    maxDate: "+1y",
    // onClose: function( selectedDate ) {
    //   $( "#return_arrival_time1" ).datepicker( "option", "minDate", selectedDate );
   
    // }
  });
});



// Child Combination With Adult and Infant

	</script>

	<script type="text/javascript">
$('.clockpicker').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});

</script>
</body>
</html>
