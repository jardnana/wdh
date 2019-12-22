<?php

class General_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_default_module(){
		$this->db->select('*');
		$this->db->from('default_module');
		$this->db->where('default_module_status','Active');
		$this->db->order_by('default_module_order');
		$module = $this->db->get();
		if($module->num_rows > 0) 
        {
            $result = $module->result();
            foreach($result as $row)
            {
				$this->db->select('*');
				$this->db->from('default_module_details');
				$this->db->where('default_module_id',$row->default_module_id);
				$this->db->where('default_module_details_status','Active');
				$this->db->order_by('default_module_details_order');
				$module_details = $this->db->get();
				$final_result[($row->default_module_id)]['default_name']=$row->default_module_name;
				$final_result[($row->default_module_id)]['default_icon']=$row->default_module_link ;
				$final_result[($row->default_module_id)]['default_details']=$module_details->result_array();
			}
			//echo '<pre/>';print_r($final_result);exit;
			return $final_result;
        }		
        else
			return '';
	}
    function get_left_menu_details_working()
    {
		$this->db->select('*');
		$this->db->from('dashboard_module');
		$this->db->where('status','Active');
		$this->db->order_by('position');
		$module = $this->db->get();
		if($module->num_rows > 0) 
        {
            $result = $module->result();
            foreach($result as $row)
            {
				$this->db->select('*');
				$this->db->from('dashboard_module_details');
				$this->db->where('module_id',$row->module_id);
				$this->db->where('module_details_status','Active');
				$this->db->order_by('module_details_order');
				$module_details = $this->db->get();
				$final_result[($row->dashboard_module_id)]['dashboard_name']=$row->dashboard_module_name;
				$final_result[($row->dashboard_module_id)]['dashboard_icon']=$row->icon ;
				$final_result[($row->dashboard_module_id)]['dashboard_details']=$module_details->result_array();
			}
			// echo '<pre/>';print_r($final_result);exit;
			return $final_result;
        }		
        else
			return '';
	}
    public function get_hotel_cities_list($term) {
        $this->db->like('city', $term);
        $this->db->order_by("city", "asc");
        $this->db->limit(10);
        return $this->db->get('hotelbeds_cities');
    }

	public function get_hotel_cities_polish($term) {
        $this->db->like('city_polish', $term);
        $this->db->order_by("city_polish", "asc");
        $this->db->limit(10);
        return $this->db->get('hotelbeds_cities_polish');
    }
    
    public function address_countries() {
        $this->db->distinct();
        $this->db->select('country_id,country_name,iso_code');
        $this->db->order_by('country_name', 'asc');
        $query = $this->db->get('country_details');
        return $query;
    }

    public function country_telecode_list() {
        $que = "SELECT * , SUBSTR( phone_code, 2 ) AS phone FROM country_details ORDER BY CAST( phone AS UNSIGNED )";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function load_countries() {
        $this->db->distinct();
        $this->db->select('countryName,countryCode');
        $this->db->order_by('countryName', 'asc');
        $query = $this->db->get('hotelbeds_cities');
        return $query;
    }

    public function load_cities($country_code) {
        $this->db->select('cityName,cityCode');
        if ($country_code != '') {
            $this->db->where('countryCode', $country_code);
        }
        $this->db->order_by('cityName', 'asc');
        $query = $this->db->get('hotelbeds_cities');
        return $query;
    }

    public function get_city_terminals($city) {
        $query = $this->db->query("SELECT b.code, b.name
                                    FROM hotelbeds_terminal_transfer_zones AS a
                                    LEFT OUTER JOIN hotelbeds_terminal AS b ON a.terminal_code = b.code
                                    WHERE a.destination_code = '$city'
                                    GROUP BY a.terminal_code
                                    ORDER BY b.name ASC");
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else
            return '';
    }

    function get_terminal_hotels($terminal_code) {
        $this->db->select('t.hotel_code as hotel_code,h.Name as hotel_name');
        $this->db->from('hotelbeds_hotel_terminals t');
        $this->db->join('hotelbeds_Hotels h', 't.hotel_code = h.HotelCode');
        $this->db->where('t.terminal_code', $terminal_code);
		
        $query = $this->db->get();
		
        $this->load->database('default', TRUE);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function insert_cart_global($cart_global) {
        $this->db->insert('cart_global', $cart_global);
        return $this->db->insert_id();
    }

    public function getCartData($session_id) {
        $this->db->where('session_id', $session_id);
        return $this->db->get('cart_global');
    }

    public function getCartDataByModule($cart_id, $module = '') {
        if ($module == 'SIGHTSEEN') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_sightseen', 'cart_sightseen.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
        }
        if ($module == 'HOTEL') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_hotel', 'cart_hotel.shopping_cart_hotel_id = cart_global.ref_id');
            return $this->db->get('cart_global');
        }
		if ($module == 'TRANSFER') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_transfer', 'cart_transfer.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
        }
    }
    
    public function clearCart($cart_id = '', $session_id = ''){
		//$this->db->select('ref_id, cart_id','module');
         if($session_id!=''){
			$this->db->where('session_id',$session_id);
		} else {
			if($cart_id!=''){
				$this->db->where('cart_id',$cart_id);
			}
		}
        $data 	= $this->db->get('cart_global')->result();
        //echo "<pre/>";print_r($data);exit;
		$ref_id = $data[0]->ref_id;
		$cart_id1 = $data[0]->cart_id;
		$module = $data[0]->module;
		if($module == 'SIGHTSEEN'){
			$this->db->where('ID',$ref_id);
			$this->db->delete('cart_sightseen');
        } else if($module == 'HOTEL'){
			$this->db->where('shopping_cart_hotel_id',$ref_id);
			$this->db->delete('cart_hotel');
		} else if($module == 'TRANSFER'){
			$this->db->where('ID',$ref_id);
			$this->db->delete('cart_transfer');
		} else { }
		$this->db->where('cart_id',$cart_id1);
		$this->db->delete('cart_global');
	}
	
	public function Booking_Global($booking){
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }
    
    public function Update_Booking_Global($booking_temp_id, $update_booking, $module){
        $this->db->where('id',$booking_temp_id);
		$this->db->where('module',$module);
        $this->db->update('booking_global', $update_booking);
    }
    public function Update_Cancellation_Global($booking_no, $update_booking, $module){
		
			$this->db->where('booking_no',$booking_no);
			$this->db->where('module',$module);
			$this->db->update('booking_global', $update_booking);
    }

    public function Update_hotel_Cancellation_Global($ref_id, $update_booking, $module){
		
			$this->db->where('ref_id',$ref_id);
			$this->db->where('module',$module);
			$this->db->update('booking_global', $update_booking);
    }

     public function get_hotel_Cancelled_Global_bookingno($ref_id, $module){
		
			$this->db->where('ref_id',$ref_id);
			$this->db->where('module',$module);
			$this->db->select('booking_no');
			$this->db->from('booking_global');
			$query = $this->db->get();
			if ($query->num_rows() =='') {
            return '';
        	}
        	else{
        	    return $query->row();
        	}
    }
    
    public function validate_order_id_org($order_id='', $globalid=''){
		if($order_id!=''){
			$this->db->where('parent_pnr',$order_id);
		} if($globalid!=''){
			$this->db->where('id',$globalid);
		}
		return $this->db->get('booking_global');
	}
    public function validate_booking_no_org($booking_no=''){
		if($booking_no!=''){
			$this->db->where('booking_no',$booking_no);
		}
		return $this->db->get('booking_global');
	}
	
	public function getBookingbyPnr($pnr_no,$module){
		if($module == 'SIGHTSEEN'){
			$this->db->join('booking_sightseen','booking_global.ref_id = booking_sightseen.booking_sightseen_id');
		}
		if($module == 'TRANSFER'){
			$this->db->join('booking_transfer','booking_global.ref_id = booking_transfer.booking_transfer_id');
		}
		if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.id');
		}
		if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.ref_id = booking_flight.id');
			$this->db->join('cart_flight','booking_flight.cart_id = cart_flight.id');
		}
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
	public function getBookingbynumber($booking_bo,$module){
		if($module == 'SIGHTSEEN'){
			$this->db->join('booking_sightseen','booking_global.ref_id = booking_sightseen.booking_sightseen_id');
		}
		if($module == 'TRANSFER'){
			$this->db->join('booking_transfer','booking_global.ref_id = booking_transfer.booking_transfer_id');
		}
		if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.id');
		}
		if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.ref_id = booking_flight.id');
			$this->db->join('cart_flight','booking_flight.cart_id = cart_flight.id');
		}
		$this->db->where('booking_no',$booking_bo);
        return $this->db->get('booking_global');
    }
    
    function get_left_menu_details(){
		$this->db->select('*');
		$this->db->from('dashboard_module');
		$this->db->where('status','ACTIVE');
		$this->db->order_by('position');
		$module = $this->db->get();
		if($module->num_rows > 0) {
            $result = $module->result();
            foreach($result as $row){
				$this->db->select('*');
				$this->db->from('dashboard_module_details');
				$this->db->where('module_id',$row->module_id);
				$this->db->where('module_details_status','Active');
				$this->db->order_by('module_details_order');
				$module_details = $this->db->get();
				$final_result[($row->module_id)]['dashboard_name']=$row->module_name;
				$final_result[($row->module_id)]['dashboard_icon']=$row->icon ;
				$final_result[($row->module_id)]['dashboard_details']=$module_details->result_array();
			}
			// echo '<pre/>sds';print_r($final_result);exit;
			return $final_result;
        }		
        else return '';
	}

	public function get_home_page_settings(){
		// $colors 				= array('black','blue','cafe','purple','red','white','yellow');
		$colors 				= array('');
		$color_key 				= array_rand($colors, 1);
		$data['color'] 			= $colors[$color_key];
		
		$transitions 			= array('page-left-in','page-right-in','page-fade','page-fade-only');
		$transition_key 		= array_rand($transitions, 1);
		$data['transition'] 	= $transitions[$transition_key];
		
		// $headers				= array('header_left','header_top','header_right');
		$headers				= array('header_left');
		$header_key 		    = array_rand($headers, 1);
		$data['header'] 	    = $headers[$header_key];
		$data['header'] 	    = $headers[$header_key];
		// $data['sidebar'] 	    = "sidebar-collapsed";
		$data['sidebar'] 	    = "";
		
		return $data;
	}

	public function get_country_details($country_id = ''){
		$this->db->select('*');
		$this->db->from('country_details');
		if($country_id !='')
			$this->db->where('country_id', $country_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		} else {
			return $query->result();
		}
	}
	function get_state_info($country_id){
		$que="select state_details_id, country_id,state_name from state_details where country_id = '".$country_id."' GROUP BY state_name";
		$query= $this->db->query($que);
		if($query->num_rows() ==''){
			return '';
		} else {
			return $query->result();
		}
	}
	
	public function get_currency_list($id = '', $currency = ''){
		$this->db->select('*');
		if($id!=''){
			$this->db->where('cur_id',$id);
		} if($currency != ''){
			$this->db->where('currency_name',$currency);
		}
		$query = $this->db->get('currency_converter_usd');
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
	}
	// Begin Transcation
	function begin_transaction(){
		$this->db->trans_begin();
	}

	function commit_transaction(){
		$this->db->trans_commit();
	}

	function rollback_transaction(){
		$this->db->trans_commit();
	} 
	function address(){
		$this->db->select('*');
		$this->db->from('contact_detail');
		$this->db->where('site_title','Contacts');
		$this->db->where('status','ACTIVE');
		return $this->db->get();
	}
	public function getCityName($value)
	{
		$this->db->select('airport_city');
		$this->db->from('flight_airport_list');
		$this->db->where('airport_code',$value);
		return $this->db->get()->row();
	}
	public function get_bookings($module, $datestr){
		$fromdate = $datestr.'-01';
		$todate = $datestr.'-31';
		$que="select * from booking_global where booking_date between '".$fromdate."' and '".$todate."'";
		$query= $this->db->query($que);
		if($query->num_rows() ==''){
			return '0';
		} else {
			return $query->num_rows();
		}
	}
	function insert_log($value_id,$activity,$data,$description,$table_name,$table_column_name,$id)
	{
		$log_data['session_id'] = $this->session->userdata('session_id');
		$log_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
		$log_data['user_id'] = $this->session->userdata('provab_admin_id');
		$log_data['module_id'] = $value_id;
		$log_data['function_name'] = $activity;
		$log_data['function_description'] = $description;
		$log_data['data_manipulation'] = $data;
		$log_data['system_browser_info'] =  $_SERVER['HTTP_USER_AGENT'];
		$log_data['system_info'] =  $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT'];
		$log_data['created_date'] = date('Y-m-d H:i:s');
		$log_data['function_reference_name'] = $table_name;
		$log_data['function_reference_field'] = $table_column_name;
		$log_data['function_record_id'] = $id;
		try{
	    $this->begin_transaction();
		$this->db->insert('log_history',$log_data);
		$this->commit_transaction();
	} catch(Exception $e) {
		$this->rollback_transaction();
		return $e;
	}
	}
	
	public function get_api($api,$api_usage = ''){
		$this->db->where('api_name', $api);
		if($api_usage!=''){
			$this->db->where('api_credential_type', $api_usage);
		} else {
			$this->db->where('api_credential_type', 'TEST');
		}
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get('api_details');
        return $query;
	}
	
	 public function getBookingSightTemp($booking_cart_id){
        $this->db->where('booking_sightseen_id',$booking_cart_id);
        return $this->db->get('booking_sightseen');
    }
    public function getBookingTransferTemp($booking_cart_id){
        $this->db->where('booking_transfer_id',$booking_cart_id);
        return $this->db->get('booking_transfer');
    }
    public function get_contact_address(){
		$this->db->select('contact_address, contact_number, email_address');
		$this->db->from('general_settings');
		$query = $this->db->get();
		if ($query->num_rows > 0) 
		{
           return $query->result();
		} else return '';
	}
	public function get_ExcursionBooking_det($id){
		$this->db->where('booking_sightseen_id',$id);
		return $this->db->get(' booking_sightseen');
	}

	public function validate_refid_no_org($pnr_no=''){
        if($pnr_no!=''){
            $this->db->where('pnr_no',$pnr_no);
        }
        return $this->db->get('booking_global');
    }
     public function get_contact_messages_list($id=''){
   		$this->db->select('*');
   		if($id!=''){
			$this->db->where('contact_messages_id', $id);
		}
   		$this->db->order_by('contact_messages_id','desc');
   		$this->db->from('contact_messages');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
   }
   public function delete_query($id){
		$this->db->trans_start();
		$this->db->where('contact_messages_id', $id);
		$this->db->delete('contact_messages'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	
	public function get_subscription_list($id=''){
   		$this->db->select('*');
   		if($id!=''){
			$this->db->where('subscriber_details_id', $id);
		}
		$this->db->where('status', 'ACTIVE');
   		$this->db->order_by('subscriber_details_id','desc');
   		$this->db->from('subscriber_details');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
   }
	public function get_subscribers($check){
   		$this->db->select('*');
   		if($check==2){
			$this->db->where('subscriber_language', 'English');
		} else if($check==3){
			$this->db->where('subscriber_language', 'Polish');
		}
		$this->db->where('status', 'ACTIVE');
   		$this->db->order_by('subscriber_details_id','desc');
   		$this->db->from('subscriber_details');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
   }
   
   public function update_contact_info($update, $id){
		$this->db->where('contact_messages_id', $id);
		$this->db->update('contact_messages', $update);
   }
   
   public function delete_subscriber($update, $id){
		$this->db->where('subscriber_details_id', $id);
		$this->db->update('subscriber_details', $update); 
		return true;
	}
	public function get_subscriber_template_details($templatelike){
		$this->db->select('*');
		$this->db->from('email_template');
		$this->db->like('email_type',$templatelike);
		$query = $this->db->get();
		if($query->num_rows > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	public function check_subscriber($email){
		$this->db->select('*');
		$this->db->from('subscriber_details');
		$this->db->where('email_id',$email);
		$this->db->where('status','ACTIVE');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->row();				
		}
	}
	public function add_subscriber($email, $username, $userlang){
		$data =	array(
					'email_id' => $email,
					'subscriber_name' => $username,
					'subscriber_language' => $userlang,
					'status' => 'ACTIVE',
					'creation_date'		=> (date('Y-m-d H:i:s'))	
				);
		$this->db->insert('subscriber_details',$data);
		$id=$this->db->insert_id();
		return $id;
   }
   
   
	function get_static_content_details($content_title){
		$this->db->select("*")->from('static_content_details');
		$this->db->where('content_title',$content_title);	
		$this->db->where('status','ACTIVE');	
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
	    }else{
			return $query->row();
		}
	}
}
