<?php $module_status   = $this->General_Model->get_module_status('1','TOP_HEADER'); if($module_status > 0){ ?>
<div class="topssec">
  <div class="container">
    <div class="rowmino">
      <div class="col-lg-12 nopadding">
       <?php $top_header_list   = $this->General_Model->get_top_header_list(); if($top_header_list != ''){ ?>
        <div class="col-lg-4 nopad contactonlynone">
          <?php  foreach($top_header_list as $name){ if($name->header_name == "Customer_support"){ ?><div class="contactonly"> Call the customer support <?php echo $this->General_Model->get_customer_support_number(); ?> </div> <?php }} ?>
        </div>
		<div class="col-lg-8 nopad">
          <?php foreach($top_header_list as $name){ 
				if($name->header_name == "LoginRegister"){ if ($this->session->userdata('b2c_details_id')) { 
					  $b2c_data = $this->Account_Model->getUserInfo($this->session->userdata('b2c_details_id'))->row();
					  if(count($b2c_data) > 0){ 
						  if($b2c_data->user_profile_pic == ''){
							$profile_photo = base_url().'assets/images/user-avatar.jpg';
						  }else{
							$profile_photo = $b2c_data->user_profile_pic;
						  }
					  }
					  $current_url = $this->config->site_url().$this->uri->uri_string(). ($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '');
					  $current_url = base64_encode($current_url); ?>
					  <div class="wrapofa">
						<div class="sct">
							<a href="#" class="topa dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
							<ul class="dropdown-menu">
							  <li> <a href="<?php echo base_url(); ?>profile"> Profile</a> </li>
							  <li> <a class="fadeandscalechange_open forgota">Change Password</a> </li>
							  <li> <a href="<?php echo base_url(); ?>account/logout">Sign out</a> </li>
							</ul>
						</div>                  
					</div> 
                <?php }else{ ?><div class="wrapofa"> <a class="topa fadeandscale_open">Login / Register</a> </div> <?php }} if($name->header_name == "Language"){  ?> 
					<div class="wrapofa"> 
						 <?php $language_list   = $this->General_Model->get_language_list(); if(count($language_list) > 0){ ?> 
						<a href="#" class="topa dropdown-toggle" data-toggle="dropdown"><?php echo $language_list[0]->langauge_name; ?> <b class="fa fa-chevron-down"></b></a>
						<ul class="dropdown-menu">
							<?php for($l=0;$l<count($language_list);$l++){ ?>
								<li> <a href=""><?php echo $language_list[$l]->langauge_name; ?></a> </li>
							<?php } ?>
						</ul>
						<?php } ?>
					  </div>
			<?php }} ?>
          <?php foreach($top_header_list as $name){ if($name->header_name == "Currency"){ ?> 
          <div class="wrapofa currency"> 
			<?php $currency_list   = $this->General_Model->get_currency_list(); if(count($currency_list) > 0){ ?> 
			<a href="#" class="topa dropdown-toggle" data-toggle="dropdown"><?php echo BASE_CURRENCY; ?> <b class="fa fa-chevron-down"></b></a>
			<ul class="dropdown-menu curncyli">
				<div class="col-xs-12">
                  <input type="text" id="currency" name="currency" placeholder="Search" class="form-control" autocomplete="off" />
                </div>
				<?php for($c=0;$c<count($currency_list);$c++){ if($currency_list[$c]->currency_code !=''){ ?>
					<li <?php if(BASE_CURRENCY == $currency_list[$c]->currency_code){ ?>class="selected active"<?php } ?>> <a href="" data-code="<?php echo $currency_list[$c]->currency_code; ?>" data-icon="<?php echo $currency_list[$c]->country_name; ?>"><?php echo $currency_list[$c]->currency_code." - ".$currency_list[$c]->currency_name; ?></a> </li>
				<?php }} ?>	
			</ul>
			 <?php } ?>
          </div>
        </div>
	   <?php }}} ?>	
      </div>
    </div>
  </div>
</div>
 <?php } ?>
