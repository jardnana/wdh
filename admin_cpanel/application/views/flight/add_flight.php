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
<!--
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap.min.css">
-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker/github.min.css">               
</head>
<body id="top" oncontextmenu="return false" class="thebg page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?>  <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."flight/flight_list"; ?>">FLIGHT</a></li>
				<li class="active"><strong>Add New FLIGHT</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New FLIGHT
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."flight/add_flight_data"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Flight Trip</label>									
									<div class="col-sm-5">
										<select name="trip_type" class="form-control" required>
											<?php //if($product!=''){ for($p=0;$p<count($product);$p++){ ?>
											<option value="oneway" data-iconurl="">One-Way</option>
											<option value="roundtrip" data-iconurl="">Round-Way</option>
											<option value="multicity" data-iconurl="">Multi-Way</option>
											<?php //}} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">From</label>									
									<div class="col-sm-5">
										
										<input name="from_city" id ="from_city"  type="text" class="form-control autosuggest"  placeholder="From City" autocomplete="off" required>
                                        
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">To</label>									
									<div class="col-sm-5">
										
										<input name="to_city" id ="to_city"  type="text" class="form-control autosuggest"  placeholder="To City" autocomplete="off" required>

									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Start date</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="departure_date"  name="departure_date" placeholder="Start Date" data-validate="required" data-message-required="" required>
									</div>
					            </div>
							
								<div class="form-group">
								<div class="return_date">
									<label for="field-1" class="col-sm-3 control-label">End date</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="return_date"  name="return_date" placeholder="End Date" data-validate="required" data-message-required="" required>
									</div>
								</div>
								
							</div>
							<?php if(true){ ?>
							    <div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Adult</label>									
									<div class="col-sm-5">
										<select name="adult" id="Adults" class="select" required style="width: 100%;">
											<?php for ($adult=1; $adult<=9; $adult++){ ?>
                								<option value="<?php echo $adult; ?>"><?php echo $adult; ?></option>
                							<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Child</label>									
									<div class="col-sm-5">
										<select name="child" id="Childs" class="select" style="width: 100%;">
											<?php for ($child=0; $child<=8; $child++){ ?>
                								<option value="<?php echo $child; ?>"><?php echo $child; ?></option>
                							<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Infant</label>									
									<div class="col-sm-5">
										<select name="infant" id="Infants" class="select" style="width: 100%;">
											<?php for ($infant=0; $infant<=1; $infant++){ ?>
							                  <option value="<?php echo $infant; ?>"><?php echo $infant; ?></option>
							                <?php } ?>
										</select>
									</div>
								</div> 
							<?php } ?>
								<div class="form-group" style="display:none;">
									<label for="field-1" class="col-sm-3 control-label">Airline</label>									
									<div class="col-sm-5">
										<select name="airline" class="select2">
											<option value=""/>
											<?php if($airline_list!=''){ for($ad=0;$ad<count($airline_list);$ad++){ ?>
											<option value="<?php echo $airline_list[$ad]->airline_code; ?>" <?php if($airline_list[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline_list[$ad]->airline_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	
								<div class="form-group" style="display:none">
									<label for="field-1" class="col-sm-3 control-label">Class</label>									
									<div class="col-sm-5">
										<input type="hidden" class="form-control" id="flight_class" value="Y" name="flight_class">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Flight Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
			<?php $this->load->view('general/footer');	?>				
		</div>				
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
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script>
	$(document).ready(function () {
		var mySelect = false;
		$(".autosuggest").autocomplete({
			source: "<?php echo base_url(); ?>flight/get_airports",
			minLength: 2, //search after two characters
			autoFocus: true, // first item will automatically be focused
			select: function (event, ui) { mySelect = true; },
			change: function(event, ui) {
				if (ui.item == null) { $(this).val(""); }
			}
        });
		$("#departure_date").datepicker({
			dateFormat: 'M dd yy',
			minDate: 0,
			onSelect: function(selected) { $("#return_date").datepicker("option","minDate", selected) }
		});
		$("#return_date").datepicker({ 
			dateFormat: 'M dd yy',
			onSelect: function(selected) { $("#departure_date").datepicker("option","maxDate", selected) }
		}); 
  
		$("#depature1" ).datepicker({
			minDate: 0,
			dateFormat: 'M dd yy',
			maxDate: "+1y",
			onClose: function( selectedDate ) { $( "#depature2" ).datepicker( "option", "minDate", selectedDate ); }
		});	
  
		jQuery( "#depature2" ).datepicker({
			minDate: +1,
			dateFormat: 'M dd yy',
			maxDate: "+1y",
			onClose: function( selectedDate ) { $( "#depature3" ).datepicker( "option", "minDate", selectedDate ); }
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
	
	function airports_latest(id){
	  	var mySelect = false;
		$('#multi_from_city'+id).autocomplete({
			source: "<?php echo base_url(); ?>flight/get_airports",
			minLength: 2, //search after two characters
			autoFocus: true, // first item will automatically be focused
			select: function (event, ui) { mySelect = true; },
			change: function(event, ui) {
				if (ui.item == null) { $(this).val(""); }
			}
        });
	}
	function airports_latest1(id){
		var mySelect = false;
		$('#multi_to_city'+id).autocomplete({
			source: "<?php echo base_url(); ?>flight/get_airports",
			minLength: 2, //search after two characters
			autoFocus: true, // first item will automatically be focused
			select: function (event, ui) { mySelect = true; },
			change: function(event, ui) {
				if (ui.item == null) { $(this).val(""); }
			}
        });
    }
	</script>
</body>
</html>
