<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE){ session_start(); }
error_reporting(0);
class Bus extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->perPage 	= 600;
        $this->load->model('Common_model');
        $this->load->model('Database_model');
        $this->load->model('Bus_model');
        $this->load->helper('etravosbus_helper');
        if(!isset($_SESSION['ses_id'])){
			$sec_res = session_id();
	    	$_SESSION['ses_id'] = $sec_res;
		}
    }

	public function index(){ 
		$this->load->view('home/index');
	}

	public function search(){
		// echo '<pre>sf'; print_r($_POST); exit;
		if ($_POST['from_city'] == '' || $_POST['to_city'] =='' || $_POST['departureDate'] =='' || $_POST['from_city'] == $_POST['to_city']) { redirect('home','refresh'); }
			
			if ($_POST['returnDate'] == '') {
				$type = 'OneWay';
			}else{
				$type = 'RoundTrip';
			}
			$journey_type = $type;

			$session_data = $this->generate_rand_no().date("mdHis");
			$sesdata =  array(
						 'session_data' 	=> $session_data
								);

			$this->session->set_userdata($sesdata);
			// echo '<pre>fs'; print_r($_SESSION); exit;
			// Set Cookie for Flight Search Form
			$this->input->set_cookie('bus_search', json_encode($_POST), time()+3600);
			$search_id 				= $xml_response = $this->Bus_model->insert_input_parameters($_POST,$type);

			$data['input_details']	= $this->Bus_model->get_recent_search_list($search_id);
			//echo '<pre>sf'; print_r($data); exit();
			//$cityCode 				= explode(",",$_POST['from_city']);
			//$data['flash_details']	= $this->Bus_model->get_flash_list(trim($cityCode[1]));
			
			$this->load->view('bus/bus_results',$data);
		
		// $this->load->view('home/index');
	}

	function generate_rand_no($length = 24) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
        //$id = date("ymd").date("His");
        $id = '';
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

	public function results($id,$sessData,$rand_id,$api = 1){
		ini_set('memory_limit', '-1');
		$id = json_decode(base64_decode($id));
		
		$results = array();
		$bus_results = array();
		$results_calendar = array(); 
		$search_id = (($id)); $bus['results'] = '';

		if($search_id !=''){
			$bus['search_data']  = $search_data = $this->Bus_model->get_recent_search_list($search_id);
			
			$this->Bus_model->deleteRecentSearch($_SESSION['ses_id']);
			$data['trip_type'] = $search_data[0]->journey_type;
			$strJrnyType = $search_data[0]->journey_type;
			$bus['rand_id'] 	    = $rand_id;
			$bus['search_id'] 	= $search_id;
			$session_data 			= $sessData;

			if($search_data !=''){ 
				if(true){
				$arrSearchbusRS = search_bus($search_data,$rand_id,$search_id);
				
				$strApiName = 'eTravecos';
				$arrParsedData	= $this->parse_searchResult_eTravecos($arrSearchbusRS,$strApiName,$strJrnyType,$search_data);
				
				// pr($arrParsedData);exit();
				$results                = $arrParsedData;
				// pr($results);exit();
				/*$strTotalPRice[]      = min($arrParsedData[4]);
				$strTotalPRice[]      = max($arrParsedData[4]);*/				
				//$arrPriceTotal = json_encode($strTotalPRice);
				//array_multisort($usernames, SORT_ASC, $results);
				$bus['results'] 		= $results;

				$bus['session_data'] = $session_data;
				// echo '<pre>fsf'; print_r($arrParsedData); exit;
				
				// echo $session_data;
				 // echo count($results);
				 //   if($_SERVER['REMOTE_ADDR'] == '182.156.244.142'){  
				 //    	echo "<pre/>";print_r($results);exit;
					// }
				// echo '<pre>fs'; print_r(count($results)); exit;
				if(count($results) >0){
					$this->Bus_model->save_bus_result($bus,$session_data,$strApiName);	
					//$this->Flight_Model->save_flight_result_data($strApiName,$session_data,$arrParsedData,$strTotalPRice,$session_data);
					}
				}
			}

			$bus_result = $this->Bus_model->get_last_response($session_data,array('limit'=>$this->perPage));
			$results =$bus_result;
			$strTempDtls = count($bus_result);
			// echo '<pre>fsf'; print_r($results); exit;
			$data['search_data']  	= $search_data;
			$data['session_data']  	= $session_data;
			$data['search_id'] 		= $search_id;
			$data['results'] 		= $results;	
			$data['rand_id'] 	    = $search_data[0]->rand_id;	
			$data['total_bus_count'] = count($strTempDtls);
			$data['org']  = '1';
			// echo '<pre>fs'; print_r($data); exit;
			$ajax_results =  $this->load->view('bus/ajax_results',$data,true);

			echo json_encode(array( 
				'bus_search_result' 		=> $ajax_results, 
				'total_bus_count' 		=> count($bus_result)
			));
		}

	}

	public function parse_searchResult_eTravecos($arrSearchbusRS,$strApiName,$strJrnyType,$search_data){
	// echo '<pre>fs'; print_r(); exit;
		$result = $arrSearchbusRS['AvailableTrips'];

		for ($b=0; $b < count($result) ; $b++) { 
			
			$arrbusDisplayName[$b]['DisplayName'] = $result[$b]['DisplayName'];
			$arrbusDisplayName[$b]['AvailableSeats'] = $result[$b]['AvailableSeats'];
			$arrbusDisplayName[$b]['IsRtc'] = $result[$b]['IsRtc'];
			$arrbusDisplayName[$b]['ArrivalTime'] = $result[$b]['ArrivalTime'];
			$arrbusDisplayName[$b]['Amenities'] = serialize($result[$b]['Amenities']);
			$arrbusDisplayName[$b]['BoardingTimes'] = serialize($result[$b]['BoardingTimes']);
			$arrbusDisplayName[$b]['BusType'] = $result[$b]['BusType'];
			$arrbusDisplayName[$b]['SeatLayoutType'] = $result[$b]['SeatLayoutType'];
			$arrbusDisplayName[$b]['CancellationPolicy'] = $result[$b]['CancellationPolicy'];
			$arrbusDisplayName[$b]['DepartureTime'] = $result[$b]['DepartureTime'];
			$arrbusDisplayName[$b]['DestinationId'] = $result[$b]['DestinationId'];
			$arrbusDisplayName[$b]['Duration'] = $result[$b]['Duration'];
			$arrbusDisplayName[$b]['DroppingTimes'] = serialize($result[$b]['DroppingTimes']);
			$arrbusDisplayName[$b]['Fares'] = $result[$b]['Fares'];
			$arrbusDisplayName[$b]['ServiceTax'] = $result[$b]['ServiceTax'];
			$arrbusDisplayName[$b]['OperatorServiceCharge'] = $result[$b]['OperatorServiceCharge'];
			$arrbusDisplayName[$b]['ConvenienceFee'] = $result[$b]['ConvenienceFee'];
			$arrbusDisplayName[$b]['PartnerFareDatails'] = serialize($result[$b]['PartnerFareDatails']);
			$arrbusDisplayName[$b]['Id'] = $result[$b]['Id'];
			$arrbusDisplayName[$b]['Provider'] = $result[$b]['Provider'];
			$arrbusDisplayName[$b]['PartialCancellationAllowed'] = $result[$b]['PartialCancellationAllowed'];
			$arrbusDisplayName[$b]['SeatType'] = $result[$b]['SeatType'];
			$arrbusDisplayName[$b]['SourceId'] = $result[$b]['SourceId'];
			$arrbusDisplayName[$b]['Travels'] = $result[$b]['Travels'];
			$arrbusDisplayName[$b]['Mticket'] = $result[$b]['Mticket'];
			$arrbusDisplayName[$b]['Journeydate'] = $result[$b]['Journeydate'];
			
		}

		return $arrbusDisplayName;
		//echo '<pre>fs'; print_r($arrbusDisplayName); exit;

	}

}
?>