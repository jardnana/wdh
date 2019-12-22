<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Markup extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Product_Model');		
		$this->load->model('Domain_Model');		
		$this->load->model('Usertype_Model');		
		$this->load->model('Api_Model');
		$this->load->model('Airline_Model');
		$this->load->model('Markup_Model');
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
	
	public function index(){
		$markup 			= $this->General_Model->get_home_page_settings();
		$markup['markup'] 	= $this->Markup_Model->get_markup_list();
	//	 echo '<pre/>';print_r($markup);exit;
		$this->load->view('markup/markup_list',$markup);
	}
	
	public function add_markup(){
		if(count($_POST) > 0){
			$return = $this->Markup_Model->add_markup($_POST);
			//echo"<pre/>"; print_r($return);exit;
			redirect('markup','refresh');
		}else{
			$data 				=  $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_list();
			$data['airline']	=  $this->Airline_Model->get_airline_list();
			$this->load->view('markup/add_markup',$data);	
		}
	}	
	
	function active_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function inactive_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function delete_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function edit_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$data 				=  $this->General_Model->get_home_page_settings();
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_list();
			$data['airline']	=  $this->Airline_Model->get_airline_list();
			$data['markup'] 	= $this->Markup_Model->get_markup_list($markup_id);
			$this->load->view('markup/edit_markup',$data);
		} else {
			redirect('markup','refresh');
		}
	}
	
	function update_markup($markup_id){
		if(count($_POST) > 0){
			$markup_id = json_decode(base64_decode($markup_id));
			if($markup_id != ''){
				$this->Markup_Model->update_markup($_POST,$markup_id);
			}
			redirect('markup','refresh');
		}else if($markup_id!=''){
			redirect('markup/edit_markup/'.$markup_id,'refresh');
		}else{
			redirect('markup','refresh');
		}
	}
}
