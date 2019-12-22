<?php
class Flight_Model extends CI_Model {
	function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->library('xml_to_array');
    }
    
 //    function insert_input_parameters($input){
	// 	// echo '<pre/>';print_r($input);exit;
	// 	if(!isset($input['flexible'])){
	// 		$input['flexible'] = 0;
	// 	}
	// 	$randId 		= $xmlName = $xmlId = $search_parameter = '';
	// 	$CurrentDate 	= date("Y-m-d"); 	$ip_address			= $_SERVER['REMOTE_ADDR'];
	// 	$inputQuery		= array('departure_city' => $input['from_city'], 'departure_city' => $input['from_city'], 'arrival_city' => $input['to_city'], 'departure_date' => $input['fcheckin'], 'return_date' => $input['fcheckout'], 'adult' => $input['adult'], 'child' => $input['child'], 'infant'=> $input['infant'],'airline' => '', 'journey_type' => $input['journey_type'], 'cabin_class' => $input['cabin_class'], 'flexible' => $input['flexible'], 'multi_from_city' => json_encode($input['multi_from_city']), 'multi_to_city'=> json_encode($input['multi_to_city']), 'multi_fcheckin' => json_encode($input['mutli_fcheckin']), 'status' => 'Active');
	// 	$insertQuery	= array('departure_city' => $input['from_city'], 'arrival_city' => $input['to_city'], 'departure_date' => $input['fcheckin'], 'return_date' => $input['fcheckout'], 'adult' => $input['adult'], 'child' => $input['child'], 'infant'=> $input['infant'],'airline' => '', 'journey_type' => $input['journey_type'], 'cabin_class' => $input['cabin_class'], 'flexible' => $input['flexible'], 'multi_from_city' => json_encode($input['multi_from_city']), 'multi_to_city'=> json_encode($input['multi_to_city']), 'multi_fcheckin' => json_encode($input['mutli_fcheckin']), 'ip_address' => $ip_address, 'status' => 'ACTIVE', 'search_count' => '1','insertion_date' => $CurrentDate);

	// 	$this->db->select('*');
 //        $this->db->from('search_parameter_details');
 //        $this->db->where($inputQuery);
 //        $this->db->order_by('search_parameter_details_id','desc');
 //        $query = $this->db->get();   
 //        if($query->num_rows() == '' || $query->num_rows() == '0'){
	// 		$insertQuery = $this->db->insert('search_parameter_details',$insertQuery);
	// 		$search_parameter_details_id 		= $this->db->insert_id();
	// 		$this->db->query("UPDATE search_parameter_details SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
	// 	}else{
	// 		$search_parameter 	= $query->row();
	// 		$xmlResponseDate 	= $search_parameter->insertion_date;
	// 		$Result 			= strcmp($xmlResponseDate,$CurrentDate);
	// 		if($Result == 0){
	// 			$count 							= (($search_parameter->search_count));
	// 			$search_parameter_details_id 	= $search_parameter->search_parameter_details_id;
	// 			$this->db->query("UPDATE search_parameter_details SET search_count='$count' WHERE search_parameter_details_id='$search_parameter_details_id'");
	// 		}else{
	// 			// Update or Deletion of a perticuler record is required, but due to Search Tracking it is not enabled.
	// 			// $this->db->delete('amadeusInputParameters',array('Id'=>$searchId));
	// 			$insertQuery 					= $this->db->insert('search_parameter_details',$insertQuery);
	// 			$search_parameter_details_id 	= $this->db->insert_id();
	// 			$this->db->query("UPDATE search_parameter_details SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
	// 		}
	// 	}
	// 	return $search_parameter_details_id;
	// }
	
	// function parse_session_create_response($SessionCreateRQ_RS){ 
 //        $SessionCreateRS 		= $SessionCreateRQ_RS['SessionCreateRS'];
 //        $response 				= $this->xml_to_array->XmlToArray($SessionCreateRS);
 //        $BinarySecurityToken	= array();
	// 	if(isset($response['soap-env:Header']['eb:MessageHeader'])){
	// 		$BinarySecurityToken['ConversationId']		 	= $response['soap-env:Header']['eb:MessageHeader']['eb:ConversationId'];
	// 		$BinarySecurityToken['BinarySecurityToken'] 	= $response['soap-env:Header']['wsse:Security']['wsse:BinarySecurityToken']['@content'];
 //        }
 //        return $BinarySecurityToken;
	// }
	
	// function get_api_credentials(){
	// 	$this->db->where('api_name', 'Sabre');
	// 	$this->db->where('api_status', 'ACTIVE');
	// 	$query = $this->db->get('api_details');
	// 	if($query->num_rows() != 0 ){
	// 		return $query->row();
	// 	}else{
	// 		return '';
	// 	}
	// }
	
	// function get_airport_cityname($code){
 //        $this->db->select('airport_city as city');
 //        $this->db->where('airport_code', $code);
 //        $data = $this->db->get('iata_airport_list')->row();
 //        if(isset($data->city)){
	// 		return $data->city;
	// 	}else{
	// 		return '';
	// 	}
 //    }    
 //    function update_flight_response($search_parameter_details_id, $rand_id, $xml_request, $xml_response){
 //       $this->db->query("UPDATE search_parameter_details SET xml_request='".$xml_request.".xml',xml_response='".$xml_response.".xml', rand_id='".$rand_id."'  WHERE search_parameter_details_id='".$search_parameter_details_id."'");
	// }
    
 //    function save_result($result,$search_data,$rand_id){
 //       // echo "sdas: <pre/>".print_r($search_data).print_r($result);exit;
 //        $this->db->truncate('flight_results');
 //        $data = array();
 //        if(!empty($result) && $result!=''){
 //            for ($i= 0; $i < count($result) ; $i++){  $temp   = $result[$i];
 //               for($j=0;$j<count($temp);$j++){
 //                $data[$i]['search_parameter_details_id']    = $search_data->search_parameter_details_id;
 //                $data[$i]['session_id']         			= $_SESSION['ses_id'];
 //                $data[$i]['rand_id']              = $rand_id;
 //                $data[$i]['journey_type']              = $search_data->journey_type;
 //                $data[$i]['adult']              = $search_data->adult;
 //                $data[$i]['child']              = $search_data->child;
 //                $data[$i]['infant']             = $search_data->infant;
 //                $OriginLocation 		= explode(",",$search_data->departure_city);
	// 			$DestinationLocation 	= explode(",",$search_data->arrival_city);
 //                $data[$i]['origin_code']             = trim($OriginLocation[1]);
 //                $data[$i]['destination_code']             = trim($DestinationLocation[1]);
                
 //                $data[$i]['onward_stops']             = count($temp[$j]['dateOfArrival']) - 1;
 //                $data[$i]['return_stops']             = isset($temp[$j]['dateOfArrival'][1]) ? (count($temp[$j]['dateOfArrival'][1]) - 1) : NULL;
 //                $data[$i]['onwards_duration']   = $temp[$j]['StopOver'][0];
 //                $data[$i]['returns_duration']   = $temp[$j]['StopOver'][1];
 //                $data[$i]['depature_time']      = $temp[$j]['timeOfDeparture'][0];
 //                $data[$i]['arrival_time']       = $temp[$j]['timeOfArrival'][0];
                
 //                $data[$i]['base_currency']           = BASE_CURRENCY;
 //                $data[$i]['api_currency']       = $temp[$j]['TotalFare_CurrencyCode'];
 //                $data[$i]['airline']            = $temp[$j]['Airline_name'][0];
 //                $data[$i]['airline_code']       = $temp[$j]['MarketingAirline'][0];
 //                $data[$i]['segment_data']       = json_encode($temp);               
 //                $data[$i]['depature_time']      = $temp[$j]['timeOfDeparture'][0];
 //                $data[$i]['arrival_time']       = $temp[$j]['timeOfArrival'][0];
                
                
                
 //                $data[$i]['nonRefundable']   = $temp[$j]['nonRefundable'][0];
 //                $data[$i]['BaggageInformation_weight']   = $temp[$j]['BaggageInformation_weight'][0];
 //                $data[$i]['BaggageInformation_Unit']   = $temp[$j]['BaggageInformation_Unit'][0];
 //                $data[$i]['TerminalID']   = $temp[$j]['TerminalID'][0];
 //                $data[$i]['Meal']   = $temp[$j]['Meal'][0];

 //                $data[$i]['request_scenario']   = json_encode($request);
 //                // $data[$i]['net_rate']        = $temp['PricingDetails'][0]['PriceInfo']['totalFareAmount'];
 //                $data[$i]['admin_markup']       = '1';//$temp['Admin_Markup'];
 //                $data[$i]['admin_baseprice']    = '1'; // $temp['Admin_BasePrice'];
 //                $data[$i]['my_markup']          = '1'; // $temp['My_Markup'];
 //            }
 //        }
 //          //   echo 'asdfasdfasdf<pre/>';print_r ($data);exit; 
 //            $this->db->insert_batch('tf_routing_res', $data);
 //        }
 //    }
    
 //    function insert_cart_flight($cart_flight){
 //        $this->db->truncate('cart_flight');
 //        $this->db->insert('cart_flight',$cart_flight);
 //        return $this->db->insert_id();
 //    }
	
	// function insert_cart_global($cart_global){
	// 	$this->db->truncate('cart_global');
 //        $this->db->insert('cart_global', $cart_global);
 //        return $this->db->insert_id();
 //    }
    
 //    function get_cart_global_data($session_id){
 //        $this->db->where('session_id',$session_id);
	// 	return $this->db->get('cart_global')->result();
 //    }
 //    function get_cart_global_data_id($cart_global_id){
 //        $this->db->where('cart_global_id',$cart_global_id);
	// 	return $this->db->get('cart_global')->row();
 //    }
    
 //    function get_cart_flight_data($cart_flight_id){
 //        $this->db->where('cart_flight_id',$cart_flight_id);
	// 	return $this->db->get('cart_flight')->row();
 //    }
    
 //    function get_airline_name($airline_code){
	// 	$this->db->where('airline_code',$airline_code);
	// 	$airline = $this->db->get('airline_details')->row();
	// 	if($airline!=''){
	// 		return trim(strtolower(preg_replace('/\s+/', '_', $airline->airline_name)));
	// 	}
	// }
    
    function view_all_flights(){       
        $this->db->select('*');
        $this->db->from('flight_crs');
        if ($this->session->userdata('lgm_supplier_admin_logged_in') == 'Logged_In') {
              $this->db->where('added_by',$this->session->userdata('lgm_supplier_admin_id'));
              $this->db->where('added_by_type','Supplier');
        }
          $query = $this->db->get();
          if ($query->num_rows() > 0)
           {
             return $query->result();
           } else {
             return false;   
           }  
    }

    function view_all_flights_supplier($supplier_id){
        $this->db->select('*');
        $this->db->from('flight_crs');
        $this->db->where('added_by',$supplier_id);
        $this->db->where('added_by_type','Supplier');

        $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                return $query->result();
            } else {
                return false;   
            }  
    }

    function delete_flight($flight_id){
        $this->db->where('flight_id', $flight_id);
        $this->db->delete('flight_crs'); 
      
    }

    function update_flight_status($flight_id,$status){
       if($status == 0)
        {
             $update_data = array(
                'status' => 'INACTIVE'
            );
            $this->db->where('flight_id', $flight_id);
            $this->db->update('flight_crs', $update_data);
        }
        else
        {
             $update_data = array(
                'status' => 'ACTIVE'
            );
            $this->db->where('flight_id', $flight_id);
            $this->db->update('flight_crs', $update_data);
        }
       
    }

    function get_flight_list($flight_id = ''){
        $this->db->select('*');
        $this->db->from('flight_crs');
        if($flight_id !='')
           $this->db->where('flight_id', $flight_id);
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
    }

    function update_flight_info($data,$flight_id)
    {
        $this->db->where('flight_id', $flight_id);
        $query = $this->db->update('flight_crs',$data,$where);
        if($query) {
            $flg=true;
        }
        else    {
            $flg=false;
        }
        return $flg;
    }

    function get_airport_list($query){
        $this->db->like('airport_city', $query); 
        $this->db->or_like('airport_code', $query); 
        $this->db->limit(8);
        return $this->db->get('flight_airport_list');
    }

    function add_flight_info($flight_data){
    if ($this->session->userdata('lgm_supplier_admin_logged_in') == 'Logged_In') {
        $flight_data['added_by'] = $this->session->userdata('lgm_supplier_admin_id');
        $flight_data['added_by_type'] = "Supplier";
    }else{

        $flight_data['added_by'] = $this->session->userdata('provab_admin_id');
        $flight_data['added_by_type'] = "Admin";
    }
        $this->db->insert('flight_crs',$flight_data);
    }

    function get_flight_segments($flight_id,$trip_type){
          // print_r($flight_id);
          // print_r($trip_type);exit();
        $this->db->select('*');
        $this->db->from('flight_segments');
        $this->db->where('flight_id',$flight_id);
        $this->db->where('journey_type',$trip_type);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return false;   
        }
    }

    function add_flight_segment_info($flight_data,$flight_segment_data,$flight_id){
          $result = $this->db->insert('flight_segments',$flight_segment_data);
         $this->db->where('flight_id', $flight_id);
        $query = $this->db->update('flight_crs',$flight_data,$where);
    }

    function update_flight_segment_status($flight_segments_id,$status){
       if($status == 0)
        {
             $update_data = array(
                'status' => 'INACTIVE'
            );
            $this->db->where('flight_segments_id', $flight_segments_id);
            $this->db->update('flight_segments', $update_data);
        }
        else
        {
             $update_data = array(
                'status' => 'ACTIVE'
            );
            $this->db->where('flight_segments_id', $flight_segments_id);
            $this->db->update('flight_segments', $update_data);
        }
       
    }

    function delete_flight_segment($flight_segments_id){
        $this->db->where('flight_segments_id', $flight_segments_id);
        $this->db->delete('flight_segments'); 
      
    }

    function get_flight_segments_by_id($flight_segments_id){          
        $this->db->select('fs.*,f.o_departure_time,f.o_arrival_time,f.r_departure_time,f.r_arrival_time,f.max_stop,f.connection_location');
        $this->db->from('flight_segments fs');
        $this->db->join('flight_crs f', 'f.flight_crs_id = fs.flight_crs_id');
        $this->db->where('fs.flight_segments_id',$flight_segments_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return false;   
        }
    }

    function update_flight_segment_info($flight_segment_data,$flight_data,$flight_segments_id,$flight_crs_id)
    {
        $this->db->where('flight_segments_id', $flight_segments_id);
        $query1 = $this->db->update('flight_segments',$flight_segment_data);
        $this->db->where('flight_crs_id', $flight_crs_id);
        $query = $this->db->update('flight_crs',$flight_data);
        if($query && $query1) {
            $flg=true;
        }
        else    {
            $flg=false;
        }
        return $flg;
        
    }
}
?>
