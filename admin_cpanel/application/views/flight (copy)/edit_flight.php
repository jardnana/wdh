<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | FLIGHT</title>	
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
				<li class="active"><strong>Edit FLIGHT</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit FLIGHT
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."flight/update_flight/".base64_encode(json_encode($flight_info[0]->flight_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flight Trip</label>									
									<div class="col-sm-5">
										<select name="trip_type" class="select2" required readonly>											
											<option value="<?php echo $flight_info[0]->journey_type; ?>" data-iconurl=""><?php echo $flight_info[0]->journey_type; ?></option>		
										</select>

									</div>
								</div> 
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">From</label>									
									<div class="col-sm-5">
										
										<input name="from_city" id ="from_city" value="<?php echo $flight_info[0]->departure_city; ?>" type="text" class="form-control autosuggest"  placeholder="From City" autocomplete="off" required>

									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">To</label>									
									<div class="col-sm-5">
										
										<input name="to_city" id ="to_city" value="<?php echo $flight_info[0]->arrival_city; ?>" type="text" class="form-control autosuggest1"  placeholder="To City" autocomplete="off"  required>

									</div>
								</div>
								<div class="form-group">
								
									<label for="field-1" class="col-sm-3 control-label">Departure date</label>									
									<div class="col-sm-3">
										<input type="text" class="form-control" value="<?php echo $flight_info[0]->departure_date; ?>" id="departure_date"  name="departure_date">
									</div>
									<label for="field-1" class="col-sm-2 control-label">Departure time</label>  
					                <div class="col-sm-3">                     
					                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					                    <input type="text" class="form-control" name="start_time" value="<?php echo $flight_info[0]->o_departure_time; ?>" style="height: 30px;" >
					                    <span class="input-group-addon">
					                            <span class="glyphicon glyphicon-time"></span>
					                    </span>
					                </div>
					                </div>
								</div>
							  <?php if ($flight_info[0]->journey_type == 'MULTICITY') { 
								     $mfc = json_decode($flight_info[0]->multi_from_city);
								     $mtc = json_decode($flight_info[0]->multi_to_city);
								     $mdd = json_decode($flight_info[0]->multi_fcheckin);
								     $mdt = json_decode($flight_info[0]->multi_fcheckin_time);
								     for($i=0;$i<count($mfc);$i++) { ?>
							    <div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">From</label>									
									<div class="col-sm-5">
										
										<input name="multi_from_city[]" id ="multi_from_city" value="<?php echo $mfc[$i]; ?>" onKeyPress="airports_latest(<?php echo $i; ?>)"  type="text" class="form-control autosuggest"  placeholder="From City" autocomplete="off" required>
                                         
									</div>
								</div>	
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">To</label>									
									<div class="col-sm-5">
										
										<input name="multi_to_city[]" id ="multi_to_city" value="<?php echo  $mtc[$i]; ?>" onKeyPress="airports_latest1(<?php echo $i; ?>)"  type="text" class="form-control autosuggest1"  placeholder="To City" autocomplete="off" required>

									</div>
								</div>
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Departure date</label>									
									<div class="col-sm-3">
										<input type="text" class="form-control" id="multi_departure_date" value="<?php echo $mdd[$i]; ?>" onclick="multi_city_datepicker(<?php echo $i; ?>)"  name="multi_departure_date[]" placeholder="Date" data-validate="required" data-message-required="">
									</div>
									<label for="field-1" class="col-sm-2 control-label">Departure time</label>  
					                <div class="col-sm-3">                     
					                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					                    <input type="text" class="form-control" name="multi_departure_time[]" value="<?php echo $mdt[$i]; ?>" style="height: 30px;" >
					                    <span class="input-group-addon">
					                            <span class="glyphicon glyphicon-time"></span>
					                    </span>
					                </div>
					                </div>
								</div>
							    <?php }} ?>
							    <?php if($flight_info[0]->journey_type == 'ROUNDTRIP' ){ ?>
								<div class="form-group">
								<div class="return_date">
									<label for="field-1" class="col-sm-3 control-label">Return date</label>									
									<div class="col-sm-3">
										<input type="text" class="form-control" value="<?php echo $flight_info[0]->return_date; ?>"  id="return_date"  name="return_date">
									</div>
									<label for="field-1" class="col-sm-2 control-label">Return time</label>  
					                <div class="col-sm-3">                     
					                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					                    <input type="text" class="form-control" name="return_time" value="<?php echo $flight_info[0]->r_departure_time; ?>" style="height: 30px;" >
					                    <span class="input-group-addon">
					                            <span class="glyphicon glyphicon-time"></span>
					                    </span>
					                </div>
					                </div>
								</div>
							</div>
							<?PHP } ?>
							
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Adult</label>									
									<div class="col-sm-5">
										<select name="adult" id="Adults" class="select2" required>
											<?php for ($adult=1; $adult<=9; $adult++){ ?>
											
                								<option value="<?php echo $adult; ?>"<?php if ($flight_info[0]->adult == $adult) { ?> selected='selected'<?php }?>><?php echo $adult; ?></option>
                							<?php } ?>
										</select>
									</div>
								</div> 
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Child</label>									
									<div class="col-sm-5">
										<select name="child" id="Childs" class="select2" required>
											<?php for ($child=0; $child<=8; $child++){ ?>
                								<option value="<?php echo $child; ?>"<?php if ($flight_info[0]->child == $child) { ?> selected='selected'<?php }?>><?php echo $child; ?></option>
                							<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Infant</label>									
									<div class="col-sm-5">
										<select name="infant" id="Infants" class="select2" required>
											<?php for ($infant=0; $infant<=1; $infant++){ ?>
							                  <option value="<?php echo $infant; ?>"<?php if ($flight_info[0]->infant == $infant) { ?> selected='selected'<?php }?>><?php echo $infant; ?></option>
							               
							                <?php } ?>
										</select>
									</div>
								</div> 
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">No. Of Seats</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" value="<?php echo $flight_info[0]->number_of_seats; ?>" id="seats"  maxlength="1" max="9" min="1" size="1" name="seats"  data-validate="required">
									</div>
								</div> 
								
								<?php if($flight_info[0]->cabin_class == 'All'){ $StopType = 'All';}else if($flight_info[0]->cabin_class == 'F'){$StopType = 'First, Supersonic';}else if($flight_info[0]->cabin_class == 'C'){$StopType = 'Business';}else if($flight_info[0]->cabin_class == 'Y'){$StopType = 'Economic';}elseif($flight_info[0]->cabin_class == 'W'){$StopType = 'Premium Economy';}elseif($flight_info[0]->cabin_class == 'M') { $StopType ='Standard Economy';} ?>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Class</label>									
									<div class="col-sm-5">
										<select class="form-control" name="flight_class">
										<option value="<?php echo $flight_info[0]->cabin_class; ?>"><?php echo $StopType; ?></option>
						                <option value="All">All</option>
						                <option value="F">First, Supersonic</option>
						                <option value="C">Business</option>
						                <option value="Y">Economic</option>
						                <option value="W">Premium Economy</option>
						                <option value="M">Standard Economy</option>
						              </select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Flight Details</button>
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
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-clockpicker.min.js"></script>
	<script>
			$(document).ready(function(){
			    $("select").change(function(){
			        $(this).find("option:selected").each(function(){
			            if($(this).attr("value")=="one"){
			                $(".return_date").hide();
			            }
			            else if($(this).attr("value")=="round"){ 
			                $(".return_date").show();
			            }
			           /* else if($(this).attr("value")=="multi"){
			                $(".return_date").hide();
			            }*/
			        });
			    }).change();
			});

	</script>

	<script>
		$(document).ready(function(){
    $("#departure_date").datepicker({
        dateFormat: 'M dd yy',
        minDate: 0,
        //numberOfMonths: 1,
        onSelect: function(selected) {
          $("#return_date").datepicker("option","minDate", selected)
        }
    });
    $("#return_date").datepicker({ 
        //numberOfMonths: 1,
        dateFormat: 'M dd yy',
        onSelect: function(selected) {
           $("#departure_date").datepicker("option","maxDate", selected)
        }
    }); 
  
 $("#depature1" ).datepicker({
    minDate: 0,
    dateFormat: 'M dd yy',
    maxDate: "+1y",
    onClose: function( selectedDate ) {
      $( "#depature2" ).datepicker( "option", "minDate", selectedDate );
  
    }
  });
  
  jQuery( "#depature2" ).datepicker({
    minDate: +1,
    dateFormat: 'M dd yy',
    maxDate: "+1y",
    onClose: function( selectedDate ) {
      $( "#depature3" ).datepicker( "option", "minDate", selectedDate );
   
    }
  });
});

$("#Adults").change(function(e){
	var e = $("#Adults").val();
	var t = $("#Childs").val();
	var n = $("#Infants").val();
	var r, i;
	
	$("#Childs").children().remove(); 
	$("#Infants").children().remove();
	
	for (r = 0; r <=e; r++) i = $("<option/>", {
		value: r,
		text: r
	}), n == r && i.attr("selected", "selected"), $("#Infants").append(i);
	for (r = 0; r <= 9 - e; r++) i = $("<option/>", {
		value: r,
		text: r
	}), t == r && i.attr("selected", "selected"), $("#Childs").append(i);
});

// Child Combination With Adult and Infant
$("#Childs").change(function(e){
	var e = $("#Adults").val();
	var t = $("#Childs").val();
	var n = $("#Infants").val();
	var r, i;
	
	$("#Adults").children().remove();
	$("#Infants").children().remove();
	for (r = 0; r <=e; r++) i = $("<option/>", {
		value: r,
		text: r
	}), n == r && i.attr("selected", "selected"), $("#Infants").append(i);
	
	for (r = 1; r <= 9 - t; r++) i = $("<option/>", {
		value: r,
		text: r
	}), e == r && i.attr("selected", "selected"), $("#Adults").append(i);
});
	</script>

	<script>
	  function airports_latest(id){
	  	var mySelect = false;
	  $('#multi_from_city'+id).autocomplete({
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
	}
	function airports_latest1(id){
		var mySelect = false;
      $('#multi_to_city'+id).autocomplete({
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
    }
   // function multi_city_datepicker(id){
	  //   jQuery('#multi_departure_date'+id).datepicker({
	  //   minDate: +1,
	  //   dateFormat: 'M dd yy',
	  //   maxDate: "+1y",
   //      });
   //  }
	</script>
	<script type="text/javascript">
$('.clockpicker').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});

</script>
</body>
</html>
