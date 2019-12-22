<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(0);
class Subscriber extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Subscriber_Model');
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
	 
	function index(){
		$subscriber 					= $this->General_Model->get_home_page_settings();
		$subscriber['subscriber_list'] 	= $this->Subscriber_Model->get_subscriber_list();
		$this->load->view('subscriber/subscriber_list',$subscriber);
	}
	
	function subscriber_list(){
		$subscriber 					= $this->General_Model->get_home_page_settings();
		$subscriber['subscriber_list'] 	= $this->Subscriber_Model->get_subscriber_list();
		$this->load->view('subscriber/subscriber_list',$subscriber);
	}
	
	function add_subscriber(){
		if(count($_POST) > 0){
			$this->Subscriber_Model->add_subscriber_details($_POST);
			redirect('subscriber','refresh');
		}else{
			$subscriber = $this->General_Model->get_home_page_settings();
			$this->load->view('subscriber/add_subscriber',$subscriber);
		}
	}
	
	function active_subscriber($subscriber_id1){
		$subscriber_id 	= json_decode(base64_decode($subscriber_id1));
		if($subscriber_id != ''){
			$this->Subscriber_Model->active_subscriber($subscriber_id);
		}
		redirect('subscriber','refresh');
	}
	
	function inactive_subscriber($subscriber_id1){
		$subscriber_id 	= json_decode(base64_decode($subscriber_id1));
		if($subscriber_id != ''){
			$this->Subscriber_Model->inactive_subscriber($subscriber_id);
		}
		redirect('subscriber','refresh');
	}
	
	function delete_subscriber($subscriber_id1){
		$subscriber_id 	= json_decode(base64_decode($subscriber_id1));
		if($subscriber_id != ''){
			$this->Subscriber_Model->delete_subscriber($subscriber_id);
		}
		redirect('subscriber','refresh');
	}
	
	function edit_subscriber($subscriber_id1)
	{
		$subscriber_id 	= json_decode(base64_decode($subscriber_id1));
		if($subscriber_id != ''){
			$subscriber 					= $this->General_Model->get_home_page_settings();
			$subscriber['subscriber_list'] 	= $this->Subscriber_Model->get_subscriber_list($subscriber_id);
			$this->load->view('subscriber/edit_subscriber',$subscriber);
		}else{
			redirect('subscriber','refresh');
		}
	}

	function update_subscriber($subscriber_id1)
	{
		$subscriber_id 	= json_decode(base64_decode($subscriber_id1));
		if($subscriber_id != ''){
			if(count($_POST) > 0){
				$this->Subscriber_Model->update_subscriber($_POST,$subscriber_id);
				redirect('subscriber','refresh');
			}else if($subscriber_id!=''){
				redirect('subscriber/edit_subscriber/'.$subscriber_id,'refresh');
			}else{
				redirect('subscriber','refresh');
			}
		}else{
			redirect('subscriber','refresh');
		}
	}
}
