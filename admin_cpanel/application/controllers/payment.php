<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Payment extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Payment_Model');
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
	 
	function payment_api_list(){
		$payment 					= $this->General_Model->get_home_page_settings();
		$payment['payment_api_list'] = $this->Payment_Model->get_payment_api_list();
		$this->load->view('payment/payment_api_list',$payment);
	}
	
	function add_payment_api(){
		if(count($_POST) > 0){
			$api_logo_name = '';
			if(!empty($_FILES['api_logo']['name']))
			{	
				if(is_uploaded_file($_FILES['api_logo']['tmp_name'])) 
				{
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['api_logo']['tmp_name'];
					$filename = $_FILES['api_logo']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['api_logo']['name'];
						$targetPath = "uploads/paymentapi/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$api_logo_name = $img_Name;
						}
					}
				}				
			}
			$this->Payment_Model->add_payment_api_details($_POST,$api_logo_name);
			redirect('payment/payment_api_list','refresh');
		}else{
			$payment 					= $this->General_Model->get_home_page_settings();
			$this->load->view('payment/add_payment_api',$payment);
		}
	}
	
	function active_payment_api($payment_api_id){
		$payment_api_id = json_decode(base64_decode($payment_api_id));
		if($payment_api_id){
			$this->Payment_Model->active_payment_api($payment_api_id);
		}
		redirect('payment/payment_api_list','refresh');
	}
	
	function inactive_payment_api($payment_api_id){
		$payment_api_id = json_decode(base64_decode($payment_api_id));
		if($payment_api_id){
			$this->Payment_Model->inactive_payment_api($payment_api_id);
		}
		redirect('payment/payment_api_list','refresh');
	}
	
	function delete_payment_api($payment_api_id){
		$payment_api_id = json_decode(base64_decode($payment_api_id));
		if($payment_api_id){
			$this->Payment_Model->delete_payment_api($payment_api_id);
		}
		redirect('payment/payment_api_list','refresh');
	}
	
	function edit_payment_api($payment_api_id){
		$payment_api_id = json_decode(base64_decode($payment_api_id));
		if($payment_api_id){
			$payment 					= $this->General_Model->get_home_page_settings();
			$payment['api'] = $this->Payment_Model->get_payment_api_list($payment_api_id);
			$this->load->view('payment/edit_payment_api',$payment);
		} else {
			redirect('payment/payment_api_list','refresh');
		}
	}

	function update_payment_api($payment_api_id){
		if(count($_POST) > 0){
			$payment_api_id = json_decode(base64_decode($payment_api_id));
			if($payment_api_id != ''){
				$api_logo_name  = $_REQUEST['api_logo_old'];
				if(!empty($_FILES['api_logo']['name'])){	
					if(is_uploaded_file($_FILES['api_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$oldImage = "uploads/paymentapi/".$api_logo_name;
						if($api_logo_name!='')
							unlink($oldImage);
						$sourcePath = $_FILES['api_logo']['tmp_name'];
						$filename = $_FILES['api_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['api_logo']['name'];
							$targetPath = "uploads/paymentapi/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$api_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Payment_Model->update_payment_api($_POST,$payment_api_id, $api_logo_name);
			}
			redirect('payment/payment_api_list','refresh');
		}else if($payment_api_id!=''){
			redirect('payment/payment_api_list','refresh');
		}else{
			redirect('payment/payment_api_list','refresh');
		}
	}
}
