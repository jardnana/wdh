<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.popupoverlay.js"></script> 
<script>
	$(document).ready(function(){
		var email_filter 	= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var number_filter 	= /^[0-9]+$/; 
		var alpha_filter 	= /^[a-zA-Z]+$/;  
		$("#flip").click(function(){ $("#panel").slideToggle("slow"); });
		$('.timezon').click(function(){ $(this).toggleClass('active'); });
		$('#stepbk1').click(function(){
			$('.rondsts').removeClass('active');
			$(this).parent('.rondsts').addClass('active');
			$('.bktab2, .bktab3').fadeOut(500,function(){$('.bktab1').fadeIn(500)});
		});		
		$('#stepbk2').click(function(){
			// $(this).parent('.rondsts').addClass('active');
			// $('#stepbk1').parent('.rondsts').addClass('success');
			// $('#stepbk2').parent('.rondsts').removeClass('success');
			// $('.bktab1, .bktab3').fadeOut(500,function(){$('.bktab2').fadeIn(500)});
		});
		$('#stepbk3').click(function(){
			// $(this).parent('.rondsts').addClass('active');
			// $('#stepbk1,#stepbk2').parent('.rondsts').addClass('success');
			// $('.bktab1, .bktab2').fadeOut(500,function(){$('.bktab3').fadeIn(500)});
		});
		
		$('#gulogin').click(function(){
			$('#loginsec').hide();
			$('#guestsec').show().focus();
			return false;
		});
	
		$('#relogin').click(function(){
			$('.fadeandscale_open').trigger('click');	
		});
		
		$('input#contact_email').keyup(function() {
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
		
		$('input#phone_number,input#mobile_number').keyup(function() {
			var sNumber = $(this).val();
			if(sNumber != ''){
				if (number_filter.test(sNumber)) {
					$(this).css('border', '1px solid #099A7D');	
				}else {
					$(this).css('border', '1px solid #f52c2c');
				}
			}else{
				$(this).css('border', '1px solid #ddd');
			}
		});
		
		$('input#contact_first_name,input#contact_last_name,input#contact_city,input#contact_state').keyup(function() {
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
		
		$('#login_validation').click(function(){
			var login_email = document.getElementById('login_email');
			if(login_email.value != ''){
				if(!(login_email.value.match(email_filter))){
					login_email.style.borderColor = "Red"; 
					$('#login_email').focus(); return false;
				}else{
					$(this).parent('.rondsts').addClass('active');
					$('#stepbk1').parent('.rondsts').addClass('success');
					$('#stepbk2').parent('.rondsts').removeClass('success');
					$('.bktab1, .bktab3').fadeOut(500,function(){$('.bktab2').fadeIn(500)});
					$(window).scrollTop(0);
					
					if(false){
						$.ajax({
							type: "POST",
							url: '<?php echo site_url(); ?>account/login',
							data: $("#login2").serialize(),
							dataType: "json",
							success: function(data){
								if(data.status == 1){
									window.location.href = data.continue;
									$('#user_loginbtn').attr('href','#travellerdets');
									$(window).scrollTop(0);
								} else if(data.status == 2) {
									var curUrl = document.URL; //encode to base64
									window.location.href = site_url()+'/security/verifytwostep?url='+curUrl;
								} else{
									$('div.popuperror').html(data.msg);
									$('div.popuperror').show();
								}
							}
						});
					}
				}
			}else{
				login_email.style.borderColor = "Red"; 
				$('#login_email').focus(); return false;
			}
		});
		
		$('#guest_validation').click(function(){
			var guest_email = document.getElementById('guest_email');
			if(guest_email.value != ''){
				if(!(guest_email.value.match(email_filter))){
					guest_email.style.borderColor = "Red"; 
					$('#guest_email').focus(); return false;
				}else{
					$(this).parent('.rondsts').addClass('active');
					$('#stepbk1').parent('.rondsts').addClass('success');
					$('#stepbk2').parent('.rondsts').removeClass('success');
					$('.bktab1, .bktab3').fadeOut(500,function(){$('.bktab2').fadeIn(500)});
					$(window).scrollTop(0);
				}
			}else{
				guest_email.style.borderColor = "Red"; 
				$('#guest_email').focus(); return false;
			}
		});
	
		$('#save_traveller_info').click(function(){
			var email_filter 	= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			var number_filter 	= /^[0-9]+$/; 
			var alpha_filter 	= /^[a-zA-Z]+$/; 
			// Email Validation for Contact Info
			var sEmail = document.getElementById('card_contact_email');
			if (sEmail.value == ''){
				sEmail.style.borderColor = "Red"; 
				$('#card_contact_email').focus(); return false;
			}else{
				if(!(sEmail.value.match(email_filter))){
					sEmail.style.borderColor = "Red"; 
					$('#card_contact_email').focus(); return false;
				}else{
					sEmail.style.borderColor = "green"; 
				}
			}
			
			// First Name Validation  Contact Info
			var fname = document.getElementById('card_contact_first_name');
			var filter = /^[0-9a-zA-Z]+$/; 
			if (fname.value == ''){
				fname.style.borderColor = "Red"; 
				$('#card_contact_first_name').focus(); return false;
			}else{
				if(!(fname.value.match(filter))){
					fname.style.borderColor = "Red"; 
					$('#card_contact_first_name').focus(); return false;
				}else{
					fname.style.borderColor = "green"; 
				}
			} 
			
			// Middle Name Validation  Contact Info 
			var mname = document.getElementById('card_contact_middle_name');
			if (mname.value != ''){
				if(!(mname.value.match(alpha_filter))){
					mname.style.borderColor = "Red"; 
					$('#card_contact_middle_name').focus(); return false;
				}else{
					mname.style.borderColor = "green"; 
				}
			}
			
			// Last Name Validation  Contact Info 
			var lname = document.getElementById('card_contact_last_name');
			if (lname.value == ''){
				lname.style.borderColor = "Red"; 
				$('#card_contact_last_name').focus();return false;
			}else{
				if(!(lname.value.match(alpha_filter))){
					lname.style.borderColor = "Red"; 
					$('#card_contact_last_name').focus(); return false;
				}else{
					lname.style.borderColor = "green"; 
				}
			} 
			
			// City Name Validation  Contact Info 
			var city = document.getElementById('card_contact_city');
			if (city.value == ''){
				city.style.borderColor = "Red"; 
				$('#card_contact_city').focus();return false;
			}else{
				if(!(city.value.match(alpha_filter))){
					city.style.borderColor = "Red"; 
					$('#card_contact_city').focus(); return false;
				}else{
					city.style.borderColor = "green"; 
				}
			} 
			// City Name validation  Contact Info 
			var zipcode = document.getElementById('card_contact_zipcode');
			if (zipcode.value == ''){
				zipcode.style.borderColor = "Red"; 
				$('#card_contact_zipcode').focus();return false;
			}else{
				if(!(zipcode.value.match(number_filter))){
					zipcode.style.borderColor = "Red"; 
					$('#card_contact_zipcode').focus(); return false;
				}else{
					zipcode.style.borderColor = "green"; 
				}
			} 
			
			// Phone Number validation  Contact Info 
			var CardHolderName = document.getElementById('CardHolderName');
			if (CardHolderName.value == ''){
				CardHolderName.style.borderColor = "Red"; 
				$('#CardHolderName').focus();return false;
			}else{
				if(!(CardHolderName.value.match(alpha_filter))){
					CardHolderName.style.borderColor = "Red"; 
					$('#CardHolderName').focus(); return false;
				}else{
					CardHolderName.style.borderColor = "green"; 
				}
			} 
			 
			// Mobile Number validation  Contact Info 
			var mobile = document.getElementById('CardNumber');
			if (mobile.value == ''){
				mobile.style.borderColor = "Red"; 
				$('#CardNumber').focus();return false;
			}else{
				
				if(validatecardnumber == false){
					mobile.style.borderColor = "Red"; 
					$('#CardNumber').focus();return false;
				}
				if(!(mobile.value.match(number_filter))){
					mobile.style.borderColor = "Red"; 
					$('#CardNumber').focus(); return false;
				}else{
					mobile.style.borderColor = "green"; 
				}
			} 
			
			var mobile = document.getElementById('CardSecurityCode');
			if (mobile.value == ''){
				mobile.style.borderColor = "Red"; 
				$('#CardSecurityCode').focus();return false;
			}else{
				if(!(mobile.value.match(number_filter))){
					mobile.style.borderColor = "Red"; 
					$('#CardSecurityCode').focus(); return false;
				}else{
					mobile.style.borderColor = "green"; 
				}
			} 
			
			var mobile = document.getElementById('CardExpireMonth');
			if (mobile.value == ''){
				mobile.style.borderColor = "Red"; 
				$('#CardExpireMonth').focus();return false;
			}else{
				mobile.style.borderColor = "green"; 
			} 
			
			var mobile = document.getElementById('CardExpireYear');
			if (mobile.value == ''){
				mobile.style.borderColor = "Red"; 
				$('#CardExpireYear').focus();return false;
			}else{
				mobile.style.borderColor = "green"; 
			} 
			
			$.ajax({
				type	: "POST",
				url		: '<?php echo site_url(); ?>booking/save_traveller_info',
				data	: $('#passenger_details').serialize(),
				dataType: "json",
				beforeSend:function(){
					$('#payment_info').css('display','none');
					$('#payment_loader').css('display','block');
				},
				success: function(data){
					window.location.href = data.booking_url;
				}					
			});
		});	
		<?php for($i=0;$i<count($results);$i++){ $searchdata = json_decode(base64_decode($search_data[$i]));  $Passenegrcount = $searchdata[0]->adult + $searchdata[0]->child + $searchdata[0]->infant; $ADT = 0; $CHD = 0; $INF = 0; 
		for($a=0;$a<$Passenegrcount;$a++){ 
			if($a < $searchdata[0]->adult){
				$name = 'adult'; $p = ++$ADT;
			}else if($a >= $searchdata[0]->adult && ($a < ($searchdata[0]->adult + $searchdata[0]->child))){
				$name = 'child'; $p = ++$CHD;
			}
			elseif($a >= ($searchdata[0]->adult + $searchdata[0]->child)){
				$name = 'infant'; $p = ++$INF;
			} 
			if($name == "child"){ ?>				
				$("#dob<?php echo $name.$p ?>").datepicker({
					numberOfMonths: 1,
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					minDate: '-12Y',
					maxDate: '-2Y'
				});
			<?php  } else if($name == "infant"){ ?>
				$("#dob<?php echo $name.$p ?>").datepicker({
					numberOfMonths: 1,
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					minDate: '-2Y',
					maxDate: '-1M'
				});
  		  <?php }else{ ?> 
			  $("#dob<?php echo $name.$p ?>").datepicker({
					numberOfMonths: 1,
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					yearRange: "-120:-10",
					minDate: '-120Y',
					maxDate: '-10Y',
				});
		  <?php }}} ?>	
	});
	
	function get_userinfo_by_email(email,url){
		var email_filter 	= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(email != ''){
			if(!(email.match(email_filter))){}else{
				$.ajax({
					type: "POST",
					url: url ,
					data: { email: email}
				}).done(function( msg ) {
					var msg	= eval('(' + msg + ')');
					document.getElementById('contact_first_name').value	 = msg.fname;
					document.getElementById('contact_middle_name').value = msg.mname;
					document.getElementById('contact_last_name').value	 = msg.lname;
					document.getElementById('contact_zipcode').value	 = msg.postal_code;
					document.getElementById('contact_city').value		 = msg.city;
					document.getElementById('contact_state').value		 = msg.state;
					document.getElementById('phone_number').value	 	 = msg.phone_number;
					document.getElementById('mobile_number').value		 = msg.mobile_no;
				});
			}
		}
		
	}
	
	function validate_traveller_info(){
		var email_filter 	= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var number_filter 	= /^[0-9]+$/; 
		var alpha_filter 	= /^[a-zA-Z]+$/; 
		// Email Validation for Contact Info
		var sEmail = document.getElementById('contact_email');
		if (sEmail.value == ''){
			sEmail.style.borderColor = "Red"; 
			$('#contact_email').focus(); return false;
		}else{
			if(!(sEmail.value.match(email_filter))){
				sEmail.style.borderColor = "Red"; 
				$('#contact_email').focus(); return false;
			}else{
				sEmail.style.borderColor = "green"; 
			}
		}
		
		// First Name Validation  Contact Info
		var fname = document.getElementById('contact_first_name');
		var filter = /^[0-9a-zA-Z]+$/; 
		if (fname.value == ''){
			fname.style.borderColor = "Red"; 
			$('#contact_first_name').focus(); return false;
		}else{
			if(!(fname.value.match(filter))){
				fname.style.borderColor = "Red"; 
				$('#contact_first_name').focus(); return false;
			}else{
				fname.style.borderColor = "green"; 
			}
		} 
		
		// Middle Name Validation  Contact Info 
		var mname = document.getElementById('contact_middle_name');
		if(mname.value !=''){
			if(!(mname.value.match(alpha_filter))){
				mname.style.borderColor = "Red"; 
				$('#contact_middle_name').focus(); return false;
			}else{
				mname.style.borderColor = "green"; 
			}
		}
		
		// Last Name Validation  Contact Info 
		var lname = document.getElementById('contact_last_name');
		if (lname.value == ''){
			lname.style.borderColor = "Red"; 
			$('#contact_last_name').focus();return false;
		}else{
			if(!(lname.value.match(alpha_filter))){
				lname.style.borderColor = "Red"; 
				$('#contact_last_name').focus(); return false;
			}else{
				lname.style.borderColor = "green"; 
			}
		} 
		
		// City Name Validation  Contact Info 
		var city = document.getElementById('contact_city');
		if (city.value == ''){
			city.style.borderColor = "Red"; 
			$('#contact_city').focus();return false;
		}else{
			if(!(city.value.match(alpha_filter))){
				city.style.borderColor = "Red"; 
				$('#contact_city').focus(); return false;
			}else{
				city.style.borderColor = "green"; 
			}
		} 
		// City Name validation  Contact Info 
		var zipcode = document.getElementById('contact_zipcode');
		if (zipcode.value == ''){
			zipcode.style.borderColor = "Red"; 
			$('#contact_zipcode').focus();return false;
		}else{
			if(!(zipcode.value.match(number_filter))){
				zipcode.style.borderColor = "Red"; 
				$('#contact_zipcode').focus(); return false;
			}else{
				zipcode.style.borderColor = "green"; 
			}
		} 
		
		// Phone Number validation  Contact Info 
		var phone = document.getElementById('phone_number');
		if (phone.value == ''){
			phone.style.borderColor = "Red"; 
			$('#phone_number').focus();return false;
		}else{
			if(!(phone.value.match(number_filter))){
				phone.style.borderColor = "Red"; 
				$('#phone_number').focus(); return false;
			}else{
				phone.style.borderColor = "green"; 
			}
		} 
		 
		// Mobile Number validation  Contact Info 
		var mobile = document.getElementById('mobile_number');
		if (mobile.value == ''){
			mobile.style.borderColor = "Red"; 
			$('#mobile_number').focus();return false;
		}else{
			if(!(mobile.value.match(number_filter))){
				mobile.style.borderColor = "Red"; 
				$('#mobile_number').focus(); return false;
			}else{
				mobile.style.borderColor = "green"; 
			}
		} 		
		<?php 
		for($i=0;$i<count($results);$i++){ $searchdata = json_decode(base64_decode($search_data[$i])); $Passenegrcount = $searchdata[0]->adult + $searchdata[0]->child + $searchdata[0]->infant; $ADT = 0; $CHD = 0; $INF = 0; 
		for($a=0;$a<$Passenegrcount;$a++){ 
			if($a < $searchdata[0]->adult){
				$name = 'adult'; $p = ++$ADT;
			}else if($a >= $searchdata[0]->adult && ($a < ($searchdata[0]->adult + $searchdata[0]->child))){
				$name = 'child'; $p = ++$CHD;
			}
			elseif($a >= ($searchdata[0]->adult + $searchdata[0]->child)){
				$name = 'infant'; $p = ++$INF;
			} ?>
			var saladult 	= document.getElementsByName('sal<?php echo $name; ?>[]');
			var lname 		= document.getElementsByName('lname<?php echo $name; ?>[]');
			var fname 		= document.getElementsByName('fname<?php echo $name; ?>[]');
			for (var i = 0; i < <?php echo $p; ?>; i++){
				if (saladult[i].value == ''){
					saladult[i].style.borderColor = "Red"; return false;
				}else{
					saladult[i].style.borderColor = "green"; 
				}
				
				if (fname[i].value==''){
					fname[i].style.borderColor = "Red"; return false;
				}else if(!(fname[i].value.match(alpha_filter))){  
				   fname[i].style.borderColor = "Red";  return false;   
				}else{
					fname[i].style.borderColor = "green"; 
				}
				
				if (lname[i].value==''){
					lname[i].style.borderColor = "Red"; return false;
				}else if(!(lname[i].value.match(alpha_filter))){  
				   lname[i].style.borderColor = "Red";  return false;   
				}else{
					lname[i].style.borderColor = "green"; 
				}
			}
		<?php }}	?>			
		$(this).parent('.rondsts').addClass('active');
		$('#stepbk1,#stepbk2').parent('.rondsts').addClass('success');
		$('.bktab1, .bktab2').fadeOut(500,function(){$('.bktab3').fadeIn(500)});
	}
</script> 
