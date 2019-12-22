<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Flight extends CI_Controller {	

  	public function __construct(){
    		parent::__construct();	
    		$this->load->model('General_Model');		
    		$this->load->model('Flight_Model');
    		$this->load->model('Airline_Model');
    		$this->load->model('Seasons_Model');
    		$this->check_admin_login();		
        // $this->load->library('form_validation');
        // $this->load->helper('form');
  	}

    private function check_admin_login(){
      	if($this->session->userdata('provab_admin_logged_in') == ""){
            redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
      			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
            redirect('login/lock_screen','refresh');
        }else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Logged_In"){
      			// redirect('dashboard','refresh');
        }else if($this->session->userdata('lgm_supplier_admin_logged_in') == "Lock_Screen") {
            redirect('login/lock_screen','refresh');
        }
    }

    function flight_list(){
        $flight = $this->General_Model->get_home_page_settings();
        if (!empty($supplier_id)) {
          $flight['result_view']   =$this->Flight_Model->view_all_flights_supplier($supplier_id);
        }else{
          $flight['result_view']   =$this->Flight_Model->view_all_flights(); 
        }
        $flight['airline_list'] 	= $this->Airline_Model->get_airline_list();
        $this->load->view('flight/flight_list',$flight);
    }

    function add_flight(){
        $flight = $this->General_Model->get_home_page_settings();
        $flight['airline_list'] 	= $this->Airline_Model->get_airline_list();
      	//	print_r($flight['airline_list']);exit();
        $this->load->view('flight/add_flight',$flight);
    }


    function delete_flight($flight_id){
        $flight_id = json_decode(base64_decode($flight_id));
        if($flight_id != ''){
			$flight_info = $this->Flight_Model->get_flight_list($flight_id);
			if($flight_info[0]->flight_id !=''){ 
				$this->Flight_Model->delete_flight_segments($flight_info[0]->flight_id,$flight_info[0]->journey_type);
				$this->Flight_Model->delete_flight_pricing_details($flight_info[0]->flight_id,$flight_info[0]->journey_type);
			}	
			$this->Flight_Model->delete_flight($flight_id); 
        }
        redirect('flight/flight_list','refresh');
    }

    function edit_flight($flight_id){
        $flight_id = json_decode(base64_decode($flight_id));
        if($flight_id){
          $flight 		= $this->General_Model->get_home_page_settings();
          $flight['flight_info'] = $this->Flight_Model->get_flight_list($flight_id);
      			//print_r($flight['flight_info']);exit();
          $this->load->view('flight/edit_flight',$flight);
        } else {
          redirect('flight/flight_list','refresh');
        }
    }

    function update_flight_status($flight_id,$status){
      		//print_r($status);exit();
        $flight_id = json_decode(base64_decode($flight_id));
        if($flight_id != ''){
          $this->Flight_Model->update_flight_status($flight_id,$status);
        }
        redirect('flight/flight_list','refresh');
    }

    function update_flight($flight_id){
             //echo '<pre>'; print_r($_POST); exit();
          $departure_date = $this->input->post('departure_date');
          $return_date = $this->input->post('return_date');
          
        $flight_id = json_decode(base64_decode($flight_id));
        
        $data = array(
          "departure_city" => $this->input->post('from_city'),
          "arrival_city" => $this->input->post('to_city'),
          "departure_date" => $departure_date,
          "multi_from_city" => !empty($_POST['multi_from_city']) ? json_encode($_POST['multi_from_city']): null,
          "multi_to_city" => !empty($_POST['multi_to_city']) ? json_encode($_POST['multi_to_city']): null,
          "multi_fcheckin" => !empty($_POST['multi_departure_date']) ? json_encode($_POST['multi_departure_date']): null,
          "multi_fcheckin" => !empty($_POST['multi_departure_date']) ? json_encode($_POST['multi_departure_date']): null,
        //  "multi_fcheckin_time" => !empty($_POST['multi_departure_time']) ? json_encode($_POST['multi_departure_time']): null,
          "return_date" => $return_date,
          "adult" => $this->input->post('adult'),
          "child" =>    $this->input->post('child'),
          "infant" => $this->input->post('infant'),
          "number_of_seats" => '9',
          "cabin_class" => $this->input->post('flight_class'),
         // "o_departure_time" => $this->input->post('start_time'),
         // "r_departure_time" => $this->input->post('return_time')
          );
               // print_r($data);exit();
        if($flight_id != ''){
          $this->Flight_Model->update_flight_info($data,$flight_id);
        }
        redirect('flight/flight_list','refresh');
    }

    function get_airports(){
        ini_set('memory_limit', '-1');
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		$airports = $this->Flight_Model->get_airport_list($term)->result();
		foreach($airports as $airport){
			$airports['label'] = $airport->airport_city.' - '.$airport->airport_name.', '.$airport->country.', '.$airport->airport_code;
			$airports['value'] = $airport->airport_code;
			$airports['id'] = $airport->airport_id;
			$result[] = $airports; 
		}
		echo json_encode($result);//format the array into json data
    }

    function add_flight_data(){
        
          $departure_date = $this->input->post('departure_date');
          $return_date = $this->input->post('return_date');
        $flight_data = array(
          "flight_id" => 'PU_000'.md5(rand()),
          "journey_type" => $this->input->post('trip_type'),
          "departure_city" => $this->input->post('from_city'),
          "arrival_city" => $this->input->post('to_city'),
          "departure_date" => $departure_date,
          "multi_from_city" => !empty($_POST['multi_from_city']) ? json_encode($_POST['multi_from_city']): null,
          "multi_to_city" => !empty($_POST['multi_to_city']) ? json_encode($_POST['multi_to_city']): null,
          "multi_fcheckin" => !empty($_POST['multi_departure_date']) ? json_encode($_POST['multi_departure_date']): null,
        //  "multi_fcheckin_time" => !empty($_POST['multi_departure_time']) ? json_encode($_POST['multi_departure_time']): null,
          "return_date" => $return_date,
          "adult" => $this->input->post('adult'),
          "child" => $this->input->post('child'),
          "infant" => $this->input->post('infant'),
          "number_of_seats" => '9',
          "airline" => $this->input->post('airline'),
          "cabin_class" => $this->input->post('flight_class'),
          "o_departure_time" => $this->input->post('start_time'),
          "r_departure_time" => $this->input->post('return_time'),
          "ip_address" => $_SERVER['REMOTE_ADDR'],
          "insertion_date" => date('Y-m-d H:i:s'),
          "status" => 'ACTIVE'
          );
        //  echo '<pre>'; print_r($flight_data); exit();
          $this->Flight_Model->add_flight_info($flight_data);
          redirect('flight/flight_list','refresh');
    }

    function flight_segments($flight_id='',$flight_crs_id='',$trip_type=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['trip_type'] = $trip_type = json_decode(base64_decode($trip_type));
        $data['flight_segments'] = $this->Flight_Model->get_flight_segments($flight_id,$trip_type);
        $data['airline_list'] 	= $this->Airline_Model->get_airline_list();
        $this->load->view('flight/flight_segments',$data);
    }

    function add_flight_segments($flight_id='',$flight_crs_id='',$trip_type=''){
        $data  					= $this->General_Model->get_home_page_settings();
        $data['flight_id'] 		= $flight_id 		= json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] 	= $flight_crs_id 	= json_decode(base64_decode($flight_crs_id));
        $data['trip_type'] 		= $trip_type		= json_decode(base64_decode($trip_type));
        $data['airline_list'] 	= $this->Airline_Model->get_airline_list();
        $data['flight_info']   	= $this->Flight_Model->get_flight_list($flight_id); 
        $this->load->view('flight/add_flight_segments',$data);
    }

    function add_flight_segment_data($flight_id1='',$flight_crs_id1='',$trip_type1=''){
        $data['flight_id'] 		= $flight_id 		= json_decode(base64_decode($flight_id1));
        $data['flight_crs_id'] 	= $flight_crs_id 	= json_decode(base64_decode($flight_crs_id1));
        $data['trip_type'] 		= $trip_type 		= json_decode(base64_decode($trip_type1));
        $departure_date 		= $this->input->post('onward_departure_time'). '  ' .$this->input->post('start_time');
        $arrival_date 			= $this->input->post('onward_arrival_time'). '  ' .$this->input->post('arrival_time');

        $flight_segment_data = array(
          "flight_crs_id" => $flight_crs_id,
          "flight_id" => $flight_id,
          "journey_type" => $trip_type,
          "segment_type" => $this->input->post('segment_type'),
          "OriginLocation" => $this->input->post('onward_from_city'),
          "DestinationLocation" => $this->input->post('onward_to_city'),
          "flight_name" => $this->input->post('marketing_airline'),
          "FlightNumber_no" => $this->input->post('flight_number'),
          "MarketingAirline" => $this->input->post('marketing_airline'),
          "OperatingAirline" =>    $this->input->post('operating_airline'),
          "ResBookDesigCode" => $this->input->post('design_code'),
          "Equipment" => $this->input->post('flight_equipment'),
          "MarriageGrp" => $this->input->post('marriage_group'),
          "DepartureTimeZone" => $this->input->post('departure_timezone'),
          "ArrivalTimeZone" => $this->input->post('arrival_timezone'),
          "eTicket" => $this->input->post('eticket'),
          "DepartureDateTime" => $departure_date,
          "ArrivalDateTime" => $arrival_date,
          "SeatsRemaining" => $this->input->post('seats_remaining'),
          "Cabin" => $this->input->post('flight_class'),
          "Meal" => $this->input->post('meal'),
          "nonRefundable" => $this->input->post('non_refundable'),
          "Weight_Allowance" => $this->input->post('weight_allowance'),
          "ip_address" => $_SERVER['REMOTE_ADDR'],
          "insertion_date" => date('Y-m-d H:i:s'),
          "status" => 'ACTIVE'
          );

        if($this->input->post('segment_type') == 'oneway'){
          $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "o_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        } else if($this->input->post('segment_type') == 'roundtrip'){
        $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "r_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        } else {
          $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "o_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        }
      $this->Flight_Model->add_flight_segment_info($flight_data,$flight_segment_data,$flight_id);
       redirect('flight/flight_segments/'.$flight_id1."/".$flight_crs_id1."/".$trip_type1,'refresh');
	  // echo '<pre>'; print_r($flight_data); exit();
	  // $this->Flight_Model->add_flight_segment_info($flight_data,$flight_segment_data,$flight_id);
	  // $data['airline_list']   = $this->Airline_Model->get_airline_list();
	  // $data['flight_segments'] = $this->Flight_Model->get_flight_segments($flight_id,$trip_type);
	  // $this->load->view('flight/flight_segments',$data);
    }

    function update_flight_segment_status($flight_segments_id='',$status='',$flight_id='',$flight_crs_id='',$trip_type=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['trip_type'] = $trip_type = json_decode(base64_decode($trip_type));
        $data['flight_segments_id'] = $flight_segments_id = json_decode(base64_decode($flight_segments_id));
        if($flight_segments_id != ''){
          $this->Flight_Model->update_flight_segment_status($flight_segments_id,$status);
          $data['flight_segments'] = $this->Flight_Model->get_flight_segments($flight_id,$trip_type);
          $data['airline_list']  = $this->Airline_Model->get_airline_list();
        }
          $this->load->view('flight/flight_segments',$data);
    }

    function delete_flight_segment($flight_segments_id='',$flight_id='',$flight_crs_id='',$trip_type=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['trip_type'] = $trip_type = json_decode(base64_decode($trip_type));
        $data['flight_segments_id'] = $flight_segments_id = json_decode(base64_decode($flight_segments_id));
        if($flight_segments_id != ''){
          $this->Flight_Model->delete_flight_segment($flight_segments_id); 
          $data['flight_segments'] = $this->Flight_Model->get_flight_segments($flight_id,$trip_type);
          $data['airline_list']  = $this->Airline_Model->get_airline_list();
        }
          $this->load->view('flight/flight_segments',$data);
    }

    function edit_flight_segment($flight_segments_id=''){
        $flight_segments_id = json_decode(base64_decode($flight_segments_id));
        if($flight_segments_id){
          $data['flight_segments_id'] = $flight_segments_id;
          $data['flight']    = $this->General_Model->get_home_page_settings();
          $data['flight_segments'] = $this->Flight_Model->get_flight_segments_by_id($flight_segments_id);
          $data['airline_list']  = $this->Airline_Model->get_airline_list();
          $this->load->view('flight/edit_flight_segments',$data);
        } else {
          redirect('flight/flight_list','refresh');
        }
    }

    function update_flight_segment_data($flight_segments_id1='',$flight_crs_id1='',$flight_id1='',$trip_type1=''){
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id1));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id1));
        $data['trip_type'] = $trip_type = json_decode(base64_decode($trip_type1));
        $data['flight_segments_id'] = $flight_segments_id = json_decode(base64_decode($flight_segments_id1));
        $departure_date = $this->input->post('onward_departure_time'). '  ' .$this->input->post('start_time');
        $arrival_date = $this->input->post('onward_arrival_time'). '  ' .$this->input->post('arrival_time');
        
        if($flight_segments_id){
        $flight_segment_data = array(
          "OriginLocation" => $this->input->post('onward_from_city'),
          "DestinationLocation" => $this->input->post('onward_to_city'),
          "flight_name" => $this->input->post('airline'),
          "FlightNumber_no" => $this->input->post('flight_number'),
          "MarketingAirline" => $this->input->post('airline'),
          "OperatingAirline" =>    $this->input->post('operating_airline'),
          "ResBookDesigCode" => $this->input->post('design_code'),
          "Equipment" => $this->input->post('flight_equipment'),
          "MarriageGrp" => $this->input->post('marriage_group'),
          "DepartureTimeZone" => $this->input->post('departure_timezone'),
          "ArrivalTimeZone" => $this->input->post('arrival_timezone'),
          "eTicket" => $this->input->post('eticket'),
          "DepartureDateTime" => $departure_date,
          "ArrivalDateTime" => $arrival_date,
          "SeatsRemaining" => $this->input->post('seats_remaining'),
          "Cabin" => $this->input->post('flight_class'),
          "Meal" => $this->input->post('meal'),
          "nonRefundable" => $this->input->post('non_refundable'),
          "Weight_Allowance" => $this->input->post('weight_allowance'),
          );
        if($this->input->post('segment_type') == 'oneway'){
          $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "o_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        } else if($this->input->post('segment_type') == 'roundtrip'){
        $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "r_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        } else {
          $flight_data = array(
          "o_departure_time" => $this->input->post('start_time'),
          "o_arrival_time" => $this->input->post('arrival_time'),
          "max_stop" => $this->input->post('max_stop'),
          );
        }
        $this->Flight_Model->update_flight_segment_info($flight_segment_data,$flight_data,$flight_segments_id,$flight_crs_id);
        // $data['flight_segments'] = $this->Flight_Model->get_flight_segments($flight_id,$trip_type);
        // $data['airline_list']  = $this->Airline_Model->get_airline_list();
        // $this->load->view('flight/flight_segments',$data);
        redirect('flight/flight_segments/'.$flight_id1."/".$flight_crs_id1."/".$trip_type1,'refresh');
      }
    }

    function flight_pricing($flight_id='',$flight_crs_id=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        $data['price_flight'] = $this->Flight_Model->get_flight_pricing($flight_id,$flight_crs_id);
       //print_r($data['price_flight']);exit();
        $this->load->view('flight/flight_pricing',$data);
    }

    function add_flight_pricing($flight_id='',$flight_crs_id=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        $data['seasons_list'] 	   	= $this->Seasons_Model->get_seasons_list();
        $this->load->view('flight/add_flight_pricing',$data);
    }

    function add_flight_pricing_data($flight_id='',$flight_crs_id=''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id)); 
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        
        $flight_pricing = array(
          'flight_crs_id' => $flight_crs_id,
          'flight_id' => $flight_id,
          'seasons_details_id' => $this->input->post('seasons_details_id'),
          'base_currency'=> 'USD',
          'adult_base_fare' => $this->input->post('adult_price'),
          'adult_total_tax' => $this->input->post('adult_tax'),
          'adult_total_fare' => (($this->input->post('adult_price')) + $this->input->post('adult_tax')),
          'child_base_fare'  =>  $this->input->post('child_price'),
          'child_total_tax' => $this->input->post('child_tax'),
          'child_total_fare' => ($this->input->post('child_price') + $this->input->post('child_tax')),
          'infant_base_fare' => $this->input->post('infant_price'),
          'infant_total_tax' => $this->input->post('infant_tax'),
          'infant_total_fare' =>($this->input->post('infant_price') + $this->input->post('infant_tax')),
          'base_fare'=> ($this->input->post('adult_price') + $this->input->post('child_price') + $this->input->post('infant_price')),
          'total_tax'=> ($this->input->post('adult_tax') + $this->input->post('child_tax') + $this->input->post('infant_tax')),
          'total_fare' => ($this->input->post('adult_price') + $this->input->post('adult_tax') + $this->input->post('child_price') + $this->input->post('child_tax') + $this->input->post('infant_price') + $this->input->post('infant_tax')),
          'fare_basis_code'=> $this->input->post('fare_code'),
          'fare_rules'=> $this->input->post('fare_rules'),
          'ip_address' => $_SERVER['REMOTE_ADDR'],
          'insertion_date' => date('Y-m-d H:i:s'),
          'status' => 'ACTIVE'
         );
        //echo '<pre>'; print_r($flight_pricing); exit();
        $this->Flight_Model->add_flight_pricing_data($flight_pricing);
        $data['price_flight'] = $this->Flight_Model->get_flight_pricing($flight_id,$flight_crs_id);
        $this->load->view('flight/flight_pricing',$data);
      }

      function delete_flight_price($flight_price_details_id = '',$flight_id,$flight_crs_id = ''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_price_details_id'] = $flight_price_details_id = json_decode(base64_decode($flight_price_details_id));
        if($flight_price_details_id != ''){
          $this->Flight_Model->delete_flight_price($flight_price_details_id); 
        }
       //  print_r($data['flight_price_details_id']);exit();        
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        $data['price_flight'] = $this->Flight_Model->get_flight_pricing($flight_id,$flight_crs_id);
    //    print_r($data['price_flight']);
        $this->load->view('flight/flight_pricing',$data);
    }

    function edit_flight_price($flight_price_details_id = '',$flight_id = '',$flight_crs_id = ''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_price_details_id'] = $flight_price_details_id = json_decode(base64_decode($flight_price_details_id));
        if($flight_price_details_id){
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        $data['price_id_info'] = $this->Flight_Model->get_flight_price_id($flight_price_details_id);
      //print_r($data['flight_price_details_id']);exit();
		$data['seasons_list'] 	   	= $this->Seasons_Model->get_seasons_list();
          $this->load->view('flight/edit_flight_pricing',$data);
        } else {
          redirect('flight/flight_list','refresh');
        }
    }

    function update_flight_price_status($flight_price_details_id = '',$status = '',$flight_id = '',$flight_crs_id = ''){         
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_price_details_id'] = $flight_price_details_id = json_decode(base64_decode($flight_price_details_id));
        if($flight_price_details_id != ''){
          $this->Flight_Model->update_flight_price_status($flight_price_details_id,$status);
        }
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id));
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        $data['price_flight'] = $this->Flight_Model->get_flight_pricing($flight_id,$flight_crs_id);
     //  print_r($data['flight_crs_id']);exit();
        $this->load->view('flight/flight_pricing',$data);
    }

    function update_flight_pricing_data($flight_price_details_id = '',$flight_id = '',$flight_crs_id = ''){
        $data  = $this->General_Model->get_home_page_settings();
        $data['flight_price_details_id'] = $flight_price_details_id = json_decode(base64_decode($flight_price_details_id));
        $data['flight_id'] = $flight_id = json_decode(base64_decode($flight_id));
        $data['flight_crs_id'] = $flight_crs_id = json_decode(base64_decode($flight_crs_id)); 
        $data['currency_list']   = $this->General_Model->get_currency_list(); 
        
        $flight_pricing = array(
          'flight_crs_id' => $flight_crs_id,
          'flight_id' => $flight_id,
          'seasons_details_id' => $this->input->post('seasons_details_id'),
          'base_currency'=> 'USD',
          'adult_base_fare' => $this->input->post('adult_price'),
          'adult_total_tax' => $this->input->post('adult_tax'),
          'adult_total_fare' => (($this->input->post('adult_price')) + $this->input->post('adult_tax')),
          'child_base_fare'  =>  $this->input->post('child_price'),
          'child_total_tax' => $this->input->post('child_tax'),
          'child_total_fare' => ($this->input->post('child_price') + $this->input->post('child_tax')),
          'infant_base_fare' => $this->input->post('infant_price'),
          'infant_total_tax' => $this->input->post('infant_tax'),
          'infant_total_fare' =>($this->input->post('infant_price') + $this->input->post('infant_tax')),
          'base_fare'=> ($this->input->post('adult_price') + $this->input->post('child_price') + $this->input->post('infant_price')),
          'total_tax'=> ($this->input->post('adult_tax') + $this->input->post('child_tax') + $this->input->post('infant_tax')),
          'total_fare' => ($this->input->post('adult_price') + $this->input->post('adult_tax') + $this->input->post('child_price') + $this->input->post('child_tax') + $this->input->post('infant_price') + $this->input->post('infant_tax')),
          'fare_basis_code'=> $this->input->post('fare_code'),
          'fare_rules'=> $this->input->post('fare_rules'),
          'ip_address' => $_SERVER['REMOTE_ADDR'],
          'insertion_date' => date('Y-m-d H:i:s'),
          'status' => 'ACTIVE'
         );
        $this->Flight_Model->update_flight_pricing_data($flight_price_details_id,$flight_pricing);
        $data['price_flight'] = $this->Flight_Model->get_flight_pricing($flight_id,$flight_crs_id);
        $this->load->view('flight/flight_pricing',$data);
     }


}
