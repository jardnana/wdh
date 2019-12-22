<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Management extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Management_Model');	
		$this->load->model('Users_Model');		
		$this->load->model('Product_Model');		
		$this->load->model('Domain_Model');		
		$this->load->model('Usertype_Model');		
		$this->load->model('Api_Model');		
		$this->load->model('Payment_Model');
		$this->load->model('Blocklist_Model');
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

	public function api_management_list(){
		$api_management 					= $this->General_Model->get_home_page_settings();
		$api_management['api_management'] 	= $this->Management_Model->get_api_management_list();
		// echo '<pre/>';print_r($api_management);exit;
		$this->load->view('management/api/api_management_list',$api_management);	
	}

	public function api_management(){
		if(count($_POST) > 0){
			$this->Management_Model->manage_api($_POST);
			redirect('management/api_management_list','refresh');
		}else{
			$data 				= $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_list();
			$this->load->view('management/api/api_management',$data);	
		}
	}
	function active_api_management($domain_product_api_id){
		$domain_product_api_id = json_decode(base64_decode($domain_product_api_id));
		if($domain_product_api_id != ''){
			$this->Management_Model->active_api_management($domain_product_api_id);
		}
		redirect('management/api_management_list','refresh');
	}
	
	function inactive_api_management($domain_product_api_id){
		$domain_product_api_id = json_decode(base64_decode($domain_product_api_id));
		if($domain_product_api_id){
			$this->Management_Model->inactive_api_management($domain_product_api_id);
		}
		redirect('management/api_management_list','refresh');
	}
	
	function delete_api_management($domain_product_api_id){
		$domain_product_api_id = json_decode(base64_decode($domain_product_api_id));
		if($domain_product_api_id != ''){
			$this->Management_Model->delete_api_management($domain_product_api_id);
		}
		redirect('management/api_management_list','refresh');
	}

	public function product_management_list(){
		$product_management 					= $this->General_Model->get_home_page_settings();
		$product_management['product_management'] 	= $this->Management_Model->get_product_management_list();
		$this->load->view('management/product/product_management_list',$product_management);	
	}
	
	public function product_management(){
		if(count($_POST) > 0){
			$this->Management_Model->manage_product($_POST);
			redirect('management/product_management_list','refresh');
		}else{
			$data 				= $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			// echo '<pre/>';print_r($data);exit;
			$this->load->view('management/product/product_management',$data);	
		}
	}

	function active_product_management($domain_product_id){
		$domain_product_id = json_decode(base64_decode($domain_product_id));
		if($domain_product_id != ''){
			$this->Management_Model->active_product_management($domain_product_id);
		}
		redirect('management/product_management_list','refresh');
	}
	
	function inactive_product_management($domain_product_id){
		$domain_product_id = json_decode(base64_decode($domain_product_id));
		if($domain_product_id != ''){
			$this->Management_Model->inactive_product_management($domain_product_id);
		}
		redirect('management/product_management_list','refresh');
	}
	
	function delete_product_management($domain_product_id){
		$domain_product_id = json_decode(base64_decode($domain_product_id));
		if($domain_product_id != ''){
			$this->Management_Model->delete_product_management($domain_product_id);
		}
		redirect('management/product_management_list','refresh');
	}

	public function payment_api_management_list(){
		$payment_api_management 							= $this->General_Model->get_home_page_settings();
		$payment_api_management['payment_api_management'] 	= $this->Management_Model->get_payment_api_management_list();
		$this->load->view('management/payment/payment_api_management_list',$payment_api_management);	
	}
	
	public function payment_api_management(){
		if(count($_POST) > 0){
			$this->Management_Model->manage_payment_api($_POST);
			redirect('management/payment_api_management_list','refresh');
		}else{
			$data 				= $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['payment']	=  $this->Payment_Model->get_payment_api_list();
			$this->load->view('management/payment/payment_api_management',$data);	
		}
	}
	
	function active_payment_api_management($domain_product_payment_api_id){
		$domain_product_payment_api_id = json_decode(base64_decode($domain_product_payment_api_id));
		if($domain_product_payment_api_id != ''){
			$this->Management_Model->active_payment_api_management($domain_product_payment_api_id);
		}
		redirect('management/payment_api_management_list','refresh');
	}
	
	function inactive_payment_api_management($domain_product_payment_api_id){
		$domain_product_payment_api_id = json_decode(base64_decode($domain_product_payment_api_id));
		if($domain_product_payment_api_id != ''){
			$this->Management_Model->inactive_payment_api_management($domain_product_payment_api_id);
		}
		redirect('management/payment_api_management_list','refresh');
	}
	
	function delete_payment_api_management($domain_product_payment_api_id){
		$domain_product_payment_api_id = json_decode(base64_decode($domain_product_payment_api_id));
		if($domain_product_payment_api_id != ''){
			$this->Management_Model->delete_payment_api_management($domain_product_payment_api_id);
		}
		redirect('management/payment_api_management_list','refresh');
	}
	
	public function site_management_list(){
		$site_management 						= $this->General_Model->get_home_page_settings();
		$site_management['site_management'] 	= $this->Management_Model->get_site_management_list();
		// echo '<pre/>';print_r( $site_management);exit;
		$this->load->view('management/site_management/site_management_list',$site_management);	
	}
	public function site_management(){
		if(count($_POST) > 0){
			$this->Management_Model->site_management($_POST);
			redirect('management/site_management_list','refresh');
		}else{
			$data 				= $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['api']		=  $this->Api_Model->get_api_list();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['user_list']  =  $this->Users_Model->get_user_list();
			$data['payment']	=  $this->Payment_Model->get_payment_api_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['blocklist']	=  $this->Blocklist_Model->get_block_list();
			// echo '<pre/>';print_r( $data);exit;
			$this->load->view('management/site_management/site_management',$data);	
		}
	}

	function active_site_management($block_type_details_id){
		$block_type_details_id = json_decode(base64_decode($block_type_details_id));
		if($block_type_details_id != ''){
			$this->Management_Model->active_site_management($block_type_details_id);
		}
		redirect('management/site_management_list','refresh');
	}
	
	function inactive_site_management($block_type_details_id){
		$block_type_details_id = json_decode(base64_decode($block_type_details_id));
		if($block_type_details_id != ''){
			$this->Management_Model->inactive_site_management($block_type_details_id);
		}
		redirect('management/site_management_list','refresh');
	}
	
	function delete_site_management($block_type_details_id){
		$block_type_details_id = json_decode(base64_decode($block_type_details_id));
		if($block_type_details_id != ''){
			$this->Management_Model->delete_site_management($block_type_details_id);
		}
		redirect('management/site_management_list','refresh');
	}
	
	function social_links_management(){
		$social_links 						= $this->General_Model->get_home_page_settings();
		$social_links['linksdesc'] 	= $this->Management_Model->get_social_links_list();
		$this->load->view('management/social_links/social_links_list',$social_links);	
	}
	function edit_social_link($link_id){
		$link_id = json_decode(base64_decode($link_id));
		if($link_id != ''){
			$social_links 			   = $this->General_Model->get_home_page_settings();
			$social_links['linksdesc'] = $this->Management_Model->get_social_links_list($link_id);
			$this->load->view('management/social_links/edit_social_link',$social_links);
		} else {
			redirect('management/social_links_management','refresh');
		}
	}
	function update_social_link($link_id1){
		if(count($_POST) > 0){
			$link_id = json_decode(base64_decode($link_id1));
			if($link_id != ''){
				$this->form_validation->set_rules('link_english','Link for English Version','required');
				$this->form_validation->set_rules('link_polish','Link for Polish Version','required');
				if($this->form_validation->run()==TRUE){
					$this->Management_Model->update_social_link($_POST,$link_id);
				} else {
					redirect('management/edit_social_link/'.$link_id1,'refresh');
				}
			} 
			redirect('management/social_links_management','refresh');
		}else if($link_id1!=''){
			redirect('management/edit_social_link','refresh');
		}else{
			redirect('management/edit_social_link','refresh');
		}
	}
	
	function active_social_link($link_id1){
		$link_id = json_decode(base64_decode($link_id1));
		if($link_id != ''){
			$this->Management_Model->active_social_link($link_id);
		}
		redirect('management/social_links_management','refresh');
	}
	
	function inactive_social_link($link_id1){
		$link_id = json_decode(base64_decode($link_id1));
		if($link_id != ''){
			$this->Management_Model->inactive_social_link($link_id);
		}
		redirect('management/social_links_management','refresh');
	}
}
