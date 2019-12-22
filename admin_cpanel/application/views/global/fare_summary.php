	<div class="col-xs-4 nopadding">
		<div class="insiefare">							
			<div class="farehd arimobold">Fare Summary</div>
			<?php for($i=0;$i<count($results);$i++){ $searchdata = json_decode(base64_decode($search_data[$i]));$result[0] = '';$result[0] = json_decode(base64_decode($results[$i]),1); ?>
				<div class="fredivs">
					<div class="kindrest">
						<div class="freshd">Base Fare</div>
						<div class="reptallt">
							<div class="col-xs-8 nopadding">
								<div class="faresty"> Adult(s) ‎(<?php echo $searchdata[0]->adult; ?> X <?php echo $result[0][0]['PEquivFare'][0]; ?>)</div>
							</div>
							<div class="col-xs-4 nopadding">
								<div class="amnter"><?php echo $result[0][0]['PEquivFare_CurrencyCode'][0]; ?> <?php echo ($searchdata[0]->adult * $result[0][0]['PEquivFare'][0]); ?></div>
							</div>
						</div>
						<?php if(isset($searchdata[0]->child) && ($searchdata[0]->child > 0)){ ?>
						<div class="reptallt">
							<div class="col-xs-8 nopadding">
								<div class="faresty"> Child(s) ‎(<?php echo $searchdata[0]->child; ?> X <?php echo $result[0][0]['PEquivFare'][1]; ?>)</div>
							</div>
							<div class="col-xs-4 nopadding">
								<div class="amnter"><?php echo $result[0][0]['PEquivFare_CurrencyCode'][0]; ?> <?php echo ($searchdata[0]->child * $result[0][0]['PEquivFare'][1]); ?> </div>
							</div>
						</div>
						<?php } ?> ‎ 
						<?php if(isset($searchdata[0]->infant) && ($searchdata[0]->infant > 0)){ ?>
						<div class="reptallt">
							<div class="col-xs-8 nopadding">
								<div class="faresty"> Infant(s) ‎(<?php echo $searchdata[0]->infant; ?> X <?php echo $result[0][0]['PEquivFare'][2]; ?>)</div>
							</div>
							<div class="col-xs-4 nopadding">
								<div class="amnter"><?php echo $result[0][0]['PEquivFare_CurrencyCode'][0]; ?> <?php echo ($searchdata[0]->infant * $result[0][0]['PEquivFare'][2]); ?> </div>
							</div>
						</div>
						<?php } ?> ‎ 
						<div class="reptallt">
							<div class="col-xs-8 nopadding"><div class="freshd">Taxes</div></div>
							<div class="col-xs-4 nopadding">
								<div class="amnter "><?php echo $result[0][0]['PEquivFare_CurrencyCode'][0]; ?>  <?php echo $result[0][0]['TotalFare'] - $result[0][0]['EquivFare'] ?></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="sepertr"></div>
			<?php } ?>	
			<div class="fredivs reptalltftr">
				<div class="col-xs-8 nopadding">
					<div class="farestybig">Grand Total</div>
				</div>
				<div class="col-xs-4 nopadding">
					<div class="amnterbig arimobold"><?php echo $result[0][0]['PEquivFare_CurrencyCode'][0]; ?>  <?php echo $result[0][0]['TotalFare']; ?></div>
				</div>
			</div>
		</div>
	</div>

