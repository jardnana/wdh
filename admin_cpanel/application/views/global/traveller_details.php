<div class="col-xs-8 nopadding">
	<form id="passenger_details" enctype="multipart/form-data" name="passenger_details" >
		<input type="hidden" name="search_id" value="<?php echo base64_encode(json_encode($search_id)); ?>" />
		<input type="hidden" name="rand_id" value="<?php echo base64_encode(json_encode($rand_id)); ?>" />
		<input type="hidden" name="cart_global_id" value="<?php echo base64_encode(json_encode($cart_global_id)); ?>" />
		<div class="farehd arimobold">Contact Information</div>
		<div class="insidebook">
			<div class="pasngrinput">
				<div class="col-xs-12 nopadding">
					<div class="inptalbox">
						<div class="col-xs-12 spllty">
							<span class="formlabel">Contact Email *</span>
							<input type="text" class="clainput email" id="contact_email" name="contact_email" placeholder="Enter Email Address" onfocusout="get_userinfo_by_email(this.value,'<?php echo site_url().'index.php/booking/get_userinfo_by_email';?>');" value="" required="">
						</div>
						<div class="col-xs-4 spllty">
							<span class="formlabel">First Name *</span>
							<input type="text" class="clainput capitalize" id="contact_first_name" name="contact_first_name" placeholder="Enter Given Name" required="">
						</div>
						<div class="col-xs-4 spllty">
							<span class="formlabel">Middle Name</span>
							<input type="text" class="clainput capitalize" id="contact_middle_name" name="contact_middle_name" placeholder="Enter Middle Name" required="">
						</div>
						<div class="col-xs-4 spllty">
							<span class="formlabel">Last Name *</span>
							<input type="text" class="clainput capitalize" id="contact_last_name" name="contact_last_name" placeholder="Enter Surename" required="">
						</div>
						<div class="col-xs-6 spllty fullsectr">
							<span class="formlabel">Nationality *</span>
							<div class="selectwrp custombord">
								<select class="mySelectBoxClass flyinputsnor" id="contact_nationality" name="contact_nationality" required="">
									<?php for($c=0;$c<count($country_details);$c++){ ?>
										<option value="<?php echo $country_details[$c]->iso3_code; ?>" <?php if($country_details[$c]->iso3_code =="IND"){ echo "selected"; } ?>><?php echo $country_details[$c]->country_name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-xs-6 spllty fullsectr">
							<span class="formlabel">City *</span>
							<div class="relativemask"> 
								<input type="text" class="clainput capitalize" id="contact_city" name="contact_city" placeholder="City" required="">
							</div>
						</div>
						<div class="col-xs-6 spllty fullsectr">
							<span class="formlabel">State *</span>
							<div class="relativemask"> 
								<input type="text" class="clainput capitalize" id="contact_state" name="contact_state" placeholder="State" required="">
							</div>
						</div>
						<div class="col-xs-6 spllty fullsectr">
							<span class="formlabel">Postal Code / Zip code *</span>
							<div class="relativemask"> 
								<input type="text" class="clainput numbers" id="contact_zipcode" name="contact_zipcode" placeholder="Postal Code / Zip code" required="" maxlength="6">
							</div>
						</div>
						<div class="col-xs-6 nopad telfull fullsectr">
							<span class="formlabel lablpad">Telephone No *</span>
							<div class="col-xs-4 spllty">
								<div class="selectwrp custombord">
									<select class="mySelectBoxClass flyinputsnor" id="telephone_code" name="telephone_code" required="">
										<?php for($c=0;$c<count($country_details);$c++){ if($country_details[$c]->phone_code !='' && $country_details[$c]->phone_code != 0){ ?>
											<option value="<?php echo $country_details[$c]->phone_code; ?>" <?php if($country_details[$c]->phone_code == "91"){ echo "selected"; } ?>>+<?php echo $country_details[$c]->phone_code; ?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
							<div class="col-xs-8 spllty">
								<input type="text" class="clainput numbers" id="phone_number" name="phone_number" placeholder="" required="" maxlength="10">
							</div>
						</div>
						<div class="col-xs-6 nopad telfull fullsectr">
							<span class="formlabel lablpad">Mobile No *</span>
							<div class="col-xs-4 spllty">
								<div class="selectwrp custombord">
									<select class="mySelectBoxClass flyinputsnor" id="mobile_code" name="mobile_code" required="">
										<?php for($c=0;$c<count($country_details);$c++){ if($country_details[$c]->phone_code !='' || $country_details[$c]->phone_code != 0){  ?>
											<option value="<?php echo $country_details[$c]->phone_code; ?>" <?php if($country_details[$c]->phone_code =="91"){ echo "selected"; } ?>>+<?php echo $country_details[$c]->phone_code; ?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
							<div class="col-xs-8 spllty">
								<input type="text" class="clainput numbers" id="mobile_number" name="mobile_number" placeholder="" value="" required="" maxlength="10">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sepertr"></div>
		<div class="farehd arimobold">Traveller Details</div>
		<div class="fligthsdets">
		<div class="flitab1">
			<?php 
			for($i=0;$i<count($results);$i++){ $searchdata = json_decode(base64_decode($search_data[$i]));  $Passenegrcount = $searchdata[0]->adult + $searchdata[0]->child + $searchdata[0]->infant; $ADT = 0; $CHD = 0; $INF = 0; 
			for($a=0;$a<$Passenegrcount;$a++){ 
				if($a < $searchdata[0]->adult){
					$name = 'adult'; $p = ++$ADT;
				}else if($a >= $searchdata[0]->adult && ($a < ($searchdata[0]->adult + $searchdata[0]->child))){
					$name = 'child'; $p = ++$CHD;
				}
				elseif($a >= ($searchdata[0]->adult + $searchdata[0]->child)){
					$name = 'infant'; $p = ++$INF;
				} ?>
			<div class="moreflt boksectn">
				<div class="ontyp">
					<div class="pasngrinput">
						<div class="col-xs-2 nopadding">
							<div class="adltnom"><?php echo ucfirst($name)." ".($p) ?></div>
						</div>
						<div class="col-xs-10 nopadding">
							<div class="inptalbox">							
								<div class="col-xs-2 spllty">
									<select class="mySelectBoxClass flyinputsnor" id="sal<?php echo $name.$p ?>" name="sal<?php echo $name; ?>[]">
										<option value="">Select</option>
										<option value="Mr">Mr</option>
										<option value="Mrs">Mrs</option>
									</select>
								</div>
								<div class="col-xs-3 spllty">
									<input type="text" minlength="4" maxlength="15" class="clainput" id="fname<?php echo $name.$p ?>" name="fname<?php echo $name; ?>[]" placeholder="Enter Given Name" />
								</div>
								<div class="col-xs-3 spllty">
									<input type="text" maxlength="15" id="mname<?php echo $name.$p ?>" name="mname<?php echo $name; ?>[]" class="clainput" placeholder="Enter Middle Name" />
								</div>
								<div class="col-xs-4 spllty">
									<input type="text" minlength="4" maxlength="15" id="lname<?php echo $name.$p ?>" name="lname<?php echo $name; ?>[]" class="clainput" placeholder="Enter Surename" />
								</div>
								<div class="col-xs-5 spllty">
									<div class="relativemask"> 
										<span class="maskimg caln">DOB</span>
										<input type="text" placeholder="Date of birth"  id="dob<?php echo $name.$p ?>" name="dob<?php echo $name; ?>[]" class="forminput" >
									</div>
								</div>							
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>		
			<div class="clearfix"></div>
			<div class="sepertr"></div>
		<?php }} ?>
			
		
		<?php if(false){ ?>
		<div class="clikdiv">
			 <div class="squaredThree">
			 <input id="squaredThree1" type="checkbox" name="check" value="None">
			 <label for="squaredThree1"></label>
			 </div>
			 <span class="clikagre">
				Add above travelers to my passenger list <strong>(We will not share this information with other parties) </strong>
			 </span>
		</div>
		<div class="clearfix"></div>
		<?php } ?>
		<div class="clearfix"></div>
		<div class="loginspld">
			<div class="collogg"><div class="continye col-xs-3"><a onclick="validate_traveller_info();" class="bgreen bluee">Continue</a></div></div>
		</div>
	</div>  
	</div>
</div>
					
