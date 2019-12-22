<?php 
	
function get_images_tag($mgurl,$path){
	$image_url = explode(",",$mgurl);
	$imagesLink = "";
	for($m=0;$m<count($image_url);$m++){
		$imagesLink .='<img width="100" height="100" src="'.site_url('images/view_image_tag/').'/'.base64_encode(json_encode($path.'/'.$image_url[$m])).'" />';
		// $imagesLink .='<img width="100" height="100" src="'.SITE_URL.$path.'/'.$image_url[$m].'" />';
	}
    return $imagesLink;
}

function get_contact_us_image($image_link){
	if($image_link!=''){
		$image_path = '<img class="userphoto" src="'.site_url('images/view_admin_image/').'/'.base64_encode(json_encode('contactus/'.$image_link)).'">';
		if(false){
		// if(!@getimagesize(site_url('images/view_admin_image/').'/'.base64_encode(json_encode('contactus/'.$image_link)))){
			$image_path='<img class="userphoto" src="'.site_url('images/view_theme_image/').'/'.base64_encode(json_encode('images/profile-male.jpg')).'">';        //if image not found this will display
		}
		return $image_path;
	}else{	
		$image_path='<img class="userphoto" src="'.site_url('images/view_theme_image/').'/'.base64_encode(json_encode('images/profile-male.jpg')).'">';
		return $image_path;
	}
}

function get_contact_us_employee_role($employee_role_id){
	$ci 		= & get_instance();
	$employee_role = $ci->General_Model->get_contact_us_employee_role_name($employee_role_id);
	return $employee_role[0]->employee_role_name;
}

function get_users_image($image_link){
	if($image_link!=''){
		$image_path = '<img class="userphoto" src="'.site_url('uploads/user/profile').'/'.$image_link.'">';
		return $image_path;
	}else {	
		$image_path='<img class="userphoto" src="'.site_url('uploads/user/default.jpg').'">';
		return $image_path;
	}
}
function get_product_image($image_link){
	if($image_link!=''){
		$co=json_decode($image_link);
		$image_path = '<img class="userphoto" src="'.site_url('uploads/product').'/'.$co[0].'">';
		return $image_path;
	}else {	
		$image_path='<img class="userphoto" src="'.site_url('uploads/user/default.jpg').'">';
		return $image_path;
	}
}
function get_store_image($image_link){
	if($image_link!=''){
		$co=json_decode($image_link);
		$image_path = '<img class="userphoto" src="'.site_url('uploads/store').'/'.$co[0].'">';
		return $image_path;
	}else {	
		$image_path='<img class="userphoto" src="'.site_url('uploads/user/default.jpg').'">';
		return $image_path;
	}
}
function get_category_image($image_link){
	if($image_link!=''){
		$co=json_decode($image_link);
		$image_path = '<img class="userphoto" src="'.site_url('uploads/category').'/'.$co[0].'">';
		return $image_path;
	}else {	
		$image_path='<img class="userphoto" src="'.site_url('uploads/user/default.jpg').'">';
		return $image_path;
	}
}


function get_company_image($image_link){
	if($image_link!=''){
		$image_path = '<img class="userphoto" src="'.site_url('images/view_image/').'/'.base64_encode(json_encode('company/'.$image_link)).'">';
		if(!@getimagesize(site_url('images/view_image/').'/'.base64_encode(json_encode('company/'.$image_link)))){
			$image_path='<img class="userphoto" src="'.site_url('images/view_theme_image/').'/'.base64_encode(json_encode('images/profile-male.jpg')).'">';        //if image not found this will display
		}
		return $image_path;
	}else {	
		$image_path='<img class="userphoto" src="'.site_url('images/view_theme_image/').'/'.base64_encode(json_encode('images/profile-male.jpg')).'">';
		return $image_path;
	}
}

function get_company_logo($image_link){
	if($image_link!=''){
		$image_path = '<img class="userphoto" src="'.site_url('images/view_image/').'/'.base64_encode(json_encode('company/'.$image_link)).'">';
		if(!@getimagesize(site_url('images/view_image/').'/'.base64_encode(json_encode('company/'.$image_link)))){
			$image_path='';        //if image not found this will display
		}
		return $image_path;
	}else {	
		$image_path = '';
		return $image_path;
	}
}

function get_vehicle_images_tag($country_name,$city_name,$vehicle_type_id,$image_url){
	$imagesLink = "";
	$imagesLink .='<img width="100" height="100" src="'.site_url('images/view_theme_image/').'/'.base64_encode(json_encode('VehiclePictures/'.$country_name.'/'.$city_name.'/'.$vehicle_type_id.'/'.$image_url)).'" />';
    return $imagesLink;
}

function get_driver_icon_images($menu_icon){
	$imagesLink = "";
	$imagesLink .='<img src="'.site_url('images/view_image/').'/'.base64_encode(json_encode('driver_icons/'.$menu_icon)).'" />';
    return $imagesLink;
}

