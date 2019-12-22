<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE){ session_start(); }
error_reporting(0);
class Booking extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Booking_Model');
		$this->load->model('Flight_Model');
		$this->load->helper('sabre_helper');
		$this->load->library('xml_to_array');
		$this->check_admin_login();		
	}
	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}
    }
    
	function orders_by_user($user_id1){
		$user_id	= json_decode(base64_decode($user_id1));
		if($user_id !=''){
			$booking['booking_list'] = $this->Booking_Model->get_booking_list_by_user($user_id);
			$this->load->view('booking/booking_list',$booking);
		}else{
			redirect('booking/orders','refresh');
		}
	}
	
	function orders(){
		$booking['booking_list'] = $this->Booking_Model->get_booking_list();
		$this->load->view('booking/booking_list',$booking);
	}
	public function refineSearch(){
		$data['moduleType'] = $this->input->post('module');
		$user_type = $this->input->post('user_type');
		$data['Bookings'] = $this->Booking_Model->getRefineSearchResult($_POST, $user_type)->result();
		//echo "<pre>"; print_r($data); exit;
		echo $this->load->view('booking/ajax_refine/ajaxRefineResults', $data, TRUE);
	}
	
	function voucher_view($parent_pnr1) {
		$parent_pnr 	= json_decode(base64_decode($parent_pnr1));
		if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				$flight['search_id'] 		= $booking_flights[0]->search_parameter_details_id;
				$flight['rand_id'] 	    	= $booking_flights[0]->rand_id;
				$flight['booking_global'] 	= $booking_global;
				$flight['booking_flights']  = $this->Booking_Model->get_booking_flight_data($parent_pnr);
				$flight['booking_payment']  = $this->Booking_Model->get_booking_payment_data($parent_pnr);
				$flight['insurance_detail'] = $this->Booking_Model->get_insurancedata_data($parent_pnr);
				$flight['search_data'][]  	= $booking_flights[0]->search_data;
				$flight['results'][] 	    = $booking_flights[0]->segment_data;
				// echo '<pre/>';print_r($flight);exit;
				$this->load->view('global/voucher_view',$flight);
			}
		}else{
			redirect('booking/orders','refresh');
		}
	}
	function view_traveller_info($parent_pnr1) {
		$parent_pnr 	= json_decode(base64_decode($parent_pnr1));
		if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$flight['booking_list'] 	= $booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				$flight['search_id'] 		= $booking_flights[0]->search_parameter_details_id;
				$flight['rand_id'] 	    	= $booking_flights[0]->rand_id;
				$flight['traveler_details'] = json_decode(base64_decode($booking_flights[0]->traveler_details));
				// echo '<pre/>';print_r($flight);exit;
				$this->load->view('booking/traveller_list',$flight);
			}
		}else{
			redirect('booking/orders','refresh');
		}
	}
	
	function view_billing_details($parent_pnr1) {
		$parent_pnr 	= json_decode(base64_decode($parent_pnr1));
		if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$flight['booking_list'] 	= $booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				$flight['search_id'] 		= $booking_flights[0]->search_parameter_details_id;
				$flight['rand_id'] 	    	= $booking_flights[0]->rand_id;
				$flight['traveler_details'] = json_decode(base64_decode($booking_flights[0]->traveler_details));
				$this->load->view('booking/billing_details',$flight);
			}
		}else{
			redirect('booking/orders','refresh');
		}
	}
	
	function email_voucher() {
		$parent_pnr 	= json_decode(base64_decode($_POST['parent_pnr1']));
		if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				$flight['search_id'] 		= $booking_flights[0]->search_parameter_details_id;
				$flight['rand_id'] 	    	= $booking_flights[0]->rand_id;
				$flight['booking_global'] 	= $booking_global;
				$flight['booking_flights']  = $this->Booking_Model->get_booking_flight_data($parent_pnr);
				$flight['booking_payment']  = $this->Booking_Model->get_booking_payment_data($parent_pnr);
				$flight['insurance_detail'] = $this->Booking_Model->get_insurancedata_data($parent_pnr);
				$flight['search_data']  	= json_decode(base64_decode($booking_flights[0]->search_data));
				$flight['results'] 	    	= json_decode(base64_decode($booking_flights[0]->segment_data),1);
				$traveler_details 			= json_decode(base64_decode($flight['booking_flights'][0]->traveler_details));
				$data['email_voucher'] 		= $this->load->view('global/mail_voucher',$flight,true);
				$data['booking_number']		= $flight['booking_global'][0]->booking_number;
				$data['to']					= $_POST['email'];
				// echo '<pre/>';print_r($data);exit;
				$this->Booking_Model->send_voucher($data);
				redirect('booking/orders','refresh');
			}
		}else{
			redirect('booking/orders','refresh');
		}
	}
	
	function cancel($parent_pnr1) {
		$parent_pnr 	= json_decode(base64_decode($parent_pnr1));
		if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				if($booking_flights !=''){
					$SessionCreateRQ_RS 		= SessionCreateRQ($booking_global[0]->pnr_no);
					$SessionCreateRS 			= $this->parseSessionCreateRS($SessionCreateRQ_RS);
					$BinarySecurityToken 		= $SessionCreateRS['BinarySecurityToken'];
					$TravelItineraryReadRQ_RS 	= TravelItineraryReadRQ($BinarySecurityToken, $booking_global[0]->pnr_no);
					$OTA_CancelRQ_RS 			= OTA_CancelRQ($BinarySecurityToken,  $booking_global[0]->pnr_no);
					$OTA_EndTransactionRQ_RS 	= EndTransactionRQFinal($BinarySecurityToken,'UTRAVEL',$booking_global[0]->pnr_no);
					SessionCloseRQ($BinarySecurityToken,$booking_global[0]->pnr_no);
					if(isset($OTA_CancelRQ_RS['OTA_CancelRS'])){
						$response 	= $this->xml_to_array->XmlToArray($OTA_CancelRQ_RS['OTA_CancelRS']);       
						$status 	= $response['soap-env:Body']['OTA_CancelRS']['stl:ApplicationResults']['@attributes']['status'];
						if($status == 'Complete'){	
							$update_booking = array(
									'booking_status' 		=> 'CANCELLED',
									'cancellation_status' 	=> 'CANCELLED',
									'cancel_request_time' 	=> date('Y-m-d H:i:s'),
									'cancel_request'		=> $OTA_CancelRQ_RS['OTA_CancelRQ'],
									'cancel_response'		=> $OTA_CancelRQ_RS['OTA_CancelRS']
								);
							$cancellation_date = $response['soap-env:Body']['OTA_CancelRS']['stl:ApplicationResults']['stl:Success']['@attributes']['timeStamp'];
							$this->Booking_Model->update_booking_global($booking_global[0]->pnr_no, $update_booking);
							$this->cancel_mail_voucher($parent_pnr1);
						}else{
							$update_booking = array(
									'cancellation_status' 	=> 'PENDING',
									'cancel_request_time' 	=> date('Y-m-d H:i:s'),
									'cancel_request'		=> $OTA_CancelRQ_RS['OTA_CancelRQ'],
									'cancel_response'		=> $OTA_CancelRQ_RS['OTA_CancelRS']
								);
							$this->Booking_Model->update_booking_global($booking_global[0]->pnr_no, $update_booking);
						}
					}else{
						$update_booking = array(
											'cancellation_status' 	=> 'PENDING',
											'cancel_request_time' 	=> date('Y-m-d H:i:s'),
											'cancel_request'		=> $OTA_CancelRQ_RS['OTA_CancelRQ'],
											'cancel_response'		=> $OTA_CancelRQ_RS['OTA_CancelRS']
										);
						$this->Booking_Model->update_booking_global($booking_global[0]->pnr_no, $update_booking);
					}
				}
			}
		}
		redirect('booking/orders','refresh');
	}
	
	function cancel_mail_voucher($parent_pnr1){       
        $parent_pnr 	= json_decode(base64_decode($parent_pnr1));
        if(!empty($parent_pnr)){
			$booking_flights 	= $this->Booking_Model->get_booking_flight_data($parent_pnr);
			if($booking_flights !=''){
				$booking_global 	= $this->Booking_Model->get_booking_global_data($parent_pnr);
				if($booking_flights !=''){
					$getTemplate = $this->Booking_Model->get_email_template('FLIGHT_BOOKING_CANCEL_VOUCHER')->row();
					$traveler_details 	= json_decode(base64_decode($booking_flights[0]->traveler_details));	
					$message = $getTemplate->message;
					$message = str_replace("{%%FIRSTNAME%%}", $booking_global[0]->leadpax, $message);
					$message = str_replace("{%%MODULE_NAME%%}", 'flight', $message);
					$message = str_replace("{%%CONFIRMATION_NO%%}", $booking_global[0]->pnr_no, $message);
					$data['subject'] 		= "Utravel - Flight Cancellation - ".$booking_global[0]->pnr_no;
					$data['booking_number'] = $booking_global[0]->pnr_no; 
					$data['email_voucher'] 	= $message; 
					$data['to'] 			= $traveler_details->contact_email;
					$Response = $this->Booking_Model->send_voucher($data);
					return true;
				}    
			}    
        }    
    } 
	
	function parseSessionCreateRS($SessionCreateRQ_RS){ 
		$SessionCreateRS = $SessionCreateRQ_RS['SessionCreateRS'];
		$response = $this->xml_to_array->XmlToArray($SessionCreateRS);
		$Sr=array();
		if(isset($response['soap-env:Header']['eb:MessageHeader'])){
			$Sr['ConversationId'] = $response['soap-env:Header']['eb:MessageHeader']['eb:ConversationId'];
			$Sr['BinarySecurityToken'] = $response['soap-env:Header']['wsse:Security']['wsse:BinarySecurityToken']['@content'];
		}
		return $Sr;
	}
	
	
	public function synchronize_flight_ticket_details(){
		// ini_set('display_errors', 1);error_reporting(E_ALL);
		$booking_list = $this->Booking_Model->get_booking_list_for_ticketing();
		// echo '<pre/>sds';print_r($booking_list);exit;
		if($booking_list !=''){ 
			$SessionCreateRQ_RS 		= SessionCreateRQ($booking_list[0]->pnr_no);
			$SessionCreateRS 			= $this->parseSessionCreateRS($SessionCreateRQ_RS);
			$BinarySecurityToken 		= $SessionCreateRS['BinarySecurityToken'];
			// echo '<pre/>sdsads';print_r($SessionCreateRQ_RS);exit;
			for($b=0;$b<count($booking_list);$b++){
				$response = array('ticket_status' => 0); $ticket_number = '';	
				
				$TravelItineraryReadRQ_RS 	= TravelItineraryReadRQ($BinarySecurityToken, $booking_list[$b]->pnr_no);
				$response 					= $this->xml_to_array->XmlToArray($TravelItineraryReadRQ_RS['TravelItineraryReadRS']);
				// echo '<pre/>sdsads';print_r($response);exit;
				if(isset($response['soap-env:Body']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['Ticketing'])){
					$Ticketing = $response['soap-env:Body']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['Ticketing'];
					echo '<pre/>sdsads';print_r($response);exit;
					if(!isset($Ticketing[0])){
						$Ticketing[0] = $Ticketing;
					}
					foreach ($Ticketing as $key => $ticket) {
						if(!empty((string)$ticket['@attributes']['eTicketNumber'])){
							$ticket_number .= $ticket['@attributes']['eTicketNumber'].",";
						}else{
							$ticket_number = '';
						}
					}
					$ReservationItems1 = $response1['soap-env:Body']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems'];
					if(!isset($ReservationItems1[0])){
						$ReservationItems[0] = $ReservationItems1;
					}else{
						$ReservationItems = $ReservationItems1;
					}
					if($ReservationItems !=''){
					foreach ($ReservationItems as $key => $Reservation) {
						$Items1 = $Reservation['Item'];
						if(!isset($Items1[0])){
							$Items[0] = $Items1;
						}else{
							$Items = $Items1;
						}
						foreach ($Items as $key1 => $Item) {
							$SupplierRef = $Item['FlightSegment']['SupplierRef'];
							$SupplierRefNo .= $SupplierRef['@attributes']['ID'].",";
						}
					}}
					if($ticket_number != ''){
						$update_booking = array(
												'eticket_number' => $ticket_number,
												'SupplierRefNo' => $SupplierRefNo,
												'ticketed_date' => date('Y-m-d'),
												'ticketing_status' => 'CONFIRMED',
											);
						$this->booking_model->update_ticket_info($booking_list[$b]->pnr_no, $update_booking);										 
					}
				}
			}
			SessionCloseRQ($BinarySecurityToken,$booking_list[0]->pnr_no);
		}
		redirect('booking/orders','refresh');				
	}
}
?>
