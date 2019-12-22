<div class="col-sm-3">
					<div class="tile-block" id="todo_tasks">
						
						<div class="tile-header">
							<i class="entypo-list"></i>
							
							<a href="#">
								Tasks
								<span>To do list, tick one.</span>
							</a>
						</div>
						
						<div class="tile-content">
							
							<input type="text" class="form-control" placeholder="Add Task" />
							
							
							<ul class="todo-list">
								<li>
									<div class="checkbox checkbox-replace color-white">
										<input type="checkbox" />
										<label>Website Design</label>
									</div>
								</li>
								
								<li>
									<div class="checkbox checkbox-replace color-white">
										<input type="checkbox" id="task-2" checked />
										<label>Slicing</label>
									</div>
								</li>
								
								<li>
									<div class="checkbox checkbox-replace color-white">
										<input type="checkbox" id="task-3" />
										<label>WordPress Integration</label>
									</div>
								</li>
								
								<li>
									<div class="checkbox checkbox-replace color-white">
										<input type="checkbox" id="task-4" />
										<label>SEO Optimize</label>
									</div>
								</li>
								
								<li>
									<div class="checkbox checkbox-replace color-white">
										<input type="checkbox" id="task-5" checked="" />
										<label>Minify &amp; Compress</label>
									</div>
								</li>
							</ul>
							
						</div>
						
						<div class="tile-footer">
							<a href="#">View all tasks</a>
						</div>
						
					</div>
				</div>

				<div class="col-sm-9">
					
					<script type="text/javascript">
						jQuery(document).ready(function($)
						{
							var map = $("#map-2");
							
							map.vectorMap({
								map: 'europe_merc_en',
								zoomMin: '3',
								backgroundColor: '#383f47',
								focusOn: { x: 0.5, y: 0.8, scale: 3 }
							});
						});
					</script>
					
					<div class="tile-group">
						
						<div class="tile-left">
							<div class="tile-entry">
								<h3>Map</h3>
								<span>top visitors location</span>
							</div>
							
							<div class="tile-entry">
								<img src="<?php echo base_url(); ?>assets/images/sample-al.png" alt="" class="pull-right op" />
								
								<h4>Albania</h4>
								<span>25%</span>
							</div>
							
							<div class="tile-entry">
								<img src="<?php echo base_url(); ?>assets/images/sample-it.png" alt="" class="pull-right op" />
								
								<h4>Italy</h4>
								<span>18%</span>
							</div>
							
							<div class="tile-entry">
								<img src="<?php echo base_url(); ?>assets/images/sample-au.png" alt="" class="pull-right op" />
								
								<h4>Austria</h4>
								<span>15%</span>
							</div>
						</div>
						
						<div class="tile-right">
							
							<div id="map-2" class="map"></div>
							
						</div>
						
					</div>
					
				</div>