function get_driver_category_name($driver_type){
	if($driver_type == 'ADMIN'){ $category_name = 'COMMON'; }
	else if($driver_type == 'DISPATCH'){ $category_name = 'MOBILEAPP'; }
	else if($driver_type == 'SP'){ $category_name = 'ENHANCED'; }
	else{ $category_name = 'COMMON';}
	return $category_name." DRIVER";
}

function get_user_info($user_id,$user_type){
	$ci 		= & get_instance();
	$user_info = $ci->General_Model->get_user_info_form_helper($user_id,$user_type);
	if($user_type == "1"){ $name_prefix = "passenger_"; }else{ $name_prefix	= ''; }
	if($user_type == "1"){ $email = 'email_address'; }
	else if($user_type == "2"){ $email = 'email_address'; }
	else if($user_type == "3"){ $email = 'email_address';}
	else if($user_type == "4"){ $email = 'email';}
	else if($user_type == "5"){ $email = 'email_address';}
	else if($user_type == "6"){ $email = 'email_address';}
	else if($user_type == "8"){ $email = 'email_address';}
	else if($user_type == "7"){ $email = 'email_address';}	
	$first_name 	= $name_prefix."first_name";					
	$last_name 		= $name_prefix."last_name";
	$options = $user_info[0]->$first_name." ".$user_info[0]->$last_name." - ".$user_info[0]->$email;		
	return $options;	
}

function get_user_details($user_id,$user_type){
	$ci = & get_instance();
	if(($user_id == 'ALL' && $user_type == 'ALL') || $user_id == 'ALL'){
		return "ALL";
	}else{
		$user_info = $ci->Latestnews_Model->get_user_details_form_helper($user_id,$user_type);
		if($user_type =='ADMIN'){
			$first_name = "super_admin_name"; $id = "super_admin_id";	$email = 'super_admin_email';
			$options = $user_info[0]->$first_name." - ".$user_info[0]->$email;	
			return $options;			
		}else{
			if($user_type == "LP"){ $name_prefix = "passenger_"; }else{ $name_prefix	= ''; }
			if($user_type == "LP"){ $email = 'email_address'; }
			else if($user_type == "CA"){ $email = 'email_address'; }
			else if($user_type == "TC"){ $email = 'email_address';}
			else if($user_type == "CP"){ $email = 'email';}
			else if($user_type == "TD"){ $email = 'email_address';}
			else if($user_type == "TA"){ $email = 'email_address';}
			else if($user_type == "DM"){ $email = 'email_address';}
			else if($user_type == "SP"){ $email = 'email_address';}	
			$first_name 	= $name_prefix."first_name";					
			$last_name 		= $name_prefix."last_name";
			$options = $user_info[0]->$first_name." ".$user_info[0]->$last_name." - ".$user_info[0]->$email;		
			return $options;		
		}	
	}		
}

function get_user_info_by_type_name($user_id,$user_type){
	$ci = & get_instance();
	$user_info = $ci->General_Model->get_user_details_bytype_form_helper($user_id,$user_type);
	if($user_type =='ADMIN'){
		$first_name = "super_admin_name"; $id = "super_admin_id";	$email = 'super_admin_email';
		$options = $user_info[0]->$first_name." - ".$user_info[0]->$email;	
		return $options;			
	}else{
		if($user_type == "LP"){ $name_prefix = "passenger_"; }else{ $name_prefix	= ''; }
		
		$first_name 	= $name_prefix."first_name";					
		$last_name 		= $name_prefix."last_name";
		$options = $user_info[0]->$first_name." ".$user_info[0]->$last_name;		
		return $options;		
	}	
}
	
function get_singlevehicle_name($vehicleId){
	$ci = & get_instance();
	$ci->db->select('vehicle_type_name')->from('vehicle_type');
		if($vehicleId !='')
			$ci->db->where('vehicle_type_id',$vehicleId);
		$query = $ci->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			$dd = $query->row();
			return $dd->vehicle_type_name;
		}
}
function get_vechical_names($vehicleId){
	$ci = & get_instance();
	$vehicle_name ='';
	$vehicle_type_info = json_decode($vehicleId);
	for($v=0;$v<count($vehicle_type_info);$v++){ if($vehicle_type_info[$v] !=''){
		$ci->db->select('vehicle_type_name')->from('vehicle_type');
			if($vehicle_type_info[0] !='')
				$ci->db->where('vehicle_type_id',$vehicle_type_info[$v]);
			$query = $ci->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				$dd = $query->row();
				$vehicle_name .= $dd->vehicle_type_name.',';
			}
		}
	}
	return $vehicle_name;
}

function get_user_type_name($user_type_id){
	$ci = & get_instance();
	$ci->db->select('user_type_name')->from('user_type');
	$ci->db->where('user_type_id',$user_type_id);
	$query = $ci->db->get();
	if($query->num_rows() ==''){
		return '';
	}else{
		$dd = $query->row();
		return $dd->user_type_name;
	}
}
?>
