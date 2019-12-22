<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//error_reporting(0);
class Orders extends CI_Controller {

    public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Booking_Model');
		$this->load->model('Email_Model');
		$this->load->model('Xml_Model');
		$this->load->model('Hotel_Model');
        $this->check_admin_login();	
        $this->load->helper('excursion_cancel_helper');
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
	public function voucher($module,$pnr_no){
		$module = json_decode(base64_decode($module));
        $pnr_no = json_decode(base64_decode($pnr_no));
        if($pnr_no != '' && $module != ''){
			$data['Booking'] = $booking = $this->General_Model->getBookingbyPnr($pnr_no,$module)->row();
			if($module == 'HOTEL'){
				$checkin_date = strtotime($booking->check_in);
				$checkout_date = strtotime($booking->check_out);
					
				$absDateDiff = abs($checkout_date - $checkin_date);
				$data['number_of_nights'] = floor($absDateDiff/(60*60*24));

				$this->load->view('orders/hotel_voucher',$data);
			} else if($module == 'SIGHTSEEN'){
				$this->load->view('orders/sightseen_voucher',$data);
			}else if($module == 'FLIGHT'){
				$this->load->view('orders/flight_voucher',$data);
			}
			else if($module == 'TRANSFER'){
				$this->load->view('orders/transfer_voucher',$data);
			}
		}  else {
			redirect('booking/orders','refresh');
		}
    }

    public function hotelcancel($module, $ref_id ,$booking_ID){
    	$refid = json_decode(base64_decode($ref_id));
    	$module_hotel = json_decode(base64_decode($module));
    	$booking_id = $this->Booking_Model->get_hotel_booking_id($refid);
    	//echo "<pre/>booking:.."; print_r($module); die();
    	$booking_no = base64_encode(json_encode($booking_id));
    	$module = base64_encode(json_encode($module_hotel));
    	$this->cancel($module, $ref_id ,$booking_no);
    }
    
    public function cancel($module, $pnr_no ,$booking_ID){
    	$module = json_decode(base64_decode($module));
        $pnr_no = json_decode(base64_decode($pnr_no));
        $booking_no = json_decode(base64_decode($booking_ID));
		// $booking_no = base64_decode(base64_decode($booking_no));
		$PurchaseCancelRQRS = PurchaseCancelRQRS($module,$booking_no);
		$dom 	= new DOMDocument();
		$dom->loadXML($PurchaseCancelRQRS['PurchaseCancelRS']);
		
		if($dom->getElementsByTagName('Error')->length <= 0){
			$Purchase = $dom->getElementsByTagName('Purchase');
			foreach ($Purchase as $service_Purchase){
				$statusval 			= $service_Purchase->getElementsByTagName("Status");
				$status_val 		= $statusval->item(0)->nodeValue;
				$PaymentData 			= $service_Purchase->getElementsByTagName("PaymentData");
				foreach($PaymentData as $Payment_Data){
					$description_data = $Payment_Data->getElementsByTagName('Description');
					$description = $description_data->item(0)->nodeValue;
				}
			}
			$update_booking = array(
								'booking_status' => $status_val,
								'cancellation_status' => $status_val,
								'cancel_response' => $description
							);
			if ($module == 'HOTEL') {
				$refid = $pnr_no;
				$this->General_Model->Update_hotel_Cancellation_Global($refid, $update_booking, $module);
				$booking_no = $this->General_Model->get_hotel_Cancelled_Global_bookingno($refid, $module);
				//echo "<pre/>res:..";print_r($booking_no);die();
				$data['Booking'] = $booking = $this->General_Model->getBookingbynumber($booking_no,$module);
			}elseif ($module == 'TRANSFER') {
				$refid = $pnr_no;
				$this->General_Model->Update_hotel_Cancellation_Global($refid, $update_booking, $module);
				$booking_no = $this->General_Model->get_hotel_Cancelled_Global_bookingno($refid, $module);
				//echo "<pre/>res:..";print_r($booking_no);die();
				$data['Booking'] = $booking = $this->General_Model->getBookingbynumber($booking_no,$module);
			}else{
			$this->General_Model->Update_Cancellation_Global($booking_no, $update_booking, $module);
			$data['Booking'] = $booking = $this->General_Model->getBookingbynumber($booking_no,$module)->row();
			}
			
			//echo "<pre/>"; print_r($data); exit;
			$this->cancellation_email($booking_no);
			if($module == 'HOTEL'){
				$checkin_date = strtotime($booking->check_in);
				$checkout_date = strtotime($booking->check_out);
					
				$absDateDiff = abs($checkout_date - $checkin_date);
				$data['number_of_nights'] = floor($absDateDiff/(60*60*24));

				$this->load->view('orders/hotel_voucher',$data);
			} else if($module == 'SIGHTSEEN'){
				$this->load->view('orders/sightseen_voucher',$data);
			}else if($module == 'FLIGHT'){
				$this->load->view('orders/flight_voucher',$data);
			}else if($module == 'TRANSFER'){
				$this->load->view('orders/transfer_voucher',$data);
			}
		} else {
			redirect('booking/orders','refresh');
		} 
	}
	
