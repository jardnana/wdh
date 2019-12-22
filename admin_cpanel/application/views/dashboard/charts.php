			<?php 
			$randvalues = ''; $randvalues1 = ''; $randvalues2 = ''; $randvalues3 = ''; $months = '';
			for ($i = 1; $i <= 12; $i++){
				$datestr =  date('Y-m', strtotime("-$i months"));
				$randvalues .= $this->General_Model->get_bookings('SIGHTSEEN',$datestr).",";
				$randvalues1 .= $this->General_Model->get_bookings('HOTEL',$datestr).","; 
				$randvalues2 .= $this->General_Model->get_bookings('TRANSFER',$datestr).",";
				$randvalues3 .= $this->General_Model->get_bookings('FLIGHT',$datestr).","; 
				$rand = $this->General_Model->get_bookings('SIGHTSEEN',$datestr);
				$rand1 = $this->General_Model->get_bookings('HOTEL',$datestr);
				$rand2 = $this->General_Model->get_bookings('TRANSFER',$datestr);
				$rand3 = $this->General_Model->get_bookings('FLIGHT',$datestr);
				$months .= date("{\m:'Y-m', \a:$rand, \b:$rand1, \c:$rand2, \d:$rand3},", strtotime("-$i months")); 
			}  //echo '<pre/>';print_r($months); ?>
			<script type="text/javascript">
				jQuery(document).ready(function($) 
				{
					// Sparkline Charts
					$('.pie').sparkline('html', {type: 'pie',borderWidth: 0, sliceColors: ['#3d4554', '#ee4749','#00b19d']});
					$('.linechart').sparkline();
					$('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'} );
					$('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'} );
						
					// Line Charts Begins
					var line_chart_demo = $("#line-chart-value");
					var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];		
					var line_chart = Morris.Line({
						element: 'line-chart-value',
						data: [<?php  echo $months; ?>],
						xkey: 'm',
						ykeys: ['a', 'b', 'c', 'd'],
						xLabelAngle: 70,
						labels: ['Sigthseen Booking', 'Hotel Booking', 'Transfer Booking', 'Flight Booking'],
						xLabels:['month'],
						xLabelFormat : function (x) { var month = months[x.getMonth()]; var year = new Date(x).getFullYear(); return year+" "+month; },
						redraw: true
					});
					line_chart_demo.parent().attr('style', '');
					// Line Charts Ends
					
					// Pie Chart Begins
					var donut_chart_demo = $("#pie-chart-value");					
					donut_chart_demo.parent().show();					
					var donut_chart = Morris.Donut({
						element: 'pie-chart-value',
						data: [
							{label: "B2C Users", value: 83},
							{label: "Visitors", value: 135},
							{label: "Messages", value: 23},
							{label: "Booking Count", value: 52 },
							{label: "Subscribers", value: 0 }
						],
						labelColor: '#303641',
						colors: ['#00a65a', '#6c541e', '#00c0ef', '#00b29e', '#0073b7']
					});					
					donut_chart_demo.parent().attr('style', '');
					// Pie Chart Ends
					
					// Area Chart Begins
					var area_chart_demo = $("#area-chart-value");					
					area_chart_demo.parent().show();					
					var area_chart = Morris.Area({
						element: 'area-chart-value',
						data: [<?php  echo $months; ?>],
						xkey: 'm',
						ykeys: ['a', 'b', 'c', 'd'],
						xLabelAngle: 70,
						labels: ['Sigthseen Booking', 'Hotel Booking', 'Transfer Booking', 'Flight Booking'],
						xLabels:['month'],
						xLabelFormat : function (x) { var month = months[x.getMonth()]; var year = new Date(x).getFullYear(); return year+" "+month; },
						redraw: true,
						lineColors: ['#303641', '#576277', '#BCC6CC', '#B6B6B4']
					});					
					area_chart_demo.parent().attr('style', '');
					// Area Chart Ends					
					

					// Area Chart Begins
					var bar_chart_demo = $("#bar-chart-value");					
					bar_chart_demo.parent().show();					
					var bar_chart = Morris.Bar({
						element: 'bar-chart-value',
						data: [<?php  echo $months; ?>],
						xkey: 'm',
						ykeys: ['a', 'b', 'c', 'd'],
						xLabelAngle: 50,
						labels: ['Sigthseen Booking', 'Hotel Booking', 'Transfer Booking', 'Flight Booking'],
						xLabels:['month'],
						stacked: true,
						barColors: ['#ffaaab', '#ff6264', '#FFA62F', '#EAC117']
					});
					bar_chart_demo.parent().attr('style', '');
					
					$(".pie-large").sparkline([3,2,5,9,7,2], {
						type: 'pie',
						width: '250px ',
						height: '150px',
						tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
						tooltipValueLookups: { 'offset': {0: 'B2C',1: 'Booking',2: 'Messages',3: 'Visitors',4: 'Subscribers' } },
						sliceColors: ['#00a65a','#f56954','#00b29e','#0073b7','#00c0ef']
						
					});

					$(".line-large").sparkline([<?php echo $randvalues; ?>], {
						type: 'line',
						width: '250px ',
						height: '150px',
						lineColor: '#ff4e50',
						highlightLineColor: '#ff8889',
						highlightSpotColor: '#b22425',
						minSpotColor: '#ff4e50',
						maxSpotColor: '#ff4e50',
						fillColor: '#f79696',
						lineWidth: 2,
						spotRadius: 4.5,
						normalRangeColor: '#ed4949'
					});
					$(".bar-large").sparkline([<?php echo $randvalues1; ?>], {
						type: 'bar',
						barColor: '#ff6264',
						height: '150px',
						barWidth: 10,
						barSpacing: 2
					});				
				});
				
				function getRandomInt(min, max){
					return Math.floor(Math.random() * (max - min + 1)) + min;
				}
				
			</script>

			<div class="col-sm-12">				
				<div class="panel panel-primary" id="charts_env">				
					<div class="panel-heading">
						<div class="panel-title">Site Stats</div>						
						<div class="panel-options">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#line-chart" data-toggle="tab">Line Charts</a></li>
								<li class=""><a href="#area-chart" data-toggle="tab">Area Chart</a></li>
								<li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>
								<li class=""><a href="#bar-chart" data-toggle="tab">Bar Chart</a></li>
								<li class=""><a href="#complete-chart" data-toggle="tab">Complete Information</a></li>
							</ul>
						</div>
					</div>			
					<div class="panel-body">					
						<div class="tab-content">
							<div class="tab-pane active" id="line-chart">
								<div id="line-chart-value" class="morrischart" style="height: 300px;width:100%"></div>
							</div>
							<div class="tab-pane" id="area-chart">							
								<div id="area-chart-value" class="morrischart" style="height: 300px;width:100%"></div>
							</div>							
							<div class="tab-pane" id="pie-chart">
								<div id="pie-chart-value" class="morrischart" style="height: 300px;width:100%"></div>
							</div>							
							<div class="tab-pane" id="bar-chart">
								<div id="bar-chart-value" class="morrischart"  style="height: 300px;width:100%"></div>
							</div>	
							<div class="tab-pane" id="complete-chart">								
								<div class="row">
									<div class="col-md-4">									
										<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
											<!-- panel head -->
											<div class="panel-heading">
												<div class="panel-title">Large Chart Pie</div>
												
												<div class="panel-options">
													<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
													<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
													<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
													<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
												</div>
											</div>											
											<!-- panel body -->
											<div class="panel-body">
												<p>B2C, Booking, Messages, Visitors, Bookings, Subscribers</p>
												<br />												
												<div class="text-center">
													<span class="pie-large"></span>
												</div>
											</div>
										</div>										
									</div>
									<div class="col-md-4">
										<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
											<!-- panel head -->
											<div class="panel-heading">
												<div class="panel-title">Large Line Chart</div>												
												<div class="panel-options">
													<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
													<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
													<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
													<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
												</div>
											</div>											
											<!-- panel body -->
											<div class="panel-body">
												<p>Sigthseen Booking Details in a year</p>
												<br />												
												<div class="text-center">
													<span class="line-large"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
											<!-- panel head -->
											<div class="panel-heading">
												<div class="panel-title">Large Bar Chart</div>												
												<div class="panel-options">
													<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
													<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
													<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
													<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
												</div>
											</div>											
											<!-- panel body -->
											<div class="panel-body">
												<p>Hotel Booking details in a year</p>
												<br />												
												<div class="text-center">
													<span class="bar-large"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
											<!-- panel head -->
											<div class="panel-heading">
												<div class="panel-title">Large Bar Chart</div>												
												<div class="panel-options">
													<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
													<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
													<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
													<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
												</div>
											</div>											
											<!-- panel body -->
											<div class="panel-body">
												<p>Transfer Booking details in a year</p>
												<br />												
												<div class="text-center">
													<span class="bar-large"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
											<!-- panel head -->
											<div class="panel-heading">
												<div class="panel-title">Large Bar Chart</div>												
												<div class="panel-options">
													<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
													<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
													<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
													<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
												</div>
											</div>											
											<!-- panel body -->
											<div class="panel-body">
												<p>Flight Booking details in a year</p>
												<br />												
												<div class="text-center">
													<span class="bar-large"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>						
					</div>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th width="50%" class="col-padding-1">
									<div class="pull-left">
										<div class="h4 no-margin">Pageviews</div>
										<small>520</small>
									</div>
									<span class="pull-right pageviews"><?php echo $randvalues; ?></span>
									
								</th>
								<th width="50%" class="col-padding-1">
									<div class="pull-left">
										<div class="h4 no-margin">Unique Visitors</div>
										<small>135</small>
									</div>
									<span class="pull-right uniquevisitors"><?php echo $randvalues1; ?></span>
								</th>
							</tr>
						</thead>						
					</table>					
				</div>	
			</div>

			<?php if(false){ ?>
				<div class="col-sm-4">

					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title">
								<h4>
									Real Time Stats
									<br />
									<small>current server uptime</small>
								</h4>
							</div>
							
							<div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div>
						</div>
					
						<div class="panel-body no-padding">
							<div id="rickshaw-chart-demo">
								<div id="rickshaw-legend"></div>
							</div>
						</div>
					</div>

				</div>
				<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/rickshaw/rickshaw.min.css">		
			<?php } ?>
