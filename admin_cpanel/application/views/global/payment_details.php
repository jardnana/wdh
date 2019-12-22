<div class="col-xs-8 nopadding">
	<div class="farehd arimobold">Payment Details</div>
	<div class="flitab1">
		<div id="payment_info" class="ontyp">	
			<div class="full_login_sec">													
				<div class="insidebook">													
					<h3 class="bukhead">Credit Card Details</h3>
					<div class="pasngrinput">
						<div class="col-xs-12 nopadding">
							<div class="inptalbox">
								<div class="col-xs-6 spllty allreds">
									<span class="formlabel">Card Holder Name:*</span>
									<div class="relativemask"> 
										<input type="text" class="clainput capitalize" id="CardHolderName" name="CardHolderName" placeholder="Card Holder Name" value="" required />
									</div>
								</div>
								<div class="col-xs-6 spllty allreds">
									<span class="formlabel">Card Type :*</span>
									<div class="selectwrp custombord">
										<select class="mySelectBoxClass flyinputsnor" id="CardType" name="CardType" required>
											<option value="VI">Visa</option>
											<option value="MC">Mastercard</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 spllty allreds">
									<span class="formlabel">Card Number:*</span>
									<div class="relativemask"> 
										<input type="text" class="clainput numbers" id="CardNumber" name="CardNumber" placeholder="Card Number" value="" required />
									</div>
								</div>
								<div class="col-xs-6 nopad allreds">
									<span class="formlabel lablpad">Card Expiry Month and Year :*</span>
									<div class="col-xs-6 spllty">
										<div class="selectwrp custombord">
											<select class="mySelectBoxClass flyinputsnor" id="CardExpireMonth" name="CardExpireMonth" required>
												<option>Month</option>
												<option value="01">Jan (01)</option>
												<option value="02">Feb (02)</option>
												<option value="03">Mar (03)</option>
												<option value="04">Apr (04)</option>
												<option value="05">May (05)</option>
												<option value="06">June (06)</option>
												<option value="07">July (07)</option>
												<option value="08">Aug (08)</option>
												<option value="09">Sep (09)</option>
												<option value="10">Oct (10)</option>
												<option value="11">Nov (11)</option>
												<option value="12">Dec (12)</option>
											</select>
										</div>
									</div>
									<div class="col-xs-6 spllty">
										<div class="selectwrp custombord">
										<select class="mySelectBoxClass flyinputsnor" id="CardExpireYear" name="CardExpireYear" required>
											<?php  $curr_year = date('y');
												for($year=$curr_year; $year<($curr_year+15); $year++ ){
													if($year <= 9){
														$year1 = '200'.$year;
													} else {
														$year1 = '20'.$year;
													} ?>
													<option value="<?php echo $year1; ?>"><?php echo $year1; ?></option>
												<?php } ?>
										</select>
										</div>
									</div>
								</div>
								
								<div class="col-xs-6 spllty allreds">
									<span class="formlabel">Card Security Code:*</span>
									<div class="relativemask"> 
										<input type="password" class="clainput numbers" id="CardSecurityCode" name="CardSecurityCode" placeholder="123" value="" required />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sepertr"></div>
				<div class="insidebook">
					<h3 class="bukhead">Credit Card Billing Address</h3>
					<div class="pasngrinput">
						<div class="col-xs-12 nopadding">
							<div class="inptalbox">
								<div class="col-xs-12 spllty">
									<span class="formlabel">Contact Email *</span>
									<input type="text" class="clainput email" id="card_contact_email" name="card_contact_email" placeholder="Enter Email Address" onfocusout="get_userinfo_by_email(this.value,'<?php echo site_url().'index.php/booking/get_userinfo_by_email';?>');" value="" required="">
								</div>
								<div class="col-xs-4 spllty">
									<span class="formlabel">First Name *</span>
									<input type="text" class="clainput capitalize" id="card_contact_first_name" name="card_contact_first_name" placeholder="Enter Given Name" required="">
								</div>
								<div class="col-xs-4 spllty">
									<span class="formlabel">Middle Name</span>
									<input type="text" class="clainput capitalize" id="card_contact_middle_name" name="card_contact_middle_name" placeholder="Enter Middle Name" required="">
								</div>
								<div class="col-xs-4 spllty">
									<span class="formlabel">Last Name *</span>
									<input type="text" class="clainput capitalize" id="card_contact_last_name" name="card_contact_last_name" placeholder="Enter Surename" required="">
								</div>
								<div class="col-xs-6 spllty fullsectr">
									<span class="formlabel">Nationality *</span>
									<div class="selectwrp custombord">
										<select class="mySelectBoxClass flyinputsnor" id="card_contact_nationality" name="card_contact_nationality" required="">
											<?php for($c=0;$c<count($country_details);$c++){ ?>
												<option value="<?php echo $country_details[$c]->iso3_code; ?>" <?php if($country_details[$c]->iso3_code =="IND"){ echo "selected"; } ?>><?php echo $country_details[$c]->country_name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-xs-6 spllty fullsectr">
									<span class="formlabel">City *</span>
									<div class="relativemask"> 
										<input type="text" class="clainput capitalize" id="card_contact_city" name="card_contact_city" placeholder="City" required="">
									</div>
								</div>
								<div class="col-xs-6 spllty fullsectr">
									<span class="formlabel">State </span>
									<div class="relativemask"> 
										<input type="text" class="clainput capitalize" id="card_contact_state" name="card_contact_state" placeholder="State" required="">
									</div>
								</div>
								<div class="col-xs-6 spllty fullsectr">
									<span class="formlabel">Postal Code / Zip code *</span>
									<div class="relativemask"> 
										<input type="text" class="clainput numbers" id="card_contact_zipcode" name="card_contact_zipcode" placeholder="Postal Code / Zip code" required="" maxlength="6">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pasngrinput">
					<div class="loginspld">
						<div class="collogg">
							<!--<div class="temsandcndtn">Most countries require travelers to have a passport valid for more than 3 to 6 months from the date of entry into or exit from the country. Please check the exact rules for your destination country before completing the booking.</div>-->
							<div class="continye col-xs-3"><a id="save_traveller_info" class="bgreen bluee">Continue</a></div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div id="payment_loader" class="continye" style="display:none;" align="center">
				<div class="splmrg"><img src="<?php echo base_url(); ?>assets/images/loader.gif" /></div>
				<div class="temsandcndtn"><span class="dontref">Please wait !!! Dont press Back or Refresh</span></div>
			</div>
	</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate/jquery.creditCardValidator.js"></script>
<script>
	$('#validate').validate();
	var validatecardnumber=false;
	var email_filter 	= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var number_filter 	= /^[0-9]+$/; 
	var alpha_filter 	= /^[a-zA-Z]+$/; 
	$(function(){
		$('#CardNumber').validateCreditCard(function(result) {
				$(this).parent().find('.errorcls').remove();
                if(result.valid && result.length_valid && result.luhn_valid){
                    validatecardnumber = true;
                    $(this).css('border', '1px solid #099A7D');	
                }else{
                    if($.trim($(this).val())!='')
                        $(this).after("<font class='errorcls' color='red'>Invalid Card Number</font>");
					$(this).css('border', '1px solid #f52c2c');    
                    validatecardnumber = false;
                }
		});
		$('input#card_contact_first_name,input#card_contact_last_name,input#card_contact_city,input#card_contact_state').keyup(function() {
			var sAlphabetic = $(this).val();
			if(sAlphabetic != ''){
				if (alpha_filter.test(sAlphabetic)) {
					$(this).css('border', '1px solid #099A7D');	
				}else {
					$(this).css('border', '1px solid #f52c2c');
				}
			}else{
				$(this).css('border', '1px solid #ddd');
			}
		});
		$('input#card_contact_email').keyup(function() {
			var sEmail = $(this).val();
			if(sEmail != ''){
				if (email_filter.test(sEmail)) {
					$(this).css('border', '1px solid #099A7D');	
				}else {
					$(this).css('border', '1px solid #f52c2c');
				}
			}else{
				$(this).css('border', '1px solid #ddd');
			}
		});
	});
</script>