<div class="clear"></div>
<?php $module_status   = $this->General_Model->get_module_status('1','HEADER'); if($module_status != ''){ ?>
<nav class="navbar colorwhite navme" role="navigation">
  <div class="container tophedsectn">
	<div class="navbar-header myheder"> <a class="mylogo" href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/<?php echo $this->General_Model->get_logo_details(); ?>" alt="" /></a> </div>
	<?php $header_list  = $this->General_Model->get_header_list(); if($header_list!=''){  ?>
		<div class="sidall">		  
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		  <div class="topmenu">
			<div class="collapse mytmenu navbar-collapse nopad" id="bs-example-navbar-collapse-1">
			  <ul class="nav menunav navbar-nav myhomemenu">
			   <?php $h = 0; foreach($header_list as $header){ $h++;?>
				<li class="<?php if($h == 1){ ?> active <?php } ?>"><a href="<?php if($header->link_type == "INTERNAL"){ echo site_url().$header->link; }else{ echo site_url().$header->link; } ?>"><?php echo $header->header_name; ?></a> </li>
				<?php } ?>
			  </ul>
			</div>
		  </div>
		</div>
	<?php } ?>
  </div>
</nav>
<div class="clear"></div>	
<?php } ?>

<?php $module_status   = $this->General_Model->get_module_status('1','TOP_HEADER'); if($module_status > 0){ if($top_header_list != ''){ foreach($top_header_list as $name){ if($name->header_name == "LoginRegister"){  ?>
<div id="fadeandscalechange" class="wellme" style="display:none;">
	<div class="pophdng arimobold">Change Password</div>
	<div class="popuperror" id="chnagepwd_popuperror" style="display: none;" ></div>
		<div class="insigndiv">
		<form  name="forgetpwd" id="chnagepwd" method="post" action="<?php echo base_url(); ?>account/update_pwd">
			<div class="ritpul">
				<div class="rowput">
					<span class="fa fa-envelope"></span>
					<input class="form-control logpadding" type="password" name="current_pwd" placeholder="Your Current Password"  minlength="5" maxlength="50" required>
				</div>
				<div class="rowput">
					<span class="fa fa-envelope"></span>
					<input class="form-control logpadding" type="password" name="new_pwd" id="new_pwd_value" placeholder="New Password " minlength="5" maxlength="50" required>
					<div class="errMsg"></div>
				</div>
				<div class="rowput">
					<span class="fa fa-envelope"></span>
					<input class="form-control logpadding" type="password" name="new_confirom_pwd" id="new_confirom_pwd" placeholder="Confirom Password " maxlength="50" required>
				</div>
				<div class="clear"></div>
				<button class="submitlogin">Update</button>
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>
	
<!-- forgot pwd -->
<div id="fadeandscaleforget" class="wellme">
		<div class="pophdng arimobold">Reset Password</div>
		<div class="popuperror" id="forgetpwd_popuperror" style="display: none;" ></div>
		<div class="insigndiv">
		<div class="formcontnt">Enter the email address associated with your account, and we'll email you a link to reset your password.</div>
		<form id="forgetpwd" name="forgetpwd" method="post" action="<?php echo base_url(); ?>account/forgetpwd">
			<div id="forgetpwd_loader" class="lodrefrentrev imgLoader"><div class="centerload"></div></div>
			<div class="ritpul">
				<div class="rowput">
					<span class="fa fa-envelope"></span>
					<input class="form-control logpadding" type="email" name="email" placeholder="Your email" minlength="5" maxlength="50" required>
				</div>
				<div class="clear"></div>
				<button class="submitlogin">Send Reset Link</button>
				<div class="clear"></div>
				<div class="dntacnt">Suddenly remember password? <a class="fadeandscaleforget_close fadeandscale_open">Sign in</a> 
				</div>
			</div>
		</form>
	</div>
</div>	
<div id="fadeandscale" class="wellme">
  <div class="signdiv">    
    <div class="pophdng arimobold">Sign In</div>
    <div class="insigndiv">
	<form id="login" name="login" action="<?php echo site_url();?>account/login" autocomplete="off">
      <div id="login_loader" class="lodrefrentrev imgLoader"><div class="centerload"></div></div>
      <div class="popuperror" style="display: none;" id="login_popuperror"></div>
      <div class="ritpul">
        <div class="rowput"> <span class="fa fa-user"></span>
          <input class="form-control logpadding" type="email" name="email" autocomplete="off" required  placeholder="Username">
        </div>
        <div class="rowput"> <span class="fa fa-lock"></span>
          <input class="form-control logpadding" id="pswd" type="password" name="password" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="misclog"> <a class="rember">
          <input type="checkbox" />
          Remember me</a> <a class="forgtpsw fadeandscale_close fadeandscaleforget_open forgota">Forgot password?</a> </div>
        <div class="clear"></div>
        <button class="submitlogin">Login</button>
        <div class="clear"></div>
        <div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>
      </div>
    </form>
    </div>
  </div>
</div>
<div id="fadeandscalereg" class="wellme">
  <div class="signdiv">
    <div class="pophdng arimobold">Sign Up</div>
    <div class="insigndiv">
      <a class="logspecify mymail"> <span class="fa fa-envelope"></span>
      <div class="mensionsoc">Sign up with email</div>
      </a>
      <form id="registration" name="registration" action="<?php echo site_url();?>account/create">      
      <div id="registration_loader" class="lodrefrentrev imgLoader"><div class="centerload"></div></div>
      <div class="signupul">
        <div class="rowput"> <span class="fa fa-user"></span>
          <input class="form-control logpadding" type="text" placeholder="First name" name="fname" minlength="3" required>
        </div>
        <div class="rowput"> <span class="fa fa-user"></span>
          <input class="form-control logpadding" type="text" name="lname" placeholder="Last name" minlength="1" required>
        </div>
        <div class="rowput"> <span class="fa fa-envelope"></span>
          <input class="form-control logpadding" type="email" name="email" placeholder="Your email" required>
        </div>
        <div class="rowput"> <span class="fa fa-lock"></span>
          <input class="form-control logpadding" type="password" name="password" id="password" placeholder="Password" minlength="5" maxlength="50" required>
        </div>
        <div class="rowput"> <span class="fa fa-lock"></span>
          <input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm password" required>
        </div>
        <div class="rowput"> <span class="fa fa-user"></span>
            <input class="form-control logpadding" type="text" placeholder="contact Number" name="contact_no" minlength="4" maxlength="10" required>
          </div>
        <!--<div class="misclog"> <a class="rember"> <input type="checkbox" /></a> </div><div class="clear"></div>-->
        <div class="signupterms"> By signing up, I agree to Utravel <a>Terms of Service</a>,<a> Privacy Policy</a>, <a>Guest Refund Policy</a>, and <a>Host Guarantee Terms</a>. </div>
        <div class="clear"></div>
        <button class="submitlogin">Sign up</button>
      </div>
     </form>
      <div class="clear"></div>
      <div class="dntacnt">Don't have an account? <a class="fadeandscalereg_close fadeandscale_open">Sign in</a> </div>
    </div>
	
  </div>
</div>
<?php }}}} ?> 

<script>
	$(document).ready(function(){
		$('body').on('keyup','#currency',function(){
			var lists = $('.dropdown-menu.curncyli li'),datacodes=[];
			var filter = $(this).val(), count = 0;        
			var regex = new RegExp(filter, "i");        
			$(lists).each(function(){           
				if ($(this).find('a').attr('data-code').search(regex) < 0) { 
					 $(this).hide();         
				}else{
					count++;
					$(this).show();
				}            
			});
		});
	});
	function ChangeCurrency(that){
		var code = $(that).data('code');
		var icon = $(that).data('icon');
		//$('.currencychange').hide();
		var data = {};
		data['code'] = code;
		data['icon'] = icon;
		$.ajax({
		  type: 'POST',
		  url: '<?php echo base_url(); ?>home/change_currency',
		  async: true,
		  dataType: 'json',
		  data: data,
		  success: function(data) {
			location.reload();
			}		
		});
	  }		
</script> 