	public function cancellation_email($booking_no) {
        $count = $this->General_Model->validate_booking_no_org($booking_no)->num_rows();
        if ($count == 1) {
			$b_data = $this->General_Model->validate_booking_no_org($booking_no)->row();
			$data['result'][] = $booking = $this->General_Model->getBookingbynumber($booking_no, $b_data->module)->row();
			$data['email_access'] = $email_access = $this->Email_Model->get_email_acess('NONSSL_BOOKING');
			$data['email_template'] = $this->Email_Model->get_email_template('Registration')->row();
			if($email_access != '') {
				/*$data['social_url'] = array(
				 * 							'facebook_social_url' => 'https://www.facebook.com/profile.php?id=100010365818006',
											'twitter_social_url' => 'https://twitter.com/Tripkonnect',
											'google_social_url' => 'https://plus.google.com/u/0/108256158323692449070',
										);*/
				$data['to'] = $booking->billing_email;
				$data['pnr_no'] = $booking->pnr_no;
				$data['booking_status'] = $booking->booking_status;
				$data['module'] = $b_data->module;
				$data['message'] = $message = $this->load->view('global/booking_template', $data, true);
				if($this->Email_Model->sendmail_redefinedVoucher($data)){
					return true;
				} else {
					return false;
				}
			}
		}
    }

    
    public function voucher_email_send($booking_ID,$pnr_no,$booking_status){
    	$data = array("booking_no" => $booking_ID,
    				  "pnr_no" => $pnr_no,
    				  "booking_status" => $booking_status);
    	if (!empty($data)) {
    		$this->Email_Model->sendmail_redefinedVoucher($data);
    		redirect('booking/orders');
    	}
    	else{
    		redirect('booking/orders');
    	}
    	
    } 
	
	public function view_hotel_voucher($pnr_no){
	    $pnr_no = json_decode(base64_decode($pnr_no));
		$data['result1'] = $this->Booking_Model->get_global_voucherdata($pnr_no,$module='HOTEL');
		$ref_id_hotel = $data['result1'][0]->ref_id;
		$data['result'] = $this->Booking_Model->get_hotel_voucherdata($ref_id_hotel);
		if(!empty($data['result'])){
			$this->load->view('global/view_hotelvoucher', $data);
		}
   }
   public function view_transfer_voucher($id){
		
		$data['result1'] = $this->Profile_Model->get_global_voucherdata($id,$module='TRANSFER');
		$data['result'] = $this->Profile_Model->get_transfer_voucherdata($id);//print_r($data['result']);
		if(!empty($data['result'])){
			$this->load->view('global/view_transfervoucher', $data);
		}
   }
   public function view_sightseen_voucher($pnr_no){
	    $pnr_no = json_decode(base64_decode($pnr_no));	
		$data['result1'] = $this->Booking_Model->get_global_voucherdata($pnr_no,$module='SIGHTSEEN');
		$ref_id_sightseen = $data['result1'][0]->ref_id;
		$data['result'] = $this->Booking_Model->get_excursion_voucherdata($ref_id_sightseen);
		if(!empty($data['result'])){
			$this->load->view('global/view_sightseenvoucher', $data);
		}
   }
   public function view_flight_voucher($id){
		
		$data['result1'] = $this->Profile_Model->get_global_voucherdata($id,$module='FLIGHT');
		$data['result'] = $this->Profile_Model->get_flight_voucherdata($id);
		if(!empty($data['result'])){
			$this->load->view('global/view_flightvoucher', $data);
		}
   }

   public function send_voucher(){
		$data['email'] = $this->input->post('email');
		$data['pnr_no'] = $this->input->post('pnr_no');
		$data['module'] = json_decode(base64_decode(($this->input->post('module'))));
		$pnr_no = $data['pnr_no'] ;
		$module = $data['module'];
		$b_data = $this->General_Model->validate_refid_no_org($pnr_no)->row();
		$booking_no = $b_data->booking_no;
		$data['result'][] = $booking = $this->General_Model->getBookingbynumber($booking_no, $b_data->module)->row();
		if($data != '') {
				$data['message'] = $message = $this->load->view('global/booking_template', $data, true);
				$this->Email_Model->sendmail_voucher($data);
				redirect ('booking/orders');
	}
  }
	
                   
}

