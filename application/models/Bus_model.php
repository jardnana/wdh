<?php
	class Bus_model extends CI_Model {
		function __construct(){
			parent::__construct();
		} 

function insert_input_parameters($input,$type){
		
		
		//$randId 		= $xmlName = $xmlId = $search_parameter = '';
		$rand_id 	  = md5(time() . rand());
		$CurrentDate 	= date("Y-m-d"); 	
		$CurrentTime 	= date("h:i:s");  
		$ip_address			= $_SERVER['REMOTE_ADDR'];
		// echo '<pre>da'; print_r($input); exit;
		// echo '<pre/>';print_r($_SESSION);exit;
		$inputQuery		= array('session_id' => $_SESSION['ses_id'], 'rand_id' => $rand_id, 'departure_city' => $input['from_city'], 'arrival_city' => $input['to_city'], 'departure_date' => $input['departureDate'], 'return_date' => $input['returnDate'], 'journey_type' => $type);
		$insertQuery	= array('session_id' => $_SESSION['ses_id'], 'rand_id' => $rand_id,'departure_city' => $input['from_city'], 'arrival_city' => $input['to_city'], 'departure_date' => $input['departureDate'], 'return_date' => $input['returnDate'], 'journey_type' => $type ,'ip_address' => $ip_address, 'status' => 'ACTIVE', 'search_count' => '1','insertion_date' => $CurrentDate,'insertion_time' => $CurrentTime);

		$this->db->select('*');
        $this->db->from('search_parameter_details_bus');
        $this->db->where($inputQuery);
        $this->db->order_by('search_parameter_details_id','desc');
        $query = $this->db->get();   
        if($query->num_rows() == '' || $query->num_rows() == '0'){
			$insertQuery = $this->db->insert('search_parameter_details_bus',$insertQuery);
			$search_parameter_details_id 		= $this->db->insert_id();
			$this->db->query("UPDATE search_parameter_details_bus SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
		}else{
			$search_parameter 	= $query->row();
			$xmlResponseDate 	= $search_parameter->insertion_date;
			$Result 			= strcmp($xmlResponseDate,$CurrentDate);
			if($Result == 0){
				$actualTime						= (strtotime($CurrentTime) - strtotime($search_parameter->insertion_time));
				if($actualTime > 0) {
					$minutes = ($actualTime/60);
					if($minutes >= 0 && $minutes <= 15){
						$count 							= (($search_parameter->search_count));
						$search_parameter_details_id 	= $search_parameter->search_parameter_details_id;
						$this->db->query("UPDATE search_parameter_details_bus SET search_count='$count' WHERE search_parameter_details_id='$search_parameter_details_id'");
					}else{
						// Update or Deletion of a perticuler record is required, but due to Search Tracking it is not enabled.
						// $this->db->delete('amadeusInputParameters',array('Id'=>$searchId));
						$insertQuery 					= $this->db->insert('search_parameter_details_bus',$insertQuery);
						$search_parameter_details_id 	= $this->db->insert_id();
						$this->db->query("UPDATE search_parameter_details_bus SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
					}
				}else{
					// Update or Deletion of a perticuler record is required, but due to Search Tracking it is not enabled.
					// $this->db->delete('amadeusInputParameters',array('Id'=>$searchId));
					$insertQuery 					= $this->db->insert('search_parameter_details_bus',$insertQuery);
					$search_parameter_details_id 	= $this->db->insert_id();
					$this->db->query("UPDATE search_parameter_details_bus SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
				}				
			}else{
				// Update or Deletion of a perticuler record is required, but due to Search Tracking it is not enabled.
				// $this->db->delete('amadeusInputParameters',array('Id'=>$searchId));
				$insertQuery 					= $this->db->insert('search_parameter_details_bus',$insertQuery);
				$search_parameter_details_id 	= $this->db->insert_id();
				$this->db->query("UPDATE search_parameter_details_bus SET search_count='1' WHERE search_parameter_details_id='$search_parameter_details_id'");
			}
		}
		return $search_parameter_details_id;
	}

	public function get_recent_search_list($search_parameter_details_id = '',$bus_details_id=''){
		if($search_parameter_details_id != '')
			$this->db->where('search_parameter_details_id', $search_parameter_details_id);
		if($bus_details_id != '')
			$this->db->where('bus_details_id', $bus_details_id);
		$this->db->order_by('search_parameter_details_id', 'DESC');
		$this->db->limit(3);
        return $this->db->get('search_parameter_details_bus')->result();
    }

    public function get_flash_list($cityCode = ''){
		if($cityCode != ''){
			$this->db->where('city_name', $cityCode);
			$this->db->where('status', 'ACTIVE');
			$queryResults = $this->db->get('flash_details')->result();
			if($queryResults[0] == ''){
				$this->db->where('flash_type', 'GENERAL');
				$this->db->where('status', 'ACTIVE');
				return $this->db->get('flash_details')->result();
			}else{
				return $queryResults; 
			}
		}else{
			$this->db->where('flash_type', 'GENERAL');
			$this->db->where('status', 'ACTIVE');
			return $this->db->get('flash_details')->result();
		}
    }

    public function get_bus_destination($depCity){
		$this->db->where('city', $depCity);
        return $this->db->get('busdestination')->row();
    }
    public function deleteRecentSearch($sessionId){
    	//echo '<pre>'; print_r($sessionId); exit;
    	$this->db->where('session_id', $sessionId);
		$this->db->delete('bus_temp_results'); 
    }
    public function save_bus_result($result, $session_id,$strApiName,$delete_flag='YES',$search_data=''){
         
        $data = array();
        // echo '<pre>fs'; print_r($result); exit();
        if(!empty($result) && $result['results']!=''){
            for ($i= 0; $i < count($result['results']) ; $i++){ 
               $temp                          	= $result['results'];
               
               // for($j=0;$j<count($result['results'][$i]);$j++){
               // echo '<pre>fs'; print_r(); exit;
					$data[$i]['session_id']         = $_SESSION['ses_id'];
					$data[$i]['displayname']        = $temp[$i]['DisplayName'];
					$data[$i]['currency']           = "INR";
					$data[$i]['api_currency']       = "INR";
					$data[$i]['avialableseats']     = $temp[$i]['AvailableSeats'];
					$data[$i]['IsRtc']       		= $temp[$i]['IsRtc'];
					$data[$i]['Amenities']       	= $temp[$i]['Amenities'];               
					$data[$i]['BoardingTimes']      = $temp[$i]['BoardingTimes'];               
					$data[$i]['BusType']      		= $temp[$i]['BusType'];
					$data[$i]['SeatLayoutType']     = $temp[$i]['SeatLayoutType'];
					$data[$i]['CancellationPolicy'] = $temp[$i]['CancellationPolicy'];
					$data[$i]['DepartureTime']      = $temp[$i]['DepartureTime'];
					$data[$i]['routing_id']         = $i;
					$data[$i]['origin']             = $result['search_data'][0]->departure_city;
					$data[$i]['destination']        = $result['search_data'][0]->arrival_city;
					$data[$i]['originId']        	= $temp[$i]['SourceId'];
					$data[$i]['destinationId']      = $temp[$i]['DestinationId'];
					$data[$i]['Duration']      		= $temp[$i]['Duration'];
					$data[$i]['DroppingTimes']      = $temp[$i]['DroppingTimes'];
					$data[$i]['Amount']      		= $temp[$i]['Fares'];
					$data[$i]['ServiceTax']      	= $temp[$i]['ServiceTax'];
					$data[$i]['OperatorServiceCharge']   = $temp[$i]['OperatorServiceCharge'];
					$data[$i]['ConvenienceFee']   	= $temp[$i]['ConvenienceFee'];
					$data[$i]['PartnerFareDatails'] = $temp[$i]['PartnerFareDatails'];
					$data[$i]['Id'] 				= 	$temp[$i]['Id'];
					$data[$i]['Provider'] 			= $temp[$i]['Provider'];
					$data[$i]['PartialCancellationAllowed'] = $temp[$i]['PartialCancellationAllowed'];
					$data[$i]['SeatType'] 			= $temp[$i]['SeatType'];
					$data[$i]['Travels'] 			= $temp[$i]['Travels'];
					$data[$i]['Mticket'] 			= $temp[$i]['Mticket'];
					$data[$i]['Journeydate'] 		= $temp[$i]['Journeydate'];
					$data[$i]['admin_markup']       = '';
			}
			//echo '<pre/>';print_r ($data);exit; 
			$this->db->insert_batch('bus_temp_results', $data);
        }
    	
    }

     function get_last_response($session_id,$params=array() , $cond = array()){
    	
         $this->db->where('session_id', $session_id );
    
        $this->db->order_by('Amount','asc');
    // $q = $this->db->select('*')->get('tf_routing_res');
    $q = $this->db->select('*')->get('bus_temp_results');
   // echo $this->db->last_query();exit;
    if( $q->num_rows() > 0 ){
        $result = $q->result_array();
       // echo "sanj<pre/>";print_r($result);exit();
        return $result;
    }
        return false;
}
}
?>